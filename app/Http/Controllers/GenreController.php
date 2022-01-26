<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
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
      if(!$user->canmodel('access','Genre')) abort(403);

      $limit = 50;

      $genres = new Genre;

      if($request->input('naziv'))
      {
        $genres = $genres->where('naziv','like',$request->input('naziv').'%');
      }

      $genres = $genres->sortable(['naziv' => 'asc'])->paginate($limit)->appends($request->except('page'));

      return view('genre.index', compact('genres', 'request'));
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
      if(!$user->canmodel('create','Genre')) abort(403);

      $genre = new Genre;
      return view('genre.create', compact('genre'));
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
      if(!$user->canmodel('create','Genre')) abort(403);

      $request->validate(Genre::$rules);

      $genre = Genre::create($request->all());

      return redirect()->route('genres.show',$genre->id)->with('success', 'Uspješno kreirano');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $user = auth()->user();
      if(!$user) abort(403);

      $genre = Genre::findOrFail($id);

      if(!$user->canmodel('view','Genre',$genre)) abort(403);

      return view('genre.show', compact('genre'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $user = auth()->user();
      if(!$user) abort(403);

      $genre = Genre::findOrFail($id);

      if(!$user->canmodel('edit','Genre',$genre)) abort(403);

      return view('genre.edit', compact('genre'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Genre $genre)
    {
      $user = auth()->user();
      if(!$user) abort(403);
      if(!$user->canmodel('edit','Genre',$genre)) abort(403);

      $request->validate(Genre::$rules);

      $genre->update($request->all());

      return redirect()->route('genres.index')->with('success', 'Ažurirano');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $user = auth()->user();
      if(!$user) abort(403);

      $genre = Genre::findOrFail($id);

      if(!$user->canmodel('edit','Genre',$genre)) abort(403);

      $deletecheck = $genre->deletecheck();
      if(!$deletecheck['can'])
      {
        return redirect()->route('genres.index')->with('error', $deletecheck['message']);
      }

      $genre->delete();

      return redirect()->route('genres.index')->with('success', 'Obrisano');
    }
}
