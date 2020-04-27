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

    $s3 = new Aws\S3\S3Client([
        'version' => 'latest',
        'region'  => env('MINIO_REGION'),
        'endpoint' =>  env('MINIO_ENDPOINT', 'http://127.0.0.1:9000'),
        'use_path_style_endpoint' => true,
        'credentials' => [
                'key'    =>env('MINIO_KEY'),
                'secret' =>env('MINIO_SECRET'),
            ],
    ]);
    dd($s3);
// Send a PutObject request and get the result object.
$insert = $s3->putObject([
    'Bucket' => 'media',
    'Key'    => 'testkey',
    'Body'   => 'Hello from MinIO!! we∫'
]);
//dd($insert );
// Download the contents of the object.
$retrive = $s3->getObject([
    'Bucket' => 'media',
    'Key'    => 'testkey',
    'SaveAs' => 'testkey_local'
]);

});


Route::name('posts_path')->get('/posts', 'PostsController@index');
Route::name('post_path')->get('/posts/{post}', 'PostsController@show');