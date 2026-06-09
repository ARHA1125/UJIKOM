@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <h3 class="mb-4">
        Dashboard Frozeria Stock
    </h3>

    <div class="row mb-4">

        <div class="col-md-3">
            <div class="card text-white bg-primary card-stat shadow">
                <div class="card-body">
                    <h5>Total Barang</h5>
                    <h2>{{ $totalBarang }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-success card-stat shadow">
                <div class="card-body">
                    <h5>Total Kategori</h5>
                    <h2>{{ $totalKategori }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-warning card-stat shadow">
                <div class="card-body">
                    <h5>Stok Menipis</h5>
                    <h2>{{ $stokMenipis }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-danger card-stat shadow">
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

                    <div class="position-relative">

                        <input
                            type="text"
                            id="search"
                            class="form-control"
                            placeholder="Cari Barang...">

                        <div
                            id="search-result"
                            class="list-group position-absolute w-100"
                            style="
                                z-index:1000;
                                display:none;
                            ">
                        </div>

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
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($products as $product)

                    <tr>
                        <td>{{ $loop->iteration }}</td>

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
                        <td>

                            <a href="{{ route('products.show',$product->id) }}"
                            class="btn btn-info btn-sm">
                                Detail
                            </a>

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

<script>

document
.getElementById('search')
.addEventListener('keyup', function(){

    let keyword = this.value;

    if(keyword.length < 1){

        document.getElementById(
            'search-result'
        ).style.display = 'none';

        return;
    }

    fetch(
        '/search-product?search=' + keyword
    )

    .then(response => response.json())

    .then(data => {

        let html = '';

        data.forEach(item => {

            html += `
                <a
                    href="/products/${item.id}"
                    class="list-group-item list-group-item-action">

                    ${item.nama_barang}

                </a>
            `;
        });

        document.getElementById(
            'search-result'
        ).innerHTML = html;

        document.getElementById(
            'search-result'
        ).style.display = 'block';

    });

});

</script>

@endsection