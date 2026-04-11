<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;

class ReportController extends Controller
{
    public function store(Request $request , $id) {
        $request->validate([
            'reason' => 'string|required|max:1000'
        ]);

        Report::create([
            'reason' => $request->reason,
            'annonce_id' => $id,
            'user_id' => auth()->id(),
            'status' => 'pending'
        ]);

        return back()->with('status' , 'the report has been submited');
    }
}
