<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait JobControlTrait
{
    public function uploadFile($path, $file, $fileName)
    {
        try{
            return $file->move(public_path($path), $fileName);
        }
        catch (\Exception $e){
            Log::warning($e->getMessage()."\n".$e->getFile()."\n".$e->getLine());
        }
    }
}
