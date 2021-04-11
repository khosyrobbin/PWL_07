<?php

namespace App\Http\Controllers;
use App\Models\Mahasiswa;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Database\Seeders\MahasiswaSeeder;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mahasiswas = Mahasiswa::with('kelas')->get();//mengambil semua isi tabel
        $post = Mahasiswa::orderBy('nim', 'desc')->paginate (6);
        return view ('mahasiswas.index', compact('mahasiswas'));
        with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mahasiswas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validasi data
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'no_handphone' => 'required',
            'email' => 'required',
            'tanggal_lahir' => 'required'
        ]);

        $Mahasiswa = new Mahasiswa;
        $Mahasiswa->nim = $request->get('nim');
        $Mahasiswa->nama = $request->get('nama');
        $Mahasiswa->jurusan = $request->get('jurusan');
        $Mahasiswa->no_handphone = $request->get('no_handphone');
        $Mahasiswa->email = $request->get('email');
        $Mahasiswa->tanggal_lahir = $request->get('tanggal_lahir');
        $Mahasiswa->save();

        $kelas = new Kelas;
        $kelas->id = $request->get('kelas');
        //menambah data
        // Mahasiswa::create($request->all());
        $Mahasiswa->kelas()->associate($kelas);
        $Mahasiswa->save();

        //Jika berhasil input data-> kembali ke home
        return redirect()->route('mahasiswa.index')->with('sucsess', 'Mahasiswa berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nim)
    {
        //show data dengan mengurutkan nim
        $Mahasiswa = Mahasiswa::with('kelas')->where('nim',$nim)->first();
        return view('mahasiswas.detail', ['Mahasiswa'=>$Mahasiswa]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($nim)
    {
        //menampilkan detail data berdasarkan nim untuk diedit
        $Mahasiswa = Mahasiswa::with('kelas')->where('nim',$nim)->first();
        $kelas = Kelas::all();
        return view('mahasiswas.edit', compact('Mahasiswa','kelas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nim)
    {
        //validasi data
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'no_handphone' => 'required',
            'email' => 'required',
            'tanggal_lahir' => 'required'
        ]);
        
        $Mahasiswa = Mahasiswa::with('kelas')->where('nim',$nim)->first();
        $Mahasiswa->nim = $request->get('nim');
        $Mahasiswa->nama = $request->get('nama');
        $Mahasiswa->jurusan = $request->get('jurusan');
        $Mahasiswa->no_handphone = $request->get('no_handphone');
        $Mahasiswa->email = $request->get('email');
        $Mahasiswa->tanggal_lahir = $request->get('tanggal_lahir');
        $Mahasiswa->save();

        $kelas = new Kelas;
        $kelas->id = $request->get('kelas');

        $Mahasiswa->kelas()->associate($kelas);
        $Mahasiswa->save();
        //update data inputan kita
        //Mahasiswa::find($nim)->update($request->all());

        //jika berhasil -> home
        return redirect()->route('mahasiswa.index')->with('sucsess', 'Mahasiswa berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($nim)
    {
        //menghapus data
        Mahasiswa::find($nim)->delete();
        return redirect()->route('mahasiswa.index')->with('sucsess', 'Mahasiswa berhasil diupsate');
    }

    public function search(Request $request){
        $search=$request->cari;
        $Mahasiswa = Mahasiswa::where('nama','like',"%".$search."%")->get();
        return view('mahasiswas.index',['Mahasiswas'=>$Mahasiswa]);
    }


}
