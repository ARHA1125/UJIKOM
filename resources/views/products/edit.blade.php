
@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Edit Barang</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">

    <h2>Edit Barang</h2>

    <form action="{{ route('products.update', $product->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Kategori</label>

            <select name="category_id" class="form-control">

                @foreach($categories as $category)

                <option value="{{ $category->id }}"
                    {{ $product->category_id == $category->id ? 'selected' : '' }}>

                    {{ $category->nama_kategori }}

                </option>

                @endforeach

            </select>
        </div>

        <div class="mb-3">
            <label>Nama Barang</label>

            <input type="text"
                   name="nama_barang"
                   class="form-control"
                   value="{{ $product->nama_barang }}">
        </div>

        <div class="mb-3">
            <label>Harga</label>

            <input type="number"
                   name="harga"
                   class="form-control"
                   value="{{ $product->harga }}">
        </div>

        <div class="mb-3">
            <label>Stok</label>

            <input type="number"
                   name="stok"
                   class="form-control"
                   value="{{ $product->stok }}">
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>

            <textarea name="deskripsi"
                      class="form-control"
                      rows="4">{{ $product->deskripsi }}</textarea>
        </div>

        <div class="mb-3">

            <label>Foto Lama</label><br>

            @if($product->foto)
                <img src="{{ asset('storage/'.$product->foto) }}"
                     width="150"
                     class="mb-2">
            @endif

        </div>

        <div class="mb-3">
            <label>Ganti Foto</label>

            <input type="file"
                   name="foto"
                   class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">
            Update
        </button>

        <a href="{{ route('products.index') }}"
           class="btn btn-secondary">
           Kembali
        </a>

    </form>

</div>

</body>
</html>
@endsection