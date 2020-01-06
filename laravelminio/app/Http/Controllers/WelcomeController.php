<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Aws\S3;
use Aws\S3\S3Client;

class WelcomeController extends Controller
{
    public function index()
    {
         $storage=Storage::disk('s3')->files('/');
         dd($storage);
        // $url = 'http' . env('AWS_BUCKET') . '/';
        // $images = [];
        ###
        //$storage = Storage::disk('minio');
        $storage = S3Client::factory([
            'version' => 'latest',
            'region'  => 'us-east-1',
            'endpoint' => 'http://localhost:9000',
            'use_path_style_endpoint' => true,
            'credentials' => [
                'key'    => 'TCI4823FJXBK0206GOXX',
                'secret' => 'xHC90qBeyZW04r+4bWf8gOn2pYGlFhfLzgcotBGn',
            ],
        ]);
        // $result = $storage->describeInstances();
        dd($storage);
        try {
            $storage->listObjects([
                'Bucket' => 'audio'
            ]);
        } catch (Aws\S3\Exception\S3Exception $e) {
            echo "<pre>";
            echo $e->getMessage() . "\n";
            echo $e->getTraceAsString();
            echo "</pre>";
        }
        dd($storage);

        ###
        var_dump($result);
        // $files = Storage::disk('minio')->files('/');
        // foreach ($files as $file) {
        //     $images[] = [
        //         'name' => str_replace('/', '', $file),
        //         'src' => $url . $file
        //     ];
        // }
        $s3 = S3Client::factory([
            'version' => 'latest',
            'region'  => 'us-east-1',
            'endpoint' => 'http://localhost:9000',
            'use_path_style_endpoint' => true,
            'credentials' => [
                'key'    => 'TCI4823FJXBK0206GOXX',
                'secret' => 'xHC90qBeyZW04r+4bWf8gOn2pYGlFhfLzgcotBGn',
            ],
        ]);



        //$plainUrl = $s3->getObjectUrl('audio', 'hello.json');
        //print_r($plainUrl);
        //return view('welcome', $s3);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|max:2048'
        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = time() . $file->getClientOriginalName();
            $filePath = 'images/' . $name;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
        }
        return back()->withSuccess('Image uploaded successfully');
    }
    public function destroy($image)
    {
        Storage::disk('s3')->delete('images/' . $image);
        return back()->withSuccess('Image was deleted successfully');
    }
}
