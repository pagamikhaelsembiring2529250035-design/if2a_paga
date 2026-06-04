@extends('main')
@section('title','Program Studi')
    
@section('content')
    
<a href="{{route('prodis.create')}}" class="btn btn-primary mb-2">Tambah Prodi</a>


<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Nama Prodi</th>
        <th>Singkatan</th>
        <th>Kaprodi</th>
        <th>Fakultas</th>
        <th>Singkatan Fakultas</th>
        <th>Aksi</th>
    </tr>
    @foreach ($prodis as $key => $prodi)
        <tr>
            <td>{{$key + 1}}</td>
            <td>{{$prodi->nama_prodi}}</td>
            <td>{{$prodi->singkatan}}</td>
            <td>{{$prodi->kaprodi}}</td>
            <td>{{$prodi->fakultas->nama_fakultas?? '-'}}</td>
            <td>{{$prodi->fakultas->singkatan?? '-'}}</td>
            <td>
                <a href="{{route('prodis.edit', $prodi->id)}}" class="btn btn-warning btn-sm">Edit</a>
                <form method="POST" action="{{ route('prodis.destroy', $prodi->id) }}" class="d-inline">
                @csrf
                <input name="_method" type="hidden" value="DELETE">
                <button type="submit" class="btn btn-xs btn-danger btn-rounded show_confirm"
                    data-toggle="tooltip" title='Delete'
                    data-nama='{{ $prodi->tahun_akademik }}'>Hapus</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
@endsection
