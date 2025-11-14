<?php

namespace App\Http\Controllers;

use App\Models\Upvote;
use App\Models\RequestDonasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpvoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:pengguna');
    }

    public function toggle($id_request)
    {
        $user = Auth::user()->username;

        // cek apakah user sudah upvote
        $existing = Upvote::where('username', $user)
            ->where('id_request', $id_request)
            ->first();

        if ($existing) {
            // sudah upvote → hapus (toggle off)
            $existing->delete();
            $status = 'removed';
        } else {
            // belum upvote → tambahkan
            Upvote::create([
                'username' => $user,
                'id_request' => $id_request,
            ]);
            $status = 'added';
        }

        $count = Upvote::where('id_request', $id_request)->count();

        return response()->json([
            'status' => $status,
            'count' => $count,
        ]);
    }
}
