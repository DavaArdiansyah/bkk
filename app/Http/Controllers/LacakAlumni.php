<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;

class LacakAlumni extends Controller
{
    public function index ()
    {
        $data = Alumni::all();
        return view ('lacak-alumni', compact('data'));
    }
}
