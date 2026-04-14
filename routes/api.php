<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

// 1. Endpoint Status (Menampilkan identitas server)
Route::get('/status', function () {
    $host = gethostname();
    return response()->json([
        'message' => "Hallo ini dari " . $host,
        'server_hostname' => gethostname(),
        'status' => 'Online',
        'timestamp' => now()
    ]);
});

// 2. Endpoint Menampilkan Data dari Database
Route::get('/items', function () {
    $host = gethostname();
    $data = DB::table('items')->get(); 
    return response()->json([
        'message' => "Data fetched successfully via " . $host,
        'server_hostname' => $host,
        'data' => $data
    ]);
});

// 3. Endpoint Post Data ke Database
Route::post('/items', function (Request $request) {
    $host = gethostname();
    
    $request->validate([
        'nama' => 'required|string' 
    ]);

    DB::table('items')->insert([
        'nama' => $request->nama, 
        'created_at' => now(),
        'updated_at' => now()
    ]);

    return response()->json([
        'message' => "Data berhasil disimpan oleh " . $host,
        'server_hostname' => $host,
        'data_added' => [
            'nama' => $request->nama
        ]
    ]);
});