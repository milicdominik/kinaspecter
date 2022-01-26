<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use Illuminate\Http\Request;

class SeatController extends Controller
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
      if(!$user->canmodel('access','Seat')) abort(403);

      $limit = 50;

      $seats = new Seat;

      if($request->input('naziv'))
      {
        $seats = $seats->where('naziv','like',$request->input('naziv').'%');
      }

      if($request->input('hall_id'))
      {
        $seats = $seats->where('hall_id',$request->input('hall_id'));
      }

      $seats = $seats->sortable(['id' => 'asc'])->paginate($limit)->appends($request->except('page'));

      return view('seat.index', compact('seats', 'request'));
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
      if(!$user->canmodel('create','Seat')) abort(403);

      $seat = new Seat;
      return view('seat.create', compact('seat'));
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
      if(!$user->canmodel('create','Seat')) abort(403);

      $request->validate(Seat::$rules);

      $seat = Seat::create($request->all());

      return redirect()->route('seats.show',$seat->id)->with('success', 'Uspješno kreirano');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $user = auth()->user();
      if(!$user) abort(403);

      $seat = Seat::findOrFail($id);

      if(!$user->canmodel('view','Seat',$seat)) abort(403);

      return view('seat.show', compact('seat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $user = auth()->user();
      if(!$user) abort(403);

      $seat = Seat::findOrFail($id);

      if(!$user->canmodel('edit','Seat',$seat)) abort(403);

      return view('seat.edit', compact('seat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seat $seat)
    {
      $user = auth()->user();
      if(!$user) abort(403);
      if(!$user->canmodel('edit','Seat',$seat)) abort(403);

      $request->validate(Seat::$rules);

      $seat->update($request->all());

      return redirect()->route('seats.index')->with('success', 'Ažurirano');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $user = auth()->user();
      if(!$user) abort(403);

      $seat = Seat::findOrFail($id);

      if(!$user->canmodel('edit','Seat',$seat)) abort(403);

      $deletecheck = $seat->deletecheck();
      if(!$deletecheck['can'])
      {
        return redirect()->route('seats.index')->with('error', $deletecheck['message']);
      }

      $seat->delete();

      return redirect()->route('seats.index')->with('success', 'Obrisano');
    }
}
