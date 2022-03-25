<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presence;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PresenceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function postPresence(Request $request)
    {
        // if (DB::table('orders')->where('created_at', 1)->exists()) {
            
        // }
        $presence = new Presence;
        $tanggal = Presence::where('tanggal', date("Y-m-d"))->count();
        $user = Presence::where('id_users', Auth::user()->id)->count();
        $type = Presence::where('type', $request->type)->count();
        if ($tanggal != 0 && $type != 0 && $user != 0) {
            return response()->json([
                'message' => 'Kamu sudah absen'
            ]);
        }else{
            $presence->id_users = Auth::user()->id;
            $presence->type = $request->type;
            $presence->approve = false;
            $presence->tanggal = now();
            $presence->save();
            return response()->json([
                'type' => $presence->type,
                'waktu' => $presence->created_at
            ]);
        }
    }

    public function getPresence()
    {
        $presence = Presence::with(['user'])->get();
        return response()->json([
            'message' => 'Success get data',
            'data' => $presence
        ]);
    }

    public function approvePresence(Request $request, $id)
    {
        $presence = Presence::find($id);
        $presence->id_users = Auth::user()->id;
        $presence->type = $presence->type;
        $presence->approve = true;
        $presence->save();

        return response()->json([
            'message' => 'Approve success'
        ]);
    }

    public function rejectPresence(Request $request, $id)
    {
        $presence = Presence::find($id);
        $presence->id_users = Auth::user()->id;
        $presence->type = $presence->type;
        $presence->approve = false;
        $presence->save();

        return response()->json([
            'message' => 'Reject success'
        ]);
    }
}
