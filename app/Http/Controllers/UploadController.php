<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Http\Request;

class UploadController extends Controller
{


   
    public function create()
    {
        return view('uploads.create');
    }


    public function store(Request $request)
    {
       
        if ($request->hasFile('upload') && $request->file('upload')->isValid()) {
            $upload = new Upload();
    
           
            $upload->mimeType = $request->file('upload')->getMimeType();
            $upload->originalName = $request->file('upload')->getClientOriginalName();
            $upload->path = $request->file('upload')->store('uploads');
            $upload->save();
    
            return view('uploads.create', [
                'id' => $upload->id,
                'path' => $upload->path,
                'originalName' => $upload->originalName,
                'mimeType' => $upload->mimeType
            ]);
        } else {
            dd('File upload failed. Check the uploaded file.');
        }
    }
    public function show(Upload $upload,$originalName='')
    {
        $upload =   Upload::findOrFail($upload->id);
        return response()->file(storage_path().'/app/'.$upload->path);
    }



}
