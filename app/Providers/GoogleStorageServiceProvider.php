<?php

namespace App\Providers;
use Google\Cloud\Storage\StorageClient;
use League\Flysystem\Filesystem;
use Storage;
use Superbalist\Flysystem\GoogleStorage\GoogleStorageAdapter;

use Illuminate\Support\ServiceProvider;

class GoogleStorageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Storage::extend('gcs', function ($app,$config){
            $storageClient = new StorageClient([
                'projectId' => $config['project_id'],
                'keyFilePath' =>$config['key_file'] ,
            ]);
            $bucket = $storageClient->bucket($config['bucket']);
            $adapter = new GoogleStorageAdapter($storageClient,$bucket);
            return  new Filesystem($adapter);
        });
    }
}
