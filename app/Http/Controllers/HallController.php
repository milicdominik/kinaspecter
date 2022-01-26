<?php

namespace App\Http\Controllers;

use App\Models\Hall;
use Illuminate\Http\Request;
use App\Models\Seat;

/**
 * Class HallController
 * @package App\Http\Controllers
 */
class HallController extends Controller
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
      if(!$user->canmodel('access','Hall')) abort(403);

      $limit = 50;

      $halls = new Hall;

      if($request->input('naziv'))
      {
        $halls = $halls->where('naziv','like',$request->input('naziv').'%');
      }

      $halls = $halls->sortable(['id' => 'asc'])->paginate($limit)->appends($request->except('page'));

      /*$halls = Hall::select('id', 'naziv');

      $halls = $halls->sortable(['naziv' => 'asc'])->paginate($limit)->appends($request->except('page'));*/

      return view('hall.index', compact('halls', 'request'));
      //return view('hall.index', compact('halls','request'));
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
      if(!$user->canmodel('create','Hall')) abort(403);

      $hall = new Hall;
      return view('hall.create', compact('hall'));
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
      if(!$user->canmodel('create','Hall')) abort(403);

      $request->validate(Hall::$rules);

      $hall = Hall::create($request->all());

      /*$input = $request->all();
      $input['is_izborni'] = $request->input('is_izborni') ? true:false;
      if(empty($input['ispiti'])) $input['ispiti'] = '';
      $hall = Hall::create($input);       $hall->update($input);*/

      /*DB::beginTransaction();
      $seat = Seat::create($input);
      $seat->dvorane()->sync($predavaciINositelji);
      $seat->vrstenastave_predvidjenosati()->sync($vrstemastaveSati);
      DB::commit();*/

      return redirect()->route('halls.show',$hall->id)->with('success', 'Uspješno kreirano');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hall  $hall
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $user = auth()->user();
      if(!$user) abort(403);

      $hall = Hall::findOrFail($id);

      if(!$user->canmodel('view','Hall',$hall)) abort(403);

      return view('hall.show', compact('hall'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hall  $hall
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $user = auth()->user();
      if(!$user) abort(403);

      $hall = Hall::findOrFail($id);

      if(!$user->canmodel('edit','Hall',$hall)) abort(403);

      return view('hall.edit', compact('hall'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hall  $hall
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hall $hall)
    {
      $user = auth()->user();
      if(!$user) abort(403);
      if(!$user->canmodel('edit','Hall',$hall)) abort(403);

      $request->validate(Hall::$rules);

      $hall->update($request->all());

      return redirect()->route('halls.index')->with('success', 'Ažurirano');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hall  $hall
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $user = auth()->user();
      if(!$user) abort(403);

      $hall = Hall::findOrFail($id);

      if(!$user->canmodel('edit','Hall',$hall)) abort(403);

      $deletecheck = $hall->deletecheck();
      if(!$deletecheck['can'])
      {
        return redirect()->route('halls.index')->with('error', $deletecheck['message']);
      }

      $hall->delete();

      return redirect()->route('halls.index')->with('success', 'Obrisano');
    }
}
