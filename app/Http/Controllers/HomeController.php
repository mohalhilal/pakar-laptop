<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use App\Models\Kerusakan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect()->route('admin');
        } else {

            return view('home');
        }
    }

    public function informasi()
    {
        $gejala = Gejala::all();
        $kerusakan = Kerusakan::all();

        return view('informasi', compact('gejala', 'kerusakan'))->with('act_aturan', 'aturan');
    }

    public function panduan()
    {
        return view('panduan');
    }
}
