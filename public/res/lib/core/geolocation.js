//Geolocation Utility by NetCom d.o.o.
// https://w3c.github.io/geolocation-api/
const ncxgeo_trackOptions = {
  enableHighAccuracy: true,
  maximumAge: 30000, //30000=30 seconds cache ttl
  timeout: 10000 //5000=5 sec to get locatio9n
};
var ncxgeo_watchId = null;

function ncxgeo_startTracking()
{

  if(!navigator.geolocation) {
    if(eval("typeof NetComAPIGeolocationError") !== "undefined")
      window["NetComAPIGeolocationError"]('unsupported');
    else
      alert('Geolocation is not supported by your browser');
    return;
  }
  ncxgeo_watchId = navigator.geolocation.watchPosition(ncxgeo_successCallback,ncxgeo_errorCallback,ncxgeo_trackOptions);
}

function ncxgeo_stopTracking() {
  navigator.geolocation.clearWatch(ncxgeo_watchId);
}

function ncxgeo_successCallback(position) {
  // Request finished in under 10 seconds...
  if(eval("typeof NetComAPIGeolocationSuccess") !== "undefined")
    window["NetComAPIGeolocationSuccess"](position);
  else
    console.warn('Warning: Global Function named "NetComAPIGeolocationSuccess(position)" does not exist in window scope.');

  //console.log('success',position);
  //$("#ts").text(Math.floor(Date.now() / 1000));
  //$("#la").text(position.coords.latitude);
  //$("#lo").text(position.coords.longitude);
  //$("#acc").text(position.coords.accuracy);
  //$("#al").text(position.coords.altitude);
  //$("#al_acc").text(position.coords.altitude);
  //$("#map").prop('href','/res/formelements/map/select.html?#lat='+position.coords.latitude+'&lng='+position.coords.longitude+'&id=latlng');
  //alert('Success: '+position.coords.latitude+' '+position.coords.longitude);
}

function ncxgeo_errorCallback(error) {
  if(eval("typeof NetComAPIGeolocationError") !== "undefined")
    window["NetComAPIGeolocationError"](error);
  else
  {
    console.warn('Warning: Global Function named "NetComAPIGeolocationError(position)" does not exist in window scope.');
    switch (error.code) {
      case GeolocationPositionError.TIMEOUT:
        // We didn't get it in a timely fashion.
        //ncxgeo_doFallback();
        // Acquire a new position object,
        // as long as it takes.
        //navigator.geolocation.getCurrentPosition(
        //  ncxgeo_successCallback, ncxgeo_errorCallback
        //);
        //alert('Geolocation request timed out');
        if(eval("typeof NetComAPIGeolocationErrorTimeout") !== "undefined")
          window["NetComAPIGeolocationErrorTimeout"](error);
        //else do nothing
        break;
      case GeolocationPositionError.PERMISSION_DENIED:
        if(eval("typeof NetComAPIGeolocationErrorPermissionDenied") !== "undefined")
          window["NetComAPIGeolocationErrorPermissionDenied"](error);
        else
          alert('No permission to use geolocation on your device');
        break;
      case GeolocationPositionError.POSITION_UNAVAILABLE:
        if(eval("typeof NetComAPIGeolocationErrorPositionUnavailable") !== "undefined")
          window["NetComAPIGeolocationErrorPositionUnavailable"](error);
        else
          alert('Location position not available');
        break;
    }
  }
}
