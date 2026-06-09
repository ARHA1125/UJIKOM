@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Data Barang</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">

    <h2>Data Barang Frozen Food</h2>

    <a href="{{ route('products.create') }}"
       class="btn btn-success mb-3">
       Tambah Barang
    </a>

    <table class="table table-bordered">

        <tr>
            <th>Foto</th>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>

        @foreach($products as $item)

        <tr>

            <td width="120">

                @if($item->foto)
                    <img src="{{ asset('storage/'.$item->foto) }}"
                         width="100">
                @endif

            </td>

            <td>{{ $item->nama_barang }}</td>

            <td>{{ $item->category->nama_kategori }}</td>

            <td>Rp {{ number_format($item->harga) }}</td>

            <td>{{ $item->stok }}</td>

            <td>

                <a href="{{ route('products.show',$item->id) }}"
                   class="btn btn-info btn-sm">
                    Detail
                </a>

                <a href="{{ route('products.edit',$item->id) }}"
                   class="btn btn-warning btn-sm">
                    Edit
                </a>

                <form action="{{ route('products.destroy',$item->id) }}"
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