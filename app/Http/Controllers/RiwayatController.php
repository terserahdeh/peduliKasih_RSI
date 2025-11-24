<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class RiwayatController extends Controller
{
    public function index(Request $request)
    {
        // Mendefinisikan parameter paginasi
        $perPage = 10;
        $page = $request->get('page', 1);
        $offset = ($page - 1) * $perPage;
        
        // Pastikan pengguna sudah login
        if (!Auth::check()) {
            $riwayatPaginator = new LengthAwarePaginator([], 0, $perPage, $page);
            return view('home.riwayat', ['riwayat' => $riwayatPaginator]);
        }

        $userId = Auth::id();
        $loggedInUsername = Auth::user()->username;
        
        // Fungsi SQL untuk membersihkan string dari spasi/karakter tersembunyi
        $cleanStringSql = function ($column) {
            // Mencegah nilai NULL dan membersihkan karakter tersembunyi (\r, \n)
            return "LOWER(REPLACE(REPLACE(TRIM(COALESCE({$column}, '')), CHAR(13), ''), CHAR(10), ''))";
        };
        
        // --- 1. Query untuk tabel DONASI ---
        $donasiQuery = DB::table('donasi')
            ->where('username', $loggedInUsername)
            ->select(
                DB::raw("'Donasi' as jenis_donasi"),
                'nama_donasi as judul',
                'jenis_barang as category',
                'jenis_barang as nama_barang',
                'jumlah_barang as jumlah',
                // KODE DIPERBARUI: Menambahkan 'disetujui' ke dalam kondisi penerimaan.
                DB::raw("CASE 
                    WHEN {$cleanStringSql('hasil_verif')} IN ('diterima', '1', 'disetujui') THEN 'diterima'
                    WHEN {$cleanStringSql('hasil_verif')} IN ('ditolak', '0') THEN 'ditolak'
                    ELSE 'menunggu' 
                END as status"), // <-- ALIAS HARUS 'status'
                'created_at',
                DB::raw("'donasi' as source_table") 
            );

        // --- 2. Query untuk tabel REQUEST DONASI ---
        $requestQuery = DB::table('request_donasi')
            ->where('username', $loggedInUsername)
            ->select(
                DB::raw("'Request Bantuan' as jenis_donasi"),
                'nama_request as judul',
                'jenis_barang as category',
                'jenis_barang as nama_barang',
                'jumlah_barang as jumlah',
                // Logika Request sudah benar
                DB::raw("CASE 
                    -- PRIORITAS 1: Cek Kolom hasil_verif (Status Akhir)
                    WHEN {$cleanStringSql('hasil_verif')} IN ('diterima', '1') THEN 'diterima'
                    WHEN {$cleanStringSql('hasil_verif')} IN ('ditolak', '0') THEN 'ditolak'
                    
                    -- PRIORITAS 2: Cek Kolom status_request (Status Lama/Sementara)
                    WHEN {$cleanStringSql('status_request')} IN ('diterima', '1') THEN 'diterima'
                    WHEN {$cleanStringSql('status_request')} IN ('ditolak', '0') THEN 'ditolak'
                    
                    -- Default
                    ELSE 'menunggu'
                END as status"), // <-- ALIAS HARUS 'status'
                'tanggal_upload as created_at',
                DB::raw("'request_donasi' as source_table") 
            );

        // --- 3. Gabungkan kedua query (Union) ---
        $combinedQuery = $donasiQuery->unionAll($requestQuery);

        // Hitung total data
        $total = DB::query()->fromSub($combinedQuery, 'combined')->count();

        // Ambil data dengan pagination
        $items = DB::query()
            ->fromSub($combinedQuery, 'ordered_riwayat')
            ->orderBy('created_at', 'desc')
            ->skip($offset)
            ->take($perPage)
            ->get();
        
        // Buat instance LengthAwarePaginator
        $riwayatPaginator = new LengthAwarePaginator(
            $items,
            $total,
            $perPage,
            $page,
            ['path' => LengthAwarePaginator::resolveCurrentPath(), 'query' => $request->query()]
        );
        $riwayatPaginator->appends($request->except('page'));

        return view('home.riwayat', [
            'riwayat' => $riwayatPaginator,
        ]);
    }
}