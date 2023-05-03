<?php
namespace App\Http\Controllers;
use App\Models\Mahasiswa;
use App\Models\kelas;
use App\Models\Mahasiswa_MataKuliah;
use App\Models\Matakuliah;
use Illuminate\Http\Request;
class MahasiswaController extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function index()
{
//Fungsi eloquent menampilkan data menggunakan pagination
$mahasiswas = Mahasiswa::paginate(5); //Mengambil 5 isi tabel
return view('mahasiswas.index', compact('mahasiswas'));
}
/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function create()
{
     $kelas = kelas::all(); //mendapatkan data dari table kelas
     return view('mahasiswas.create',['kelas' => $kelas]);
}
/**
* Store a newly created resource in storage.
*
* @param \Illuminate\Http\Request $request
* @return \Illuminate\Http\Response
*/
public function store(Request $request)
{
// Melakukan validasi data
$request->validate([
'Nim' => 'required',
'Nama' => 'required',
'Tanggal_Lahir' => 'required',
'Kelas' => 'required',
'Jurusan' => 'required',
'No_Handphone' => 'required',
'Email' => 'required',
]);
// fungsi eloquent untuk menambah data
$mahasiswa= new Mahasiswa;
$mahasiswa->Nim=$request->get('Nim');
$mahasiswa->Nama=$request->get('Nama');
$mahasiswa->Tanggal_Lahir=$request->get('Tanggal_Lahir');
$mahasiswa->Jurusan=$request->get('Jurusan');
$mahasiswa->No_Handphone=$request->get('No_Handphone');
$mahasiswa->Email=$request->get('Email');

//fungsi eloquent untuk menambah data dengan relasi belongs to
$kelas = new kelas;
$kelas->id = $request->get('Kelas');

$mahasiswa->kelas()->associate($kelas);
$mahasiswa->save();

// Jika data berhasil ditambahkan, akan kembali ke halaman utama
return redirect()->route('mahasiswas.index')
->with('success', 'Mahasiswa Berhasil Ditambahkan');
}
/**
* Display the specified resource.
*
* @param int $id
* @return \Illuminate\Http\Response
*/
public function show($Nim)
{
//menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa
$Mahasiswa = Mahasiswa::find($Nim);
return view('mahasiswas.detail', compact('Mahasiswa'));
}
/**
* Show the form for editing the specified resource.
*
* @param int $id
* @return \Illuminate\Http\Response
*/
public function edit($Nim)
{
// menampilkan detail data dengan menemukan berdasarkan Nim Mahasiswa untuk diedit
$Mahasiswa = Mahasiswa::find($Nim);
$kelas = kelas::all();
return view('mahasiswas.edit', compact('Mahasiswa', 'kelas'));
}

/**
* Update the specified resource in storage.
*
* @param \Illuminate\Http\Request $request
* @param int $id
* @return \Illuminate\Http\Response
*/
public function update(Request $request, $Nim)
{
// melakukan validasi data
$request->validate([
     'Nim' => 'required',
     'Nama' => 'required',
     'Tanggal_Lahir' => 'required',
     'Kelas' => 'required',
     'Jurusan' => 'required',
     'No_Handphone' => 'required',
     'Email' => 'required',
]);
// fungsi eloquent untuk mengupdate data inputan kita
$mahasiswa=Mahasiswa::find($Nim);
$mahasiswa->Nim=$request->get('Nim');
$mahasiswa->Nama=$request->get('Nama');
$mahasiswa->Tanggal_Lahir=$request->get('Tanggal_Lahir');
$mahasiswa->Jurusan=$request->get('Jurusan');
$mahasiswa->No_Handphone=$request->get('No_Handphone');
$mahasiswa->Email=$request->get('Email');

$kelas = new Kelas;
$kelas->id = $request->get('Kelas');

$mahasiswa->kelas()->associate($kelas);
$mahasiswa->save;

// jika data berhasil diupdate, akan kembali ke halaman utama
return redirect()->route('mahasiswas.index')
->with('success', 'Mahasiswa Berhasil Diupdate');
}
/**
* Remove the specified resource from storage.
*
* @param int $id
* @return \Illuminate\Http\Response
*/
public function destroy($Nim)
{
//fungsi eloquent untuk menghapus data
     Mahasiswa::find($Nim)->delete();
     return redirect()->route('mahasiswas.index')
          ->with('success', 'Mahasiswa Berhasil Dihapus');
     }

     public function search(Request $request)
{
     $keyword = $request->search;
     $mahasiswas = Mahasiswa::where('Nama', 'like', '% . $keyword'. '%')->paginate(5);
     return view('mahasiswas.index', compact('mahasiswas'))->with('i', (request()->input('page', 1) - 1) * 5);
}

public function nilai($Nim)
    {
        $Mahasiswa = Mahasiswa::find($Nim);
        $Matakuliah = Matakuliah::all();
        $Mahasiswa_MataKuliah = Mahasiswa_MataKuliah::where('mahasiswa_id','=',$Nim)->get();
        return view('mahasiswas.nilai',['Mahasiswa' => $Mahasiswa],['MahasiswaMataKuliah' => $Mahasiswa_MataKuliah], compact('Mahasiswa_MataKuliah'));
    }
};