<?php

namespace App\Http\Controllers;


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
        $fileName = time().'.'.$request->name;

        $request->objectup->store('media','minio');

        return back()
            ->with('success','You have successfully upload file.')
            ->with('file',$fileName);
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
