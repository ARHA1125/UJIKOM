<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        // Search nama barang
        if ($request->search) {
            $query->where(
                'nama_barang',
                'like',
                '%' . $request->search . '%'
            );
        }

        // Filter kategori
        if ($request->category) {
            $query->where(
                'category_id',
                $request->category
            );
        }

        $products = $query->latest()->get();

        // Statistik Dashboard
        $totalBarang = Product::count();

        $totalKategori = Category::count();

        $stokMenipis = Product::where('stok', '<', 20)
                              ->where('stok', '>', 0)
                              ->count();

        $stokHabis = Product::where('stok', 0)
                            ->count();

        $categories = Category::all();

        return view('dashboard', compact(
            'products',
            'categories',
            'totalBarang',
            'totalKategori',
            'stokMenipis',
            'stokHabis'
        ));
    }
}