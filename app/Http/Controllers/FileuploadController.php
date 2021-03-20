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
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$request->user()->authorizeRoles(['user', 'admin']);
        $storage = Storage::disk('minio');
       
        $client = $storage->getAdapter()->getClient();
        $command = $client->getCommand('ListObjects');
        $command['Bucket'] = $storage->getAdapter()->getBucket();
        //$command['Prefix'] = 'id' . $request->user()->id . '/';
        $result = $client->execute($command);
        //;$request->user()->id

        return view('fileupload.index')->with(['results' => $result['Contents']]);
    }
    public function create(Request $request)
    {
        //$request->user()->authorizeRoles(['user', 'admin']);
        //dd("dfg");
        return view('fileupload.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $imageNameArr = [];
        foreach ($request->objectup as $file) {
            //$file = $request->file('objectup');
            $name=time().$file->getClientOriginalName();
            $imageNameArr[] = $name;
            //$filePath = '/' . 'id' . $request->user()->id. '/' . $name;
            $filePath = '/' . $name;
            Storage::disk('minio')->put($filePath, file_get_contents($file));

            //$txtmsg= $name.' Upload!';
        }
        exec("/usr/bin/argo submit --watch -n argo  https://raw.githubusercontent.com/geoinca/miniok/main/argo/hello-world10.yaml        ", );
    
        session()->flash('message', $name.' Upload!');
        //return redirect('/');
        return redirect()->route('fileupload_path');
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
