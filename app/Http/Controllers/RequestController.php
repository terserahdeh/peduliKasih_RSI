<?php

namespace App\Http\Controllers;

use App\Models\RequestDonation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RequestDonationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Public list: accepted requests (Daftar Request Donasi)
    public function acceptedList()
    {
        // Include user relationship to access username
        $requests = RequestDonation::with('user')
            ->where('status', 'Diterima')
            ->latest()
            ->paginate(12);

        return view('request_donasi.accepted', compact('requests'));
    }

    // Create form
    public function create()
    {
        return view('request_donasi.create');
    }

    // Store new request
    public function store(Request $request)
    {
        $data = $request->validate([
            'jenis_donasi' => 'required|in:Barang,Uang,Lainnya',
            'nama_barang'  => 'required|string|max:255',
            'jumlah'       => 'nullable|integer|min:1',
            'deskripsi'    => 'required|string',
            'foto'         => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        $path = $request->hasFile('foto')
            ? $request->file('foto')->store('request_donasi', 'public')
            : null;

        RequestDonation::create([
            'user_id'       => Auth::id(),
            'nama_pengaju'  => Auth::user()->username, // Ganti ke username
            'jenis_donasi'  => $data['jenis_donasi'],
            'nama_barang'   => $data['nama_barang'],
            'jumlah'        => $data['jumlah'],
            'deskripsi'     => $data['deskripsi'],
            'foto'          => $path,
            'status'        => 'Menunggu',
        ]);

        return redirect()->route('request.status')->with('success', 'Request Donasi berhasil dikirim dan menunggu verifikasi admin.');
    }

    // User's status page
    public function index()
    {
        $requests = RequestDonation::with('user')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('request_donasi.status', compact('requests'));
    }

    // Show single request detail
    public function show($id)
    {
        $req = RequestDonation::with('user')->findOrFail($id);
        return view('request_donasi.show', compact('req'));
    }

    // Edit form
    public function edit($id)
    {
        $req = RequestDonation::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('request_donasi.edit', compact('req'));
    }

    // Update
    public function update(Request $request, $id)
    {
        $req = RequestDonation::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $data = $request->validate([
            'jenis_donasi' => 'required|in:Barang,Uang,Lainnya',
            'nama_barang'  => 'required|string|max:255',
            'jumlah'       => 'nullable|integer|min:1',
            'deskripsi'    => 'required|string',
            'foto'         => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        if ($request->hasFile('foto')) {
            if ($req->foto) {
                Storage::disk('public')->delete($req->foto);
            }
            $data['foto'] = $request->file('foto')->store('request_donasi', 'public');
        }

        if ($req->status === 'Ditolak') {
            $data['status'] = 'Menunggu';
            $data['alasan_penolakan'] = null;
        }

        $req->update($data);

        return redirect()->route('request.status')->with('success', 'Request Donasi berhasil diperbarui.');
    }

    // Delete
    public function destroy($id)
    {
        $req = RequestDonation::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($req->foto) {
            Storage::disk('public')->delete($req->foto);
        }

        $req->delete();

        return back()->with('success', 'Request Donasi berhasil dihapus.');
    }

    // Upvote
    public function upvote($id)
    {
        $req = RequestDonation::findOrFail($id);
        $req->increment('upvote_count');

        return back()->with('success', 'Terima kasih atas dukunganmu!');
    }
}
