@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Data Kategori</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2>Data Kategori</h2>

    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">
        Tambah Kategori
    </a>

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nama Kategori</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>

        @foreach($categories as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->nama_kategori }}</td>
            <td>{{ $item->deskripsi }}</td>
            <td>

                <a href="{{ route('categories.edit',$item->id) }}"
                   class="btn btn-warning btn-sm">
                   Edit
                </a>

                <form action="{{ route('categories.destroy',$item->id) }}"
                      method="POST"
                      style="display:inline">

                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger btn-sm"
                        onclick="return confirm('Yakin ingin menghapus data ini?')">
                        Hapus
                    </button>

                </form>

            </td>
        </tr>
        @endforeach

    </table>

</div>

</body>
</html>
@endsection