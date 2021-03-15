<?php

namespace App\Http\Controllers;
use Storage;

use App\Fileupload;
use Illuminate\Http\Request;

class FileuploadController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$request->user()->authorizeRoles(['user', 'admin']);
        return view('fileupload.index');
    }
    public function create(Request $request)
    {
        //$request->user()->authorizeRoles(['user', 'admin']);
        return view('fileupload.index');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $imageNameArr = [];
        foreach ($request->objectup as $file) {
            //$file = $request->file('objectup');
            $name=time().$file->getClientOriginalName();
            $imageNameArr[] = $name;
            $filePath = '/' . $name;
            Storage::disk('minio')->put($filePath, file_get_contents($file));

            //$txtmsg= $name.' Upload!';
        }    
        session()->flash('message', $name.' Upload!');
        return redirect('/');
    }

    public function download(Request $request){
        $filename = $request->input('filename');
        $exists = Storage::disk('minio')->exists($filename );
        if($exists){
            $mime = Storage::disk('minio')->getDriver()->getMimetype($filename);
            $size = Storage::disk('minio')->getDriver()->getSize($filename);
            $headers =  [
                'Content-Type' => $mime,
                'Content-Length' => $size,
                'Content-Description' => 'File Transfer',
                'Content-Disposition' => "attachment; filename={$filename}",
                'Content-Transfer-Encoding' => 'binary',
              ];

              //ob_end_clean();
              return   \Response::make(Storage::disk('minio')->get($filename), 200, $headers);
        }
        else{
            dd($exists);
        }
   //$file = Storage::disk('minio')->get($filename );




    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fileupload  $fileupload
     * @return \Illuminate\Http\Response
     */
    public function show(Fileupload $fileupload)
    {
        //
    }





}
