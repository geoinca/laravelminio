<?php

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    //Route::get('/home', 'FileuploadController@viewuploads');
    Route::get('/fileupload/home', 'FileuploadController@index');
    Route::name('create_post_path')->get(   '/posts/create', 'PostsController@create');
    Route::name('store_post_path')->post(   '/posts',        'PostsController@store');
    Route::name('edit_post_path')->get(     '/posts/{post}/edit', 'PostsController@edit');
    Route::name('update_post_path')->put(   '/posts/{post}', 'PostsController@update');
    Route::name('delete_post_path')->delete('/posts/{post}', 'PostsController@delete');

    Route::name('create_comment_path')->post('/posts/{post}/comments', 'PostsCommentsController@create');
    
    Route::name('create_fileupload_path')->get('/fileupload/create', 'FileuploadController@create');
    Route::name('fileupload_path')->get('/fileupload', 'FileuploadController@index');
    Route::name('store_fileupload_path')->post('/fileupload', 'FileuploadController@store');
    Route::name('download_fileupload_path')->post('/fileupload/download', 'FileuploadController@download');
    //Route::name('index_fileupload_path')->get( '/fileupload', 'FileuploadController@index');
   
});

Route::get('/', 'HomeController@index');



Route::name('posts_path')->get('/posts', 'PostsController@index');
Route::name('post_path')->get('/posts/{post}', 'PostsController@show');




