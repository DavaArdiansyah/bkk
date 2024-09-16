<?php

namespace App\Http\Controllers\Halaman;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index () {
        return view ('profil.admin.index');
    }
}
