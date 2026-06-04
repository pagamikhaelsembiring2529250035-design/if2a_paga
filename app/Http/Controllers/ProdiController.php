<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         // mengambil data prodi yang berkaitan dengan 
        $prodis = Prodi::with('fakultas')->get();
        
        return view('prodis.index',compact(('prodis')));
        // kirim ke view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fakultas = Fakultas::all();
        return view('prodis.create',compact('fakultas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'nama_prodi' => 'required|unique:prodis', 
            'singkatan'=>'required',
            'kaprodi'=>'required',
            'fakultas_id'=>'required'
        ]);

        // simpan ke tabel prodi
        Prodi::create($input);
        
        // redirect ke route prodis.index
        return redirect()->route('prodis.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Prodi $prodi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($prodi)
    {

        $fakultas = Fakultas::all();
        $prodi = Prodi::find($prodi);
        
        return view('prodis.edit', compact('prodi', 'fakultas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prodi $prodi)
    {
        $input = $request->validate([
            'nama_prodi' => 'required|unique:prodis,nama_prodi,'.$prodi->id, 
            'singkatan'=>'required',
            'kaprodi'=>'required',
            'fakultas_id'=>'required'
        ]);
        // dd($input);
        // simpan perubahan data ke tabel prodi
        Prodi::where('id',$prodi->id)->update($input);
        
        return redirect()->route('prodis.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($prodi)
    {
        $prodi = Prodi::find($prodi);
        $prodi->delete();
        return redirect()->route('prodis.index');
    }
}
