<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Siswa</title>
</head>
<body>
    <h1>halaman Data siswa</h1>
    <p>Data siswa jurusan pplg</p>
    <a href="/siswa/create">Tambah data</a>
    <table border ="1px">
            <thead>
                <tr>
                    <th>photo</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Alamat</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
               @foreach ($siswas as $siswa)
                <tr>
                    <td><img src="{{asset('storage/' .$siswa->photo) }}" alt="Photo Siswa" width="50"></td>
                    <td>{{$siswa->name}}</td>
                    <td>{{$siswa->clas->nama}}</td>
                    <td>{{$siswa->alamat}}</td>
                    <td>
                        <a href="">Edit</a>
                        <a href="">Detail</a>
                        <a onclick="return confirm('yakin?')" href="/siswa/delete/{{$siswa->id}}">Delete</a>
                    </td>
                </tr>
               @endforeach
            </tbody>
    </table>
</body>
</html>