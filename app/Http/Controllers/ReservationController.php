<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
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
      if(!$user->canmodel('access','Reservation')) abort(403);

      $limit = 50;

      $reservations = new Reservation;

      $reservations = $reservations->sortable(['show_id' => 'asc'])->paginate($limit)->appends($request->except('page'));

      return view('reservation.index', compact('reservations', 'request'));
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
      if(!$user->canmodel('create','Reservation')) abort(403);

      $reservation = new Reservation;
      return view('reservation.create', compact('reservation'));
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
      if(!$user->canmodel('create','Reservation')) abort(403);

      $request->validate(Reservation::$rules);

      $reservation = Reservation::create($request->all());

      return redirect()->route('reservations.show',$reservation->id)->with('success', 'Uspješno kreirano');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $user = auth()->user();
      if(!$user) abort(403);

      $reservation = Reservation::findOrFail($id);

      if(!$user->canmodel('view','Reservation',$reservation)) abort(403);

      return view('reservation.show', compact('reservation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $user = auth()->user();
      if(!$user) abort(403);

      $reservation = Reservation::findOrFail($id);

      if(!$user->canmodel('edit','Reservation',$reservation)) abort(403);

      return view('reservation.edit', compact('reservation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
      $user = auth()->user();
      if(!$user) abort(403);
      if(!$user->canmodel('edit','Reservation',$reservation)) abort(403);

      $request->validate(Reservation::$rules);

      $reservation->update($request->all());

      return redirect()->route('reservations.index')->with('success', 'Ažurirano');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $user = auth()->user();
      if(!$user) abort(403);

      $reservation = Reservation::findOrFail($id);

      if(!$user->canmodel('edit','Reservation',$reservation)) abort(403);

      $deletecheck = $reservation->deletecheck();
      if(!$deletecheck['can'])
      {
        return redirect()->route('reservations.index')->with('error', $deletecheck['message']);
      }

      $reservation->delete();

      return redirect()->route('reservations.index')->with('success', 'Obrisano');
    }
}
