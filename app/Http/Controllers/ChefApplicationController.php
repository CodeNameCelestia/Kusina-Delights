<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplicationMail;

class ChefApplicationController extends Controller
{
    public function applyChef(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'files.*' => 'file|max:10240', // 10 MB max file size
        ]);

        $files = $request->file('files', []);
        foreach ($files as $file) {
            $file->store('applications');
        }

        Mail::to('banguist@gmail.com')->send(new ApplicationMail($request->message, $files));

        return response()->json(['message' => 'Application sent successfully!']);
    }
}
