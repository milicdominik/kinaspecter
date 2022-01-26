<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PublicsiteController extends Controller
{
    public function index()
    {
        return view('publicsite.index');
    }

    public function onama()
    {
        return view('publicsite.onama');
    }

    public function galerija()
    {
        return view('publicsite.galerija');
    }

    public function dvorane()
    {
        return view('publicsite.dvorane');
    }

    public function mala()
    {
        return view('publicsite.mala');
    }

    public function srednja()
    {
        return view('publicsite.srednja');
    }

    public function velika()
    {
        return view('publicsite.velika');
    }

    public function vip()
    {
        return view('publicsite.vip');
    }

    public function cjenik()
    {
        return view('publicsite.cjenik');
    }

    public function kontakt()
    {
        return view('publicsite.kontakt');
    }

    public function politika_privatnosti()
    {
      return view('misc.politika_privatnosti');
    }
}
