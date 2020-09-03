<?php

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index');
    Route::name('create_post_path')->get('/posts/create', 'PostsController@create');
    Route::name('store_post_path')->post('/posts', 'PostsController@store');
    Route::name('edit_post_path')->get('/posts/{post}/edit', 'PostsController@edit');
    Route::name('update_post_path')->put('/posts/{post}', 'PostsController@update');
    Route::name('delete_post_path')->delete('/posts/{post}', 'PostsController@delete');

    Route::name('create_comment_path')->post('/posts/{post}/comments', 'PostsCommentsController@create');
});

//Route::get('/', 'UsersController@index');
Route::get('/', function () {

    $created = Storage::disk('minio')->put('/test.txt','Hello World!');
    print_r($created);
    $files = Storage::disk('minio')->files('/');
    print_r($files);
    $s3 = new Aws\S3\S3Client([
        'version' => 'latest',
        'region'  => env('MINIO_DEFAULT_REGION'),
        'endpoint' =>  env('MINIO_ENDPOINT', 'http://minio:9000'),
        'use_path_style_endpoint' => true,
        'credentials' => [
                'key'    =>env('MINIO_ACCESS_KEY'),
                'secret' =>env('MINIO_SECRET_KEY'),
            ],
    ]);
    //
    //$created2=$s3::disk('minio')->put('/tests3.txt','Hello World!');
$buckets=$s3->listBuckets();
foreach ($buckets['Buckets'] as $bucket) {
    echo $bucket['Name'] . "<br>\n";
}
//Gets the access control policy for a bucket
//json_encode($buckets);
//dd($buckets);
$bucket = 'media';

$result=$s3->listObjects(array('Bucket'=>$bucket));

echo "keys retrived !\n";
foreach ($result['Contents'] as $object){
    echo $object["Key"] . "<br>\n";
}
// try {
//     $resp = $s3->getBucketAcl([
//         'Bucket' => $bucket
//     ]);
//     echo "Succeed in retrieving bucket ACL as follows: \n";
//     var_dump($resp);
// } catch (AwsException $e) {
//     // output error message if fails
//     echo $e->getMessage();
//     echo "\n";
// }
// dd($buckets);




// // Send a PutObject request and get the result object.
// $insert = $s3->putObject([
//     'Bucket' => 'media',
//     'Key'    => 'testkey',
//     'Body'   => 'Hello from MinIO!! we∫we∫we∫we∫we∫we∫we∫we∫'
// ]);
// dd($insert );
// // Download the contents of the object.
// $retrive = $s3->getObject([
//     'Bucket' => 'media',
//     'Key'    => 'testkey',
//     'SaveAs' => 'testkey_local'
// ]);

});


Route::name('posts_path')->get('/posts', 'PostsController@index');
Route::name('post_path')->get('/posts/{post}', 'PostsController@show');
