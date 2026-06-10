<!DOCTYPE html>
<html>
<head>
    <title>Frozeria Stock</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f5f5f5;
        }

        .navbar-custom{
            background:#111;
        }

        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link{
            color:white;
        }

        .content-box{
            background:white;
            border:1px solid #ddd;
            padding:20px;
        }

        .upload-box{
            border:1px dashed #ccc;
            height:200px;
            display:flex;
            align-items:center;
            justify-content:center;
            flex-direction:column;
            background:#fafafa;
        }
    </style>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-custom">

    <div class="container">

        <a href="/" class="navbar-brand fw-bold">
            Frozeria Stock
        </a>

        <ul class="navbar-nav">

            <li class="nav-item">
                <a href="/" class="nav-link">Dashboard</a>
            </li>

           

            <li class="nav-item">
                <a href="/categories" class="nav-link">Kategori</a>
            </li>

            <li class="nav-item">
                <a href="/bantuan" class="nav-link">Bantuan</a>
            </li>

        </ul>

    </div>

</nav>

<div class="container mt-4">
    @if(session('success'))

<div class="alert alert-success alert-dismissible fade show">

    {{ session('success') }}

    <button
        type="button"
        class="btn-close"
        data-bs-dismiss="alert">
    </button>

</div>

@endif

    @yield('content')

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 