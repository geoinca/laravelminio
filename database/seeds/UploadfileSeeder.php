<?php

use Illuminate\Database\Seeder;

class UploadfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $s3 = new Aws\S3\S3Client([
            'version' => 'latest',
            'region'  => env('MINIO_DEFAULT_REGION'),
            'endpoint' =>  env('MINIO_ENDPOINT'),
            'use_path_style_endpoint' => true,
            'credentials' => [
                    'key'    =>env('MINIO_ACCESS_KEY'),
                    'secret' =>env('MINIO_SECRET_KEY'),
                ],
            ]);
        $bucketName = 'media';
        $result = $s3->createBucket(['Bucket' => $bucketName,]);
        Storage::cloud()->put('hello.json', '{"hello": "world"}');

    }

}
