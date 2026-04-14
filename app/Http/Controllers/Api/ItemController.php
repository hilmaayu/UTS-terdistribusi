<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller {
    // Menampilkan data & Hostname [cite: 22, 24]
    public function index() {
        $host = gethostname();

        return response()->json([
            'message' => "Hallo ini dari " . $host,
            'server_hostname' => gethostname(),
            'data' => Item::all()
        ]);
    }

    // Menambah data [cite: 23]
    public function store(Request $request) {
        $item = Item::create(['name' => $request->name]);
        return response()->json([
            'server_hostname' => gethostname(),
            'message' => 'Data berhasil disimpan',
            'item' => $item
        ]);
    }
}