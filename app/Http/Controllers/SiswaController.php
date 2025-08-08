<?php

namespace App\Http\Controllers;


use App\Models\Clas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
//fungsi untuk mengarahkan ke halamn index sisa
public function index(){ 

    //siapakan data siswa / panggil data kelas
    $siswas = User::all();

    return view('siswa.index', compact('siswas')); 
    
}

//fungsi untuk mengarahkan ke halaman create
public function create(){
    //siapakan data / panggil data kelas
    $clases = Clas::all();
    return view('siswa.create', compact('clases'));

}

    public function store(Request $request){
    //validasi data
       $validated= $request->validate([
        'name'         =>'required',
        'kelas_id'     =>'required',
        'nisn'         =>'required | unique:users,nisn',
        'alamat'       =>'required',
        'email'        =>'required | unique:users,email',
        'password'     =>'required',
        'no_handphone' =>'required | unique:users,no_handphone',
        'photo'        =>'required |image|mimes:jpeg,png,jpg,gif',
    ]);



    //siapa data yang akan di masukan 
     $datasiswa_store=[
        'clas_id'      =>$request->kelas_id,
        'name'         =>$request->name,
        'nisn'         =>$request->nisn,
        'alamat'       =>$request->alamat,
        'email'        =>$request->email,
        'password'     =>$request->password,
        'no_handphone' =>$request->no_handphone
        ];

        //upload gambar 
        $datasiswa_store['photo'] =$request->file('photo')->store('profilesiswa', 'public');
    
        //masukan data ke dalam tabel user
        User::create($datasiswa_store);

        //arahkan user ke halaman beranda
        return redirect('/')->with('success', 'Data Siswa Berhasil Disi,pan');
    }

    //fungsi untuk delete data siswa
    public function destroy($id){
    //cari data user di database ada atau tidak
    $datasiswa = User::find($id);

    //cek apakah data user ada atau tidak
     if ($datasiswa != null){
      Storage::disk('public')->delete($datasiswa->photo);
      $datasiswa->delete();
}

//kembalukan user ke home/beranda
return redirect('/');

}

// untuk menampilkan view detail siswa
public function show($id){
    // dd("Berhasil");

    $datauser = User::find($id);

    if($datauser == null ) {
        return redirect('/');
    }


    //kembali ke user ke halaman show dan kirimkan data user yang di ambil berdasarkan id
    return view('siswa.show', compact('datauser'));
}
}



