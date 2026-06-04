@extends('main')

@section('title', 'Update Mahasiswa')
@section('content')

<form action="{{route('mahasiswas.update', $mahasiswa->id)}}" method="post">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="">Nama</label>
        <input type="text" name="nama" class="form-control" value="{{old('nama')}}">
    </div>
    @error('nama')
        <div class="text-danger">
            {{$message}}
        </div>
    @enderror

    <div class="form-group">
        <label for="">NPM</label>
        <input type="text" name="npm" class="form-control" value="{{old('npm')}}">
    </div>
    @error('npm')
        <div class="text-danger">
            {{$message}}
        </div>
    @enderror
    
    
    <div class="form-group">
        <label for="">Foto</label>
        <input type="file" name="foto" class="form-control" value="{{old('foto')}}">
    </div>
    @error('foto')
        <div class="text-danger">
            {{$message}}
        </div>
    @enderror
    <div class="form-group">
        <label for="">Program Studi</label>
        <select name="prodi_id" class="form-control" id="">
            <option value="">Pilih Program Studi</option>
            @foreach($prodi as $row)
                <option value="{{$row->id}}" {{old('prodi_id') == $row->id ? 'selected' : ''}}>
                    {{$row->nama_prodi}}
                </option>
            @endforeach
        </select>
    </div>
    @error('prodi_id')
        <div class="text-danger">
            {{$message}}
        </div>
    @enderror

    <button type="submit" class="btn btn-primary mt-2">Simpan</button>
</form>
@endsection