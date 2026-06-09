@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <h3 class="mb-4">
        Dashboard Frozeria Stock
    </h3>

    <div class="row mb-4">

        <div class="col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5>Total Barang</h5>
                    <h2>{{ $totalBarang }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5>Total Kategori</h5>
                    <h2>{{ $totalKategori }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5>Stok Menipis</h5>
                    <h2>{{ $stokMenipis }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h5>Stok Habis</h5>
                    <h2>{{ $stokHabis }}</h2>
                </div>
            </div>
        </div>

    </div>

    <div class="card">

        <div class="card-body">

            <form method="GET">

                <div class="row">

                    <div class="col-md-5">

                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Cari Nama Barang..."
                            value="{{ request('search') }}"
                        >

                    </div>

                    <div class="col-md-4">

                        <select
                            name="category"
                            class="form-control">

                            <option value="">
                                Semua Kategori
                            </option>

                            @foreach($categories as $category)

                            <option
                                value="{{ $category->id }}"
                                {{ request('category') == $category->id ? 'selected' : '' }}>

                                {{ $category->nama_kategori }}

                            </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-3">

                        <button
                            class="btn btn-primary">

                            Cari

                        </button>

                        <a href="/"
                           class="btn btn-secondary">

                           Reset

                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>

    <div class="card mt-4">

        <div class="card-body">

            <table class="table table-bordered">

                <thead>

                    <tr>

                        <th>Foto</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($products as $product)

                    <tr>

                        <td width="120">

                            @if($product->foto)

                            <img
                                src="{{ asset('storage/'.$product->foto) }}"
                                width="100">

                            @endif

                        </td>

                        <td>
                            {{ $product->nama_barang }}
                        </td>

                        <td>
                            {{ $product->category->nama_kategori }}
                        </td>

                        <td>
                            Rp {{ number_format($product->harga,0,',','.') }}
                        </td>

                        <td>

                            @if($product->stok == 0)

                                <span class="badge bg-danger">
                                    Habis
                                </span>

                            @elseif($product->stok < 20)

                                <span class="badge bg-warning">
                                    Menipis ({{ $product->stok }})
                                </span>

                            @else

                                <span class="badge bg-success">
                                    {{ $product->stok }}
                                </span>

                            @endif

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="5"
                            class="text-center">

                            Data tidak ditemukan

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection