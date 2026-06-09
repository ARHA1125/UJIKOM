@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Detail Barang</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">

    <h2>Detail Barang</h2>

    <div class="card">

        <div class="card-body">

            @if($product->foto)

                <div class="mb-3">
                    <img src="{{ asset('storage/'.$product->foto) }}"
                         width="250">
                </div>

            @endif

            <table class="table">

                <tr>
                    <th width="200">Nama Barang</th>
                    <td>{{ $product->nama_barang }}</td>
                </tr>

                <tr>
                    <th>Kategori</th>
                    <td>{{ $product->category->nama_kategori }}</td>
                </tr>

                <tr>
                    <th>Harga</th>
                    <td>
                        Rp {{ number_format($product->harga,0,',','.') }}
                    </td>
                </tr>

                <tr>
                    <th>Stok</th>
                    <td>{{ $product->stok }}</td>
                </tr>

                <tr>
                    <th>Deskripsi</th>
                    <td>{{ $product->deskripsi }}</td>
                </tr>

            </table>

            <button
                type="button"
                class="btn btn-secondary"
                onclick="history.back()">

                Kembali

            </button>

        </div>

    </div>

</div>

</body>
</html>
@endsection