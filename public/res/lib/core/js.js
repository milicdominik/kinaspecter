var snotifycounter = 0;
var snotifylistenerrunning = false;
function snotify()
{
  if (snotifycounter >= 20) return;
    snotifycounter++;
    if (!snotifylistenerrunning)
    {
      snotifylistenerrunning = true;
      $.getJSON( "/notifications/listener", function(d) {
        txtnum = (d.notifications.num_unread == 0) ? '':d.notifications.num_unread;
        $(".notifynum").text(txtnum).data('lastid',d.notifications.lastid);
        	//send notification details to browser notification system
          if (d.notifications.can_pushnotify && ("Notification" in window))
          {
            Notification.requestPermission().then(function(r) {
            	var notification = new Notification(d.notifications.pushnotify.title, {
            		 icon: d.notifications.pushnotify.icon,
            		 body: d.notifications.pushnotify.body,
            	});
            });
          }
      }).always(function() {
        snotifylistenerrunning = false;
      });
    }
}


$('body').keydown(function(e) {
    var code = e.keyCode || e.which;
    if (code === 9) {$('body').addClass('tabpressed')}
});

$(function() {

  $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
  initcontrol();

  snotify();
  //create 15 second listener for notifications
  setInterval(function() {snotify()}, 15000);

});
function initcontrol()
{
    //attach events to all apilinks, static and dynamically created
    //using static body selector
    $("body").off('click','.apipost').on('click','.apipost',function(){
          NetComAPIFormRequest($(this));return false;
    });
    $("body").off('click','.apilink').on('click','.apilink',function(){
          NetComAPIRequest($(this));return false;
    });
    //init checkboxes - only with class icheck
    $('.icheck').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
    });

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    });

}
var actiondisable = [];
var actiondisableperm = [];
//finds a form in which .apipost button is stored and sends POST request
function NetComAPIFormRequest(el) {
  //get Form
  var $form = $(el).closest('form').addClass('processing');
  //get form elements and collect them
  var data = {};
  $.each($form.serializeArray(),function(i, v) {
    //it is multiselect
    if (v.name.match(/\[\]/)){
      if (!(v.name in data))
        data[v.name] = [];
      data[v.name].push(v.value);
    }
    else
      data[v.name] = v.value;
  });
  //set route from Form
  if($(el).data('route')) {
    data['route'] = $(el).data('route');
  } else {
    data['route'] = $form.attr('action');
  }
  //make new NetComAPIRequest
  NetComAPIRequest(el,data);
}

function NetComAPIRawRequest(data,token){
  if(!token) token = 'rawrequest';
  NetComAPIRequest($('<a data-token="'+token+'" data-route=""></a>'),data);
}

function NetComAPIRequest(el,appenddata) {
    //open confirmation dialog
    if (typeof(el.data('sysconfirm')) !== 'undefined') {
        //var rc = netcom_confirm(el,el.data('sysconfirm'),false);
        var rc = confirm(el.data('sysconfirm'));
        if (rc != true) return false;
    }
    //fetch token and route
    var hasErrors = false;
    var token = el.data('token');
    var route = el.data('route');
    if(token==null){showToast('Programming error','APILINK data-token missing', 'red','bottomright');return false;}
    //stop request if one is already running
    if (actiondisable[token] && actiondisable[token] == 1)
        return false;
    if (actiondisableperm[token] && actiondisableperm[token] == 1)
        return false;
    actiondisable[token] = 1;
    var data = {};
    var sys = {};
    var loader = el.find("span.loader");
    if(loader.length)
    {
      loader.addClass('loading');
      loader.html('<span><i class="fas fa-sync-alt fa-spin"></i></span>');
    }
    else
      el.addClass('loading');

    var url = route;
    $.each(el.data(), function(i, v) {
        if (i.match("^sys")) sys[i] = v;
        else data[i] = v;
    });
    //appenddata to data
    if (typeof(appenddata) !== 'undefined') {
        jQuery.extend(data, appenddata);
    }
    $.each(data, function(i, v) {
        if (i.match("^sys")) sys[i] = v;
    });
    //if data route is defined then override elements data-route
    if (appenddata && appenddata.route)
    {
        route = appenddata.route;
        url = route;
    }
    //error checking
    if(route==null){showToast('Programming error','APILINK data-route missing', 'red','bottomright');return false;}
    $.ajax({
      type:sys.sysmethod ? sys.sysmethod : "POST",
      dataType: "json",
      url: url,
      data: data,
      beforeSend: function(xhr, opts){
        //izvrsi neku funkciju prije slanja
        if (sys.syscustbefore) {
          if(eval("typeof NetComAPICustomBefore_"+sys.syscustbefore) !== "undefined"){
            //console.log("Call(syscustbefore) NetComAPICustomBefore_"+sys.syscustbefore);
            window["NetComAPICustomBefore_"+sys.syscustbefore](el,loader,xhr,opts);
          }
          else
            console.warn('Warning: Global Function named "NetComAPICustomBefore_'+sys.syscustbefore+'(el,loader,xhr,opts)" does not exist in window scope.');
       }
      },
      success: function(d){
        actiondisable[token] = 0;
        loader.html('');
        loader.removeClass('loading');
        el.removeClass('loading');
        if (d.systitle) el.html('<i class="fas fa-check"></i> '+ d.systitle);
        if (d.sysstopnext == 1)
        {
            actiondisableperm[token] = 1;
            el.addClass('disabled');
        }
        if(d.msg) showToast(false,d.msg, 'green','topcenter');
        if(d.errormsg) showToast(false,d.errormsg, 'red','topcenter');
        if(d.infomsg) showToast(false,d.infomsg, 'blue','topcenter');
        //callback
        if (sys.sysc) {
          if(eval("typeof NetComAPI_"+sys.sysc) !== "undefined"){
            //console.log('Call(sysc): NetComAPI_'+sys.sysc);
            window["NetComAPI_"+sys.sysc](d,el,loader);
          }
          else
            console.warn('Warning: Global Function named "NetComAPI_'+sys.sysc+'(d,el,loader)" does not exist in window scope.');
        }
        else if (sys.syscust){
          if(eval("typeof NetComAPICustom"+token+"_"+sys.syscust) !== "undefined"){
            //console.log("Call(syscust): "+"NetComAPICustom"+token+"_"+sys.syscust)
            window["NetComAPICustom"+token+"_"+sys.syscust](d,el,loader)
          }
          else
            console.warn('Warning: Custom Function named "NetComAPICustom'+token+'_'+sys.syscust+'(response,el,loader)" does not exist in window scope.');
        }
      },
      error: function(a,d,c){

        if (typeof token !== 'undefined')
          actiondisable[token] = 0;
        loader.html('');
        loader.removeClass('loading');
        el.removeClass('loading');
        return NetComAPIError(a,sys,el,loader,token);
      },
      //reinit control event on any newly created elements
      complete:function(){
        if(!sys.sysskipinitcontrol)
          initcontrol();
        var $form = $(el).closest('form');
        if($form.length)
          $form.removeClass('processing');
      }
    });
    return true;
}
function NetComAPIError(response,sys,el,loader,token)
{
    //callback on error
    if (sys.sysc) {
      if(eval("typeof NetComAPIError_"+sys.sysc) !== "undefined"){
        //console.log('Call(sysc): NetComAPI_'+sys.sysc);
        window["NetComAPIError_"+sys.sysc](response,el,loader);
      }
      else
        console.warn('Warning: Global Function named "NetComAPIError_'+sys.sysc+'(response,el,loader)" does not exist in window scope.');
    }
    else if (sys.syscust){
      if(eval("typeof NetComAPICustom"+token+"Error_"+sys.syscust) !== "undefined"){
        window["NetComAPICustom"+token+"Error_"+sys.syscust](response,el,loader)
      }
      else
        console.warn('Warning: Custom Function named "NetComAPICustom'+token+'Error_'+sys.syscust+'(response,el,loader)" does not exist in window scope.');
    }

    var r = response.responseJSON;
    if (response.status === 500)
    {
      showToast('500 Internal server error','Please contact server administrator', 'red','bottomright');
      return;
    }
    if (response.status === 402)
    {
      showToast(false,'402 Limit reached', 'red','bottomright');
      return;
    }
    if (response.status === 404)
    {
      showToast('404 Page not found','Please contact server administrator', 'red','bottomright');
      return;
    }
    if (response.status === 405)
    {
      showToast(false,'405 Command not allowed', 'red','bottomright');
      return;
    }
    if (response.status === 403)
    {
      showToast('403 Forbidden','You do not have rights to access this command', 'red','bottomright');
      return;
    }

    if (response.status === 419)
    {
      showToast('419 Unauthorized','Your session has expired', 'red','bottomright');
      return;
    }

    //handle form validation errors returned by Laravel validate()
    if (response.status === 422)
    {
      var collectederrors = '';
        $.each( r.errors, function(k,v) {

          $('label[for="'+k+'"]').addClass('text-danger').parent('.form-group').addClass('has-error').find('.form-control').addClass('is-invalid');
          collectederrors += v.join("<br />")+'<br />';
          //$('[name="'+k+'"]').after('<div class="invalid-feedback d-block">'+v.join("<br />")+'</div>');
          //$('label[for="'+k+'"]').after('<div class="invalid-feedback d-block">'+v.join("<br />")+'</div>');
        });
        showToast('Validation error',collectederrors, 'orange','topcenter');
        return;
    }

    var msg = r.description;
    if (r.erroraction == 'output')
    {
      showToast(false,r.msg, 'orange','topcenter');
      return false;
    }
    else //output
    {
        if (r.system == 1) //system message
          showToast(r.msg,r.data.reason, 'red','topcenter');
        else
          showToast(false,'Sorry, unable to complete request. Try again later.', 'red','topcenter');
        return false;
    }
}

var modalcounter = 0;
/* modal dynamic creation */
function NetComGetModal(mid,content,title,cssclass,dismissable)
{

  var $getmodal = $("#"+mid);
  if(!$getmodal.length){
    var $modal = $("<div>", {id:mid, "class": "modal fade"});
    $modal.html('<div id="modal_'+mid+'_c" class="modal-dialog '+cssclass+'"><div class="modal-content">'+content+'</div></div>');

    var backdrop = true; //true displayed, false not displayed, 'static' displayed and not dismissable
    if(!dismissable) backdrop = 'static';
    //init bs modal on $modal
    var m = new bootstrap.Modal($modal, {
      backdrop: backdrop,
      keyboard: true
    });
    $("body").append($modal); //insert modal html to DOM
    return m;
  }
  else
  {
    $getmodal.html('<div id="modal_'+mid+'_c" class="modal-dialog '+cssclass+'"><div class="modal-content">'+content+'</div></div>');
    return NetComSelectModal(mid);
  }
}
//helper to get modal instance from mid
function NetComSelectModal(mid)
{
  return bootstrap.Modal.getInstance(document.getElementById(mid))
  //console.warn("Unable to select modal with mid: "+mid);
}
function NetComAPI_reload(d,e,l){location.reload()}

function netcom_confirm(el, msg, do_submit) {
    if (!$(el).attr('id')) {alert('Programming error: netcom_confirm el is missing ID'); return false;};
    //if (!$(el).attr('href')) return confirm(msg); //default confirmation alert for non-links
    $("#modalconfirm .modal-body").text(msg);
    if(do_submit)
    {
      $("#modalconfirm_confirmbtn").attr("href", "#"); //reset
      $("#modalconfirm_confirmbtn").attr("onclick", "return closesformsubmit('"+$(el).attr('id')+"')"); //reset
    }
    else
    {
      var url = $(el).attr('href');
      $("#modalconfirm_confirmbtn").attr("href", url);
    }

    var m = new bootstrap.Modal(document.getElementById('modalconfirm'), {
      backdrop: 'static',
      keyboard: true
    });
    m.show();
    return false;
}
//submita parent form-u
function closesformsubmit(elid)
{
  $("#"+elid).closest("form").submit();
  return false;
}

/**
 * Usage: showToast('hey!', 'success');
 * color - red,green,orange,blue,white
 * position - bottomright,topcenter
 */
function showToast(title,msg,color,position,timeout) {
  css = '';
  icon = '<i class="fas fa-check"></i> &nbsp;&nbsp;'
  closebtncss = 'btn-close btn-close-white';
  if(color == 'white')
  {
    closebtncss = 'btn-close';
    css = '';
  }
  else if(color == 'green')
  {
    css = 'bg-success text-light';
  }
  else if(color == 'red')
  {
    css = 'bg-danger text-light';
    icon = '<i class="fas fa-times"></i> &nbsp;&nbsp;'
  }
  else if(color == 'orange')
  {
    css = 'bg-warning text-dark';
    icon = '<i class="fas fa-exclamation-triangle"></i> &nbsp;&nbsp;'
  }
  else if(color == 'blue')
  {
    css = 'bg-info text-light';
    icon = '<i class="fas fa-info-circle"></i> &nbsp;&nbsp;'
  }

  var delay = 2000;
  if(timeout)
     delay = timeout;
  var html = '<div class="toast '+css+' border-0" role="alert" aria-live="assertive" aria-atomic="true">';
  if(title)
  {
    html += '<div class="toast-header">'+icon+'<strong class="me-auto">'+title+'</strong><button type="button" class="'+closebtncss+'" data-bs-dismiss="toast" aria-label="Close"></button></div>';
  }
  html += '<div class="d-flex"><div class="toast-body">'+msg+'</div>';
  if(!title)
    html += '<button type="button" class="'+closebtncss+' me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button></div></div>';
  var toastElement = htmlToElement(html);
  var pos = 'toast-container';
  if(position == 'topcenter') pos = 'toast-container-top';
  var toastConainerElement = document.getElementById(pos);
  toastConainerElement.appendChild(toastElement);
  var toast = new bootstrap.Toast(toastElement, {delay:delay, animation:true});
  toast.show();
}
/**
 * @param {String} HTML representing a single element
 * @return {Element}
 */
function htmlToElement(html) {
    var template = document.createElement('template');
    html = html.trim(); // Never return a text node of whitespace as the result
    template.innerHTML = html;
    return template.content.firstChild;
}
/*$(function() {
showToast('naslov','hey!', 'green','bottomright');
showToast('naslov','hey!', 'red','bottomright');
showToast('naslov','hey!', 'blue','bottomright');
showToast('naslov','white!', 'white','bottomright');
showToast('naslov','hey!', 'orange','bottomright');
showToast(false,'hey!', 'red','topcenter');
});*/

function adminaccessmodal(el)
{
  NetComGetModal('adminaccess','<div class="m-5 text-center" id="adminaccess"><div class="spinner-border text-danger" role="status"><span class="visually-hidden">Loading...</span></div></div>','Admin','',true)
    .show();
  NetComAPIRawRequest({
    'route': '/adminaccess','sysmethod': 'GET','sysc':'adminaccessmodalfill'
  },'adminaccess');
  return false;
}
function NetComAPI_adminaccessmodalfill(d,el,loader){
  $("#modal_adminaccess_c .modal-content").html(d.html)
}

function getLinkQueryParameter(el,name) {
  let queryParameter = undefined;
  el.search
    .substr(1)
    .split("&")
    .some(function(item) {
      // returns first occurence and stops
      return (
        item.split("=")[0] == name && (queryParameter = item.split("=")[1])
      );
    });
  return queryParameter;
}

function zoomavatar(title,avatar_url)
{
  var contents = '<div class="modal-header"><h5 class="modal-title text-truncate"><i class="align-middle me-1 fas fa-fw fa-user"></i> '+title+'</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>';
  contents += '<a id="zoomavatar" class="overflow-hidden text-center p-2"><img src="'+avatar_url+'" class="rounded w-100" /></a>';
  NetComGetModal('zoomavatar',contents,'Avatar','',true)
    .show();
  return false;
}


window.timer = {
  _timer: { lastTick:null, handle:null, running:false },
  _class: 'timer',
  _threshold_fn : null,
  _threshold_fn_executed : false,
  _elements: {},
  _lang: {
    ago: ':time ago',
    from_now: ':time from now'
  },
  init: function(lang,clas)
  {
    var self = this;
    if(lang)
      this._lang = lang;

    //collect all timer elements
    $("."+self._class).each(function(i){
      self._elements[i] = this;
    })
    self._tick();
    this._timer.handle = setInterval(function (evt) {self._tick()}, 1000);
    return this;
  },
  /*onThresholdChange: function(fn) {
    this._threshold_fn = fn;
  },*/
  reinit: function() {
    var self = this;
    var elements = {};
    $("."+self._class).each(function(i){
      elements[i] = this;
    });
    this._elements = elements;
    //console.log(this._elements);
  },
  _tick: function () {
    var self = this;
    var elements = this._elements;
    $.each(elements,function(i,v){
      self.update(v);
    })
  },
  update: function(el) {
    var atomstring = $(el).data('atomstring');
    var thresholdcallback = $(el).data('thresholdcallback');
    var now = new Date().getTime();
    var deadline = new Date(atomstring).getTime();
    var t = deadline - now;
    var isup = (t<0);

    if(isup)
    {
      if(!this._threshold_fn_executed)
      {
        this._threshold_fn_executed = true;
        if(thresholdcallback) window[thresholdcallback](el);//execute callback function
      }
    }
    t = Math.abs(t);
    var days = Math.floor(t / (1000 * 60 * 60 * 24));
    var hours = Math.floor((t%(1000 * 60 * 60 * 24))/(1000 * 60 * 60));
    var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((t % (1000 * 60)) / 1000);
    var str = '';
    if(t>0)
    {
      str += (days > 0) ? days+'d ':'';
      str += (hours > 0) ? hours+'h ':'';
      str += (minutes > 0) ? minutes+'m ':'';
      if(hours == 0)
        str += (seconds > 0) ? seconds+'s ':'';
    }
    if(str == '')
      str = '0s';
    if(isup)
      $(el).html(this._lang.ago.replace(':time',str));
    else
      $(el).html(this._lang.from_now.replace(':time',str));
  }
};
