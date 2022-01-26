<?php

namespace App\Http\Controllers;

use App\Models\Show;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;

class ShowController extends Controller
{
    /**
    * Iz requesta uzima input i vrati array ['datum_i_vrijeme_odrzavanja'] Carbon instance
    * @return array [Carbon 'datum_i_vrijeme_odrzavanja']
    */
    private function parseDatumVrijemeFromRequest(Request $request) : array
    {
      $request->validate([
        'datum_odrzavanja' => 'required|date_format:'.config('kina.datetime_date'),
        'vrijeme_odrzavanja' => 'required|date_format:'.config('kina.datetime_time'),
      ]);
      $datum_i_vrijeme_odrzavanja = Carbon::createFromFormat(config('kina.datetime_date'). ' '.config('kina.datetime_time'), $request->input('datum_odrzavanja').' '.$request->input('vrijeme_odrzavanja'));
      return [
        'datum_i_vrijeme_odrzavanja' => $datum_i_vrijeme_odrzavanja
      ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $user = auth()->user();
      if(!$user) abort(403);
      if(!$user->canmodel('access','Show')) abort(403);

      $limit = 50;

      $shows = new Show;

      if($request->input('naziv'))
      {
        $shows = $shows->where('naziv','like',$request->input('naziv').'%');
      }
      if($request->input('hall_id'))
      {
        $shows = $shows->where('hall_id',$request->input('hall_id'));
      }
      if($request->input('datum_odrzavanja') && $request->input('vrijeme_odrzavanja'))
      {
        $datum_i_vrijeme_odrzavanja = $this->parseDatumVrijemeFromRequest($request);
        $shows = $shows->where('datum_i_vrijeme_odrzavanja',$datum_i_vrijeme_odrzavanja['datum_i_vrijeme_odrzavanja']);
      }

      $shows = $shows->sortable(['datum_i_vrijeme_odrzavanja' => 'asc'])->paginate($limit)->appends($request->except('page'));

      return view('show.index', compact('shows', 'request'));
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
      if(!$user->canmodel('create','Show')) abort(403);

      $show = new Show;
      return view('show.create', compact('show'));
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
      if(!$user->canmodel('create','Show')) abort(403);

      $request->validate(Show::$rules);

      //$show = Show::create($request->all());

      $datum_i_vrijeme_odrzavanja = $this->parseDatumVrijemeFromRequest($request);
      $input = $request->all();
      $input['datum_i_vrijeme_odrzavanja'] = $datum_i_vrijeme_odrzavanja['datum_i_vrijeme_odrzavanja'];
      //$input['trajanje'] = (int)$request->input('trajanje')+30;

      DB::beginTransaction();
      $show = Show::create($input);
      DB::commit();

      return redirect()->route('shows.show',$show->id)->with('success', 'Uspješno kreirano');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Show  $show
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $user = auth()->user();
      if(!$user) abort(403);

      $show = Show::findOrFail($id);

      if(!$user->canmodel('view','Show',$show)) abort(403);

      return view('show.show', compact('show'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Show  $show
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $user = auth()->user();
      if(!$user) abort(403);

      $show = Show::findOrFail($id);

      if(!$user->canmodel('edit','Show',$show)) abort(403);

      return view('show.edit', compact('show'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Show  $show
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Show $show)
    {
      $user = auth()->user();
      if(!$user) abort(403);
      if(!$user->canmodel('edit','Show',$show)) abort(403);

      $request->validate(Show::$rules);

      //$show->update($request->all());

      $datum_i_vrijeme_odrzavanja = $this->parseDatumVrijemeFromRequest($request);
      $input = $request->all();
      $input['datum_i_vrijeme_odrzavanja'] = $datum_i_vrijeme_odrzavanja['datum_i_vrijeme_odrzavanja'];
      //$input['trajanje'] = (int)$request->input('trajanje')+30;

      DB::beginTransaction();
      $show->update($input);
      DB::commit();

      return redirect()->route('shows.index')->with('success', 'Ažurirano');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Show  $show
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $user = auth()->user();
      if(!$user) abort(403);

      $show = Show::findOrFail($id);

      if(!$user->canmodel('edit','Show',$show)) abort(403);

      $deletecheck = $show->deletecheck();
      if(!$deletecheck['can'])
      {
        return redirect()->route('shows.index')->with('error', $deletecheck['message']);
      }

      $show->delete();

      return redirect()->route('shows.index')->with('success', 'Obrisano');
    }
}
