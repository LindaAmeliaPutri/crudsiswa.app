<?php

namespace App\Http\Controllers;

use App\Models\Clas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    public function index()
    {
        $siswas = User::all();
        return view('siswa.index', compact('siswas'));
    }

    public function create()
    {
        $clases = Clas::all();
        return view('siswa.create', compact('clases'));
    }

    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'kelas_id'      => 'required',
            'name'          => 'required',
            'nisn'          => 'required|unique:users,nisn',
            'alamat'        => 'required',
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required',
            'no_handphone'  => 'required|unique:users,no_handphone',
            'photo'         => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Siapkan data
        $datasiswa_store = [
            'clas_id'      => $request->kelas_id, // sesuaikan nama kolom di DB
            'name'         => $request->name,
            'nisn'         => $request->nisn,
            'alamat'       => $request->alamat,
            'email'        => $request->email,
            'password'     => bcrypt($request->password), // password di-hash
            'no_handphone' => $request->no_handphone,
        ];

        // Upload foto
        $datasiswa_store['photo'] = $request->file('photo')->store('profilesiswa', 'public');

        // Simpan ke DB
        User::create($datasiswa_store);

        return redirect('/')->with('success', 'Data siswa berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $datasiswa = User::find($id);

        if ($datasiswa) {
            Storage::disk('public')->delete($datasiswa->photo);
            $datasiswa->delete();
        }

        return redirect('/');
    }

    public function show($id)
    {
        $datauser = User::find($id);
        if (!$datauser) {
            return redirect('/');
        }
        return view('siswa.show', compact('datauser'));
    }

    public function edit($id)
    {
        $clases = Clas::all();
        $datauser = User::find($id);

        if (!$datauser) {
            return redirect('/');
        }

        return view('siswa.edit', compact('clases', 'datauser'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'          => 'required',
            'nisn'          => 'required',
            'alamat'        => 'required',
            'email'         => 'required',
            'no_handphone'  => 'required',
        ]);

        $datasiswa = User::find($id);

        $datasiswa_update = [
            'clas_id'      => $request->kelas_id,
            'name'         => $request->name,
            'nisn'         => $request->nisn,
            'alamat'       => $request->alamat,
            'email'        => $request->email,
            'no_handphone' => $request->no_handphone,
        ];

        if ($request->password) {
            $datasiswa_update['password'] = bcrypt($request->password);
        }

        if ($request->hasFile('photo')) {
            Storage::disk('public')->delete($datasiswa->photo);
            $datasiswa_update['photo'] = $request->file('photo')->store('profilesiswa', 'public');
        }

        $datasiswa->update($datasiswa_update);

        return redirect('/');
    }
}
