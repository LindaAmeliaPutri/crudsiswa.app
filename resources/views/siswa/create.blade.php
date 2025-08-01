<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
    <body>
    <h1>Tambahkan Data Siswa</h1>
    <p>Halaman Untuk Menambah Data Siswa</p>
        <form action="/siswa/store" method="POST">
            @csrf
            <div>
            <label>Class Id</label>
            <br>
            <select name ="clas_id">
                <option value="1">XII PPLG 1</option>
                <option value="2">XII PPLG 2</option>
                <option value="3">XII PPLG 3</option>
            </select>
            </div>
            <br>
            <div>
                <label>Nama</label>
                <br>
                <input type="text" name="name"> 
            </div>
            <br>
            <div>
                <div>
                <label>Nisn</label>
                <br>
                <input type="text" name="nisn"> 
            </div>
            <br>
            <div><div>
                <label>Alamat</label>
                <br>
                <input type="text" name="alamat"> 
            </div>
            <br>
            <div>
                <div>
                <label>Email</label>
                <br>
                <input type="text" name="email"> 
            </div>
            <br>
            <div>
                <div>
                <label>Password</label>
                <br>
                <input type="password" name="password"> 
            </div>
            <br>
            <div>
                <div>
                <label>No Telepon</label>
                <br>
                <input type="tel" name="no_handphone"> 
            </div>
            <br>

            <div>
                <div>
                <label>Foto</label>
                <br>
                <input type="file" name="photo"> 
            </div>
            <br>
            <div>
                <button type="submit"> simpan</button>
            </div>
            <div>
                <a href="/">Kembali</a>
            </div>
        </form>
    </body>
</html>