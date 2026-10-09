<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        $barangs = Barang::whereIn('id', array_keys($cart))
            ->get()
            ->keyBy('id');

        $items = [];
        $total = 0;

        foreach ($cart as $id => $jumlah) {
            $barang = $barangs->get($id);

            if (!$barang) {
                continue;
            }

            $subtotal = $barang->harga * $jumlah;
            $total += $subtotal;

            $items[] = [
                'barang' => $barang,
                'jumlah' => $jumlah,
                'subtotal' => $subtotal,
            ];
        }

        return view('keranjang', compact('items', 'total'));
    }

    public function tambah($id)
    {
        $barang = Barang::findOrFail($id);
        $cart = session()->get('cart', []);
        $jumlah = $cart[$id] ?? 0;

        if ($barang->stok <= 0) {
            return back()->with('error', 'Stok barang habis.');
        }

        if ($jumlah >= $barang->stok) {
            return back()->with(
                'error',
                'Jumlah barang sudah mencapai stok tersedia.'
            );
        }

        $cart[$id] = $jumlah + 1;
        session()->put('cart', $cart);

        return back()->with('success', 'Barang berhasil ditambahkan.');
    }

    public function tambahJumlah($id)
    {
        $barang = Barang::findOrFail($id);
        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            return back();
        }

        if ($cart[$id] < $barang->stok) {
            $cart[$id]++;
            session()->put('cart', $cart);
        }

        return back();
    }

    public function kurangJumlah($id)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            return back();
        }

        $cart[$id]--;

        if ($cart[$id] <= 0) {
            unset($cart[$id]);
        }

        session()->put('cart', $cart);

        return back();
    }

    public function hapus($id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$id]);

        session()->put('cart', $cart);

        return back();
    }

    public function kosongkan()
    {
        session()->forget('cart');

        return redirect('/keranjang');
    }
}
