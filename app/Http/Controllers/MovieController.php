<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
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
      if(!$user->canmodel('access','Movie')) abort(403);

      $limit = 50;

      $movies = new Movie;

      if($request->input('naslov'))
      {
        $movies = $movies->where('naslov','like',$request->input('naslov').'%');
      }
      if($request->input('redatelj'))
      {
        $movies = $movies->where('redatelj','like',$request->input('redatelj').'%');
      }
      if($request->input('genre_id'))
      {
        $movies = $movies->where('genre_id',$request->input('genre_id'));
      }

      $movies = $movies->sortable(['godina_izlaska' => 'desc'])->paginate($limit)->appends($request->except('page'));

      return view('movie.index', compact('movies','request'));
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
      if(!$user->canmodel('create','Movie')) abort(403);

      $movie = new Movie;
      return view('movie.create', compact('movie'));
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
      if(!$user->canmodel('create','Movie')) abort(403);

      $request->validate(Movie::$rules);

      //$movie = Movie::create($request->all());
      $movie = new Movie;
      $movie->naslov = $request->input('naslov');
      $movie->redatelj = $request->input('redatelj');
      $movie->genre_id = $request->input('genre_id');
      $movie->trajanje = $request->input('trajanje');
      $movie->godina_izlaska = $request->input('godina_izlaska');
      $movie->uloge = $request->input('uloge');
      if(empty($request->input('opis')))
        $movie->opis = '';
      else
        $movie->opis = $request->input('opis');
      $movie->save();

      return redirect()->route('movies.show',$movie->id)->with('success', 'Uspješno kreirano');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $user = auth()->user();
      if(!$user) abort(403);

      $movie = Movie::findOrFail($id);

      if(!$user->canmodel('view','Movie',$movie)) abort(403);

      return view('movie.show', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $user = auth()->user();
      if(!$user) abort(403);

      $movie = Movie::findOrFail($id);

      if(!$user->canmodel('edit','Movie',$movie)) abort(403);

      return view('movie.edit', compact('movie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
      $user = auth()->user();
      if(!$user) abort(403);
      if(!$user->canmodel('edit','Movie',$movie)) abort(403);

      $request->validate(Movie::$rules);

      //$movie->update($request->all());
      $movie->naslov = $request->input('naslov');
      $movie->redatelj = $request->input('redatelj');
      $movie->genre_id = $request->input('genre_id');
      $movie->trajanje = $request->input('trajanje');
      $movie->godina_izlaska = $request->input('godina_izlaska');
      $movie->uloge = $request->input('uloge');
      if(empty($request->input('opis')))
        $movie->opis = '';
      else
        $movie->opis = $request->input('opis');
      $movie->save();

      return redirect()->route('movies.index')->with('success', 'Ažurirano');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $user = auth()->user();
      if(!$user) abort(403);

      $movie = Movie::findOrFail($id);

      if(!$user->canmodel('edit','Movie',$movie)) abort(403);

      $deletecheck = $movie->deletecheck();
      if(!$deletecheck['can'])
      {
        return redirect()->route('movies.index')->with('error', $deletecheck['message']);
      }

      $movie->delete();

      return redirect()->route('movies.index')->with('success', 'Obrisano');
    }
}
