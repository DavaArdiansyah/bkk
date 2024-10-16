<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TmpController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function files(Request $request)
    {
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            $fileNames = [];

            foreach ($files as $file) {
                $fileName = uniqid(true) . '_' . $file->getClientOriginalName();
                $file->move(storage_path('app/public/tmp/files'), $fileName);
                $fileNames[] = $fileName;
            }
            return implode(', ', $fileNames);
        }
        return '';
    }

    public function images(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $ImagePath = 'images/' . $file->getClientOriginalName();

            if (Storage::disk('public')->exists($ImagePath)) {
                return $file->getClientOriginalName();
            }

            $fileName = uniqid(true) . '_' . $file->getClientOriginalName();
            $file->move(storage_path('app/public/images'), $fileName);

            return $fileName;
        }
        return '';
    }
}
