<?php 
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class StorageHelper extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'storagehelper';
    }
}
