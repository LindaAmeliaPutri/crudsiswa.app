<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
//fungsi untuk mengarahkan ke halamn index sisa
public function index(){ 
    return view ('siswa.index');
}

//fungsi untuk mengarahkan ke halaman create
public function create(){
    return view('siswa.create'); 

}

    public function store(Request $request){
    //validasi data
       $validated= $request->validate([
        'name'         =>'required',
        'nisn'         =>'required | unique:users,nisn',
        'alamat'       =>'required',
        'email'        =>'required | unique:users,email',
        'password'     =>'required',
        'no_handphone' =>'required | unique:users,no_handphone'
    ]);



    //siapa data yang akan di masukan 
     $datasiswa_store=[
        'clas_id'      =>$request-> clas_id,
        'photo'        =>'poto.jpg',
        'name'         =>$request-> name,
        'nisn'         =>$request-> nisn,
        'alamat'       =>$request-> alamat,
        'email'        =>$request-> email,
        'password'     =>$request-> password,
        'no_handphone' =>$request-> no_handphone
        ];
        //masukan data ke dalam tabel user
User::create($datasiswa_store);

//arahkan user ke halaman beranda
        return redirect('/');
    }
}
