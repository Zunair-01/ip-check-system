<?php

namespace App\Http\Controllers;

use App\Models\Ip;
use Illuminate\Http\Request;

class IpController extends Controller
{
    public function fetchData()
    {
        $ips = Ip::all();
        $totalCount = Ip::count();

        return response()->json(['ips' => $ips, 'totalCount' => $totalCount]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'ip' => 'required|ip',
            'is_used' => 'boolean',
        ]);

        $existingIp = Ip::where('ip', $request->ip)->first();

        if ($existingIp) {
            return response()->json(['success' => false], 409);
        }

        $ip = new Ip();
        $ip->ip = $request->ip;
        $ip->is_used = $request->is_used ?? 0;
        $ip->save();

        return response()->json(['success' => true]);
    }

    public function deleteAll()
    {
        Ip::truncate();
        return response()->json(['success' => true]);
    }
}
