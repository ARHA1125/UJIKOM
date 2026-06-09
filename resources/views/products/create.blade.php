@extends('layouts.app')

@section('content')

<div class="content-box">

    <h4 class="mb-4">
        Tambah Barang Baru
    </h4>

    <form action="{{ route('products.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <div class="mb-4">

            <label class="form-label">
                Foto Barang
            </label>

            <div class="upload-box">

                <p>Klik untuk memilih foto</p>

                <input type="file"
                       name="foto"
                       class="form-control w-50">

            </div>

        </div>

        <div class="mb-3">

            <label>Nama Barang</label>

            <input type="text"
                   name="nama_barang"
                   class="form-control">

        </div>

        <div class="row">

            <div class="col-md-6">

                <label>Kategori</label>

                <select name="category_id"
                        class="form-control">

                    @foreach($categories as $category)

                    <option value="{{ $category->id }}">
                        {{ $category->nama_kategori }}
                    </option>

                    @endforeach

                </select>

            </div>

            <div class="col-md-6">

                <label>Stok</label>

                <input type="number"
                       name="stok"
                       class="form-control">

            </div>

        </div>

        <div class="row mt-3">

            <div class="col-md-6">

                <label>Harga</label>

                <input type="number"
                       name="harga"
                       class="form-control">

            </div>

            <div class="col-md-6">

                <label>Lokasi Simpan</label>

                <input type="text"
                       name="lokasi"
                       class="form-control">

            </div>

        </div>

        <div class="mt-3">

            <label>Deskripsi</label>

            <textarea name="deskripsi"
                      rows="4"
                      class="form-control"></textarea>

        </div>

        <div class="text-end mt-4">

            <a href="{{ route('products.index') }}"
               class="btn btn-secondary">

               Batal

            </a>

            <button class="btn btn-success">

                Simpan Barang

            </button>

        </div>

    </form>

</div>

@endsection