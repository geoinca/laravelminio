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
            'region'  => env('MINIO_DEFAULT_REGION','us-east-1'),
            'endpoint' =>  env('MINIO_ENDPOINT', 'http://minio:9000'),
            'use_path_style_endpoint' => true,
            'credentials' => [
                    'key'    =>env('MINIO_ACCESS_KEY','TCI4823FJXBK0206GOXX'),
                    'secret' =>env('MINIO_SECRET_KEY','xHC90qBeyZW04r+4bWf8gOn2pYGlFhfLzgcotBGn'),
                ],
            ]);
        $bucketName = 'media';
        $result = $s3->createBucket(['Bucket' => $bucketName,]);
        Storage::cloud()->put('hello.json', '{"hello": "world"}');

    }

}
