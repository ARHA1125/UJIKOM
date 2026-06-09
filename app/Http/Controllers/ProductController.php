<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->latest()
            ->get();

        return view(
            'products.index',
            compact('products')
        );
    }

    public function create()
    {
        $categories = Category::all();

        return view(
            'products.create',
            compact('categories')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'nama_barang' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'foto' => 'nullable|image'
        ]);

        $foto = null;

        if ($request->hasFile('foto')) {

            $foto = $request
                ->file('foto')
                ->store('products', 'public');
        }

        Product::create([
            'category_id' => $request->category_id,
            'nama_barang' => $request->nama_barang,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'foto' => $foto
        ]);

        return redirect()
            ->route('products.index')
            ->with('success', 'Barang berhasil ditambahkan');
    }

    public function show(Product $product)
    {
        return view(
            'products.show',
            compact('product')
        );
    }

    public function edit(Product $product)
    {
        $categories = Category::all();

        return view(
            'products.edit',
            compact(
                'product',
                'categories'
            )
        );
    }

    public function update(
        Request $request,
        Product $product
    ) {

        $request->validate([
            'category_id' => 'required',
            'nama_barang' => 'required',
            'harga' => 'required',
            'stok' => 'required'
        ]);

        $foto = $product->foto;

        if ($request->hasFile('foto')) {

            if ($product->foto) {

                Storage::disk('public')
                    ->delete($product->foto);
            }

            $foto = $request
                ->file('foto')
                ->store('products', 'public');
        }

        $product->update([
            'category_id' => $request->category_id,
            'nama_barang' => $request->nama_barang,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'foto' => $foto
        ]);

        return redirect()
            ->route('products.index')
            ->with('success', 'Barang berhasil diupdate');
    }

    public function destroy(Product $product)
    {
        if ($product->foto) {

            Storage::disk('public')
                ->delete($product->foto);
        }

        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Barang berhasil dihapus');
    }
    public function search(Request $request)
{
    $keyword = $request->search;

    $products = Product::where(
            'nama_barang',
            'like',
            '%' . $keyword . '%'
        )
        ->limit(10)
        ->get();

    return response()->json($products);
}
}