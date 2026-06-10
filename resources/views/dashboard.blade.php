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

                    <div class="col-md-5">

                        <input
                            type="text"
                            id="search"
                            class="form-control"
                            placeholder="Cari Nama Barang...">

                    </div>

                    <div class="col-md-4">

                        <select id="categoryFilter" class="form-control">

                            <option value="">Semua Kategori</option>

                            @foreach($categories as $category)

                                <option value="{{ strtolower($category->nama_kategori) }}">
                                    {{ $category->nama_kategori }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-3">

                        <button
                            type="button"
                            class="btn btn-secondary w-100"
                            onclick="resetFilter()">

                            Reset

                        </button>

                    </div>
                </div>

            </form>

        </div>

    </div>

    <div class="card mt-4">

        <div class="card-body">

        <div class="d-flex justify-content-between align-items-center mb-3">

    <h5 class="mb-0">Daftar Barang</h5>

    <a href="{{ route('products.create') }}" class="btn btn-primary">
        + Tambah Barang
    </a>

</div>
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

                <tbody id="productTable">

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
                            <div class="d-flex gap-1">

                                <a href="{{ route('products.show', $product->id) }}"
                                class="btn btn-info btn-sm">
                                    Detail
                                </a>

                                <a href="{{ route('products.edit', $product->id) }}"
                                class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <form action="{{ route('products.destroy', $product->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus barang ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger btn-sm">
                                        Hapus
                                    </button>

                                </form>

                            </div>
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

                    <tr id="no-data-row" style="display: none;">
                        <td colspan="7" class="text-center text-danger fw-bold">
                            Barang tidak ada
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>

<script>
function filterTable() {

    const keyword = document.getElementById("search").value.toLowerCase().trim();
    const kategori = document.getElementById("categoryFilter").value.trim().toLowerCase();

    const rows = document.querySelectorAll("#productTable tr:not(#no-data-row)");

    let ditemukan = false;

    rows.forEach(function(row) {

        // Lewati baris kosong atau baris yang tidak memiliki 7 sel (No, Foto, Nama, Kategori, Harga, Stok, Aksi)
        if (row.cells.length < 7) {
            return;
        }

        const namaBarang = row.cells[2].textContent.toLowerCase();
        const namaKategori = row.cells[3].textContent.trim().toLowerCase();

        const cocokNama = namaBarang.includes(keyword);
        const cocokKategori = kategori === "" || namaKategori === kategori;

        if (cocokNama && cocokKategori) {
            row.style.display = "";
            ditemukan = true;
        } else {
            row.style.display = "none";
        }

    });

    document.getElementById("no-data-row").style.display =
        ditemukan ? "none" : "";

}

function resetFilter() {

    document.getElementById("search").value = "";
    document.getElementById("categoryFilter").value = "";

    filterTable();

}

document.getElementById("search")
    .addEventListener("keyup", filterTable);

document.getElementById("categoryFilter")
    .addEventListener("change", filterTable);
</script>

@endsection