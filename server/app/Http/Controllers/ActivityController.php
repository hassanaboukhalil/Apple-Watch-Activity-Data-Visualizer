<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv',
            'user_id' => 'required|exists:users,id',
        ]);

        $userId = $request->user_id;
        $file = fopen($request->file('file'), 'r');

        fgetcsv($file); // Skip header

        while (($row = fgetcsv($file)) !== false) {
            Activity::create([
                'user_id' => $userId,
                'date' => $row[1],
                'steps' => $row[2],
                'distance_km' => $row[3],
                'active_minutes' => $row[4],
            ]);
        }

        fclose($file);

        return response()->json([
            'success' => true,
            'message' => 'CSV uploaded successfully'
        ]);
    }
}
