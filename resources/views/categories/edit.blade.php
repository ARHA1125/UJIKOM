<!DOCTYPE html>
<html>
<head>
    <title>Edit Kategori</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2>Edit Kategori</h2>

    <form action="{{ route('categories.update',$category->id) }}"
          method="POST">

        @csrf
        @method('PUT')

        <div class="mb-3">

            <label>Nama Kategori</label>

            <input type="text"
                   name="nama_kategori"
                   value="{{ $category->nama_kategori }}"
                   class="form-control">

        </div>

        <button class="btn btn-primary">
            Update
        </button>

    </form>

</div>

</body>
</html>