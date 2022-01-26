<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Loaders\Detektorproblema;
use Spatie\Activitylog\Models\Activity;
use App\Override\ActivityFormatter;
use Illuminate\Http\UploadedFile;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use File;

use Carbon\Carbon;

class DashboardController extends Controller
{
    private $user;
    private $disk = 'public'; //public or private

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
      $user = auth()->user();

      //ako je zaposlenik odmah mu prikazi njegov zaposlenik dashboard
      if(!$user->is_posjetitelj && !$user->is_administracija) return view('dashboard.zaposlenik',compact('user'));
      //ako je posjetitelj odmah mu prikazi njegov posjetitelj dashboard
      if($user->is_posjetitelj && !$user->is_administracija) return view('dashboard.posjetitelj',compact('user'));

      //ako je administrator odmah mu prikazi detaljni administratorski dashboard
      if($user->hasAdminAccess() || ($user->is_administracija && !$user->is_posjetitelj)) //return redirect()->route('dash.administracija');
      return view('dashboard.administracija',compact('user'));

      //ako nije admin niti zaposlenik niti posjetitelj prikazi ogoljeli welcome page gdje ne moze nista posebno vidjeti
      return view('dashboard.welcome');
    }

    /**
    * Vraca ispravni '404' page za korisnika u slucaju da korisnik nije dio akademske godine ili ne postoji aktivna AG.
    * @return Response view
    */
  /*  public function notmember_page($message, $tip_korisnika)
    {
      $user = $this->user;
      return view('dashboard.student_notmember',compact('user'));
      //abort(404);
      //TODO vratiti view sa message.
    }*/

    /*private function init_posjetitelj()
    {
      $this->user = auth()->user();
      if(!$this->user->is_posjetitelj) return redirect()->route('home');
    }*/

    /*private function init_zaposlenik()
    {
        $this->user = auth()->user();
        if($this->user->is_posjetitelj || ($this->$user->hasAdminAccess() || $this->$user->is_administracija)) return redirect()->route('home');
    }*/

    /*public function dashboard_zaposlenik(Request $request)
    {
      $r = $this->init_zaposlenik();
      if($r !== null)
        return $r;

      $today_start = Carbon::now()->startOfDay();
      $today_end = Carbon::now()->endOfDay();
      $user = $this->user;

      return view('dashboard.zaposlenik',compact('user'));
    }

    public function dashboard_posjetitelj(Request $request)
    {
      $r = $this->init_posjetitelj();
      if($r !== null)
        return $r;

      $today_start = Carbon::now()->startOfDay();
      $today_end = Carbon::now()->endOfDay();
      $user = $this->user;
      return view('dashboard.posjetitelj',compact('user'));
    }

    /**
    * Ovome mogu samo pristupiti samo administratori (zasticeno middlewareom)
    * @return Response view
    */
    /*public function dashboard_administracija(Request $request)
    {
      $user = $this->user;
      return view('dashboard.administracija',compact('user'));
    }*/

    public function ckeditor(Request $request)
    {
      $file = $request->file('upload');

      if(!$file)
        return $this->ckeditor_error('No file sent.');

      try {
        $image = Image::make($file);
        //$image->fit(1024, 1024)->encode('jpg', 90); //max 1024x1024
        // prevent possible upsizing
        $image->resize(null, 1024, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->encode('png', 90);
      } catch (\Throwable $e) {
        return $this->ckeditor_error('Unable to parse image, try different image');
      }

      $wysiwyg_path = Storage::disk($this->disk)->path('wysiwyg/'.date('Y_m'));
      if (!is_dir($wysiwyg_path))
         File::makeDirectory($wysiwyg_path, 0775, true);

      $rand = date('U');
      $imagelocalpath = 'wysiwyg/'.date('Y_m').'/'.$rand.'.png';
      if (Storage::disk($this->disk)->exists($imagelocalpath))
          Storage::disk($this->disk)->delete($imagelocalpath);

      $savedImage = $image->save(Storage::disk($this->disk)->path($imagelocalpath));

      return $this->ckeditor_success('/storage/'.$imagelocalpath);
    }

    /**
    * Ckeditor5 Sucessfull upload response.
    */
    private function ckeditor_success(string $image_url)
    {
      return response()->json([
        'url' => $image_url
      ]);
    }

    /**
    * Ckeditor5 error response.
    */
    private function ckeditor_error(string $msg)
    {
      return response()->json([
        'error' => ['message' => $msg]
      ]);
    }
}
