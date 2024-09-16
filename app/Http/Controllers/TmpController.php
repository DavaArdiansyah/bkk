<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TmpController extends Controller
{
    public function files(Request $request) {
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            $fileNames = [];

            foreach ($files as $file) {
                $fileName = uniqid(true) . '_' . $file->getClientOriginalName();
                $file->move(storage_path('app/public/tmp/files'), $fileName);
                $fileNames[] = $fileName;
            }
            return implode(', ', $fileNames);
        } return '';
    }
}
