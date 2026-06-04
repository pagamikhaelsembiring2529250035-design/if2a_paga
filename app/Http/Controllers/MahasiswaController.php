<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Prodi;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // akses tabel mahasiswa
        $mahasiswa = Mahasiswa::with('prodi')->get();

        // kirim data ke view
        return view('mahasiswa.index',compact('mahasiswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prodi = Prodi::all();
        return view('mahasiswa.create',compact('prodi'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'nama' => 'required',
            'npm' => 'required|unique:mahasiswas,npm',
            'prodi_id' => 'required|exists:prodis,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        // upload foto
        if($request->hasFile('foto')) {
            $foto = $request->file('foto'); // amnil file foto
            $nama_foto = time() . '_' . $foto->getClientOriginalName(); // buat nama unik untuk foto
            $foto->storeAS('fotos',$nama_foto, 'public'); // simpan di folder storage/app/fotos
        } else{
            $nama_foto = null; // jika tidak ada  foto, set nama_foto ke null
        }
        $input['foto'] = $nama_foto; // tambahkan nama_foto ke data inputd
        // simpan data ke tabel mahasiswa
        Mahasiswa::create($input);
        
        // redirect ke route mahasiswas.index
        return redirect()->route('mahasiswas.index')->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        
        $prodi = Prodi::all();
        $mahasiswa = Mahasiswa::find($mahasiswa);
        
        return view('mahasiswa.edit', compact('mahasiswa', 'prodi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $input = $request->validate([
           'nama' => 'required',
            'npm' => 'required|unique:mahasiswas,npm' .$mahasiswa->id ,
            'prodi_id' => 'required|exists:prodis,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        // dd($input);
        // simpan perubahan data ke tabel prodi
        Prodi::where('id',$mahasiswa->id)->update($input);
        
        return redirect()->route('prodis.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($mahasiswa)
    {
        $mahasiswa = Mahasiswa::find($mahasiswa);
        $mahasiswa->delete();
        return redirect()->route('mahasiswas.index');
    }
}
