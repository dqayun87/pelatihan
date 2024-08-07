<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Profiler\Profile;

class ProfileController extends Controller
{
    public function index($name,$umur=20,$alamat="malang"){
       return view('profile',compact('name','umur','alamat'));//compact untuk meneruskan variabel ke view 
        return view('Profile',[
            'nama_saya'=>$name,
            'umur_saya'=>$umur

        ]);
    }
}
