<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       // $request->user()->authorizeRoles(['user', 'admin']);
       $storage = Storage::disk('minio');
       $client = $storage->getAdapter()->getClient();
       $command = $client->getCommand('ListObjects');
       $command['Bucket'] = $storage->getAdapter()->getBucket();
       $command['Prefix'] = '';
       $result = $client->execute($command);
       return view('home')->with(['results' => $result['Contents']]);
    }
}
