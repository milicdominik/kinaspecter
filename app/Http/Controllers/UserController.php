<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Exceptions\Handler;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $user = auth()->user();
      if(!$user) abort(403);
      if(!$user->canmodel('access','User')) abort(403);

      $limit = 100;

      $users = new User;

      if($request->input('prezime'))
      {
        $users = $users->where('users.prezime','like',$request->input('prezime').'%');
      }
      if($request->input('ime'))
      {
        $users = $users->where('users.ime','like',$request->input('ime').'%');
      }
      if($request->input('oib'))
      {
        $users = $users->where('users.oib',$request->input('oib'));
      }

      $users = $users->sortable(['prezime' => 'asc'])->paginate($limit)->appends($request->except('page'));

      return view('user.index', compact('users','request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $user = auth()->user();
      if(!$user) abort(403);
      if(!$user->canmodel('create','User')) abort(403);

      $user = new User;
      return view('user.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $user = auth()->user();
      if(!$user) abort(403);
      if(!$user->canmodel('create','User')) abort(403);

      $request->validate(User::$rules);
      $request->validate([
        'email' => 'required|unique:users,email',
        'oib' => 'required|unique:users', //dogovoreno ovako
        //'oib' => ['required', 'unique:users,oib', new \App\Rules\Oib],
      ]);

      //$user = User::create($request->all());
      $user = new User;
      $user->name = Str::slug($request->input('prezime').' '.$request->input('ime'),'.');
      $user->ime = $request->input('ime');
      $user->prezime = $request->input('prezime');
      $user->email = $request->input('email');
      $user->oib = $request->input('oib');
      $user->mobitel = $request->input('mobitel');
      $user->dat_god_rodenja = Carbon::createFromFormat(config('kina.datetime_date'), $request->input('dat_god_rodenja'));

      if(empty($request->input('is_administracija')))
        $user->is_administracija = false;
      else
        $user->is_administracija = $request->input('is_administracija');
      if(empty($request->input('is_posjetitelj')))
        $user->is_posjetitelj = true;
      else
        $user->is_posjetitelj = $request->input('is_posjetitelj');

      $user->created_at = now();
      $user->updated_at = now();

      # Password
      if(!empty($request->input('password')))
      {
        $request->validate([
          'password' => 'required|string|min:6|confirmed',
          'password_confirmation' => 'required',
        ]);
        $user->password = Hash::make($request->input('password'));
      }
      else
      {
        //automatski generiraj.
        $user->password = Hash::make(123456);                      //Hash::make(\Str::random(8));
      }
      $user->save();

      return redirect()->route('users.show',$user->id)->with('success', 'Uspješno kreirano');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $user = auth()->user();
      if(!$user) abort(403);

      $user = User::findOrFail($id);

      if(!$user->canmodel('view','User',$user)) abort(403);

      return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $user = auth()->user();
      if(!$user || !$user->hasAdminAccess()) abort(403);

      if(!$user->hasAdminAccess()) {
        if(!$user->canmodel('edit','User',$user)) abort(403);
      }

      $user = User::findOrFail($id);

      return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
      $_user = auth()->user();
      if(!$_user || !$_user->hasAdminAccess()) abort(403);
      if(!$_user->hasAdminAccess()) {
        if(!$_user->canmodel('edit','User',$_user)) abort(403);
      }

      $request->validate(User::$rules);

      //$user->update($request->all());

      $user->name = Str::slug($request->input('prezime').' '.$request->input('ime'),'.');
      $user->ime = $request->input('ime');
      $user->prezime = $request->input('prezime');
      $user->email = $request->input('email');
      $user->oib = $request->input('oib');
      $user->mobitel = $request->input('mobitel');
      $user->dat_god_rodenja = Carbon::createFromFormat(config('kina.datetime_date'), $request->input('dat_god_rodenja'));

      if(empty($request->input('is_administracija')))
        $user->is_administracija = false;
      else
        $user->is_administracija = $request->input('is_administracija');
      if(empty($request->input('is_posjetitelj')))
        $user->is_posjetitelj = true;
      else
        $user->is_posjetitelj = $request->input('is_posjetitelj');

      $user->updated_at = now();

      # Password
      if(!empty($request->input('password')))
      {
        $request->validate([
          'password' => 'required|string|min:6|confirmed',
          'password_confirmation' => 'required',
        ]);
        $user->password = Hash::make($request->input('password'));
      }
      else
      {
        //automatski generiraj.
        $user->password = Hash::make(123456);                      //Hash::make(\Str::random(8));
      }
      $user->save();

      return redirect()->route('users.index')->with('success', 'Ažurirano');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $user = auth()->user();
      if(!$user || !$user->hasAdminAccess()) abort(403);

      if(!$user->hasAdminAccess()) {
        if(!$user->canmodel('edit','User',$user)) abort(403);
      }

      $user = User::findOrFail($id);

      $deletecheck = $user->deletecheck();
      if(!$deletecheck['can'])
      {
        return redirect()->route('users.index')->with('error', $deletecheck['message']);
      }

      $user->delete();

      return redirect()->route('users.index')->with('success', 'Obrisano');
    }

    public function adminaccessmodal()
    {
      $currentuser = auth()->user();
      if(!$currentuser) abort(403);
      if(!$currentuser->is_administracija) abort(403);

      return response()->json([
        'html' => view('user.modals.adminaccess',compact('currentuser'))->render(),
      ]);
    }

    public function adminaccess_enter(Request $request)
    {
      $currentuser = auth()->user();
      if(!$currentuser) abort(403);
      if(!$currentuser->is_administracija) abort(403);

      $password = $request->input('passwordrecheck');

      $hasher = app('hash');
      if ($hasher->check($password, $currentuser->password)) {
        $currentuser->enableAdminAccess();

        return redirect('dash');
      }
      abort(403,'Access denied');
    }

    public function adminaccess_leave()
    {
      $currentuser = auth()->user();
      if(!$currentuser) abort(403);
      $currentuser->disableAdminAccess();
      return redirect('dash');
    }

    /**
    * Izmjena lozinke (sam sebi) forma.
    */
    /*public function passwordchange()
    {
      $user = auth()->user();
      if(!$user) abort(403);
      return view('user.passwordchange',compact('user'));
    }

    /**
    * Izmjena lozinke (sam sebi)
    */
    /*public function passwordchange_update(Request $request)
    {
      $user = auth()->user();
      if(!$user) abort(403);

      $password = $request->input('trenutna_lozinka');

      $hasher = app('hash');
      if (!$hasher->check($password, $user->password))
        return back()->with('error', 'Trenutna lozinka nije valjana');

      $request->validate([
        'nova_lozinka' => 'required|string|min:6|confirmed',
        'nova_lozinka_confirmation' => 'required',
      ]);

      $user->password = Hash::make($request->input('nova_lozinka'));
      $user->save();

      return redirect()->route('profile.show',$user)->with('success','Lozinka je uspješno izmjenjena');
    }*/
}
