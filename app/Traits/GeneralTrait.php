<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SebastianBergmann\Type\Exception;

trait GeneralTrait {

    public function uploadFile($file, $path, $old_file_path = null)
    {
        try {
            if ($file) {
                $timestamps = Str::slug(Carbon::now(), '_');
                $path = ($path.$timestamps.'_'.uniqid(rand(), true));
                if ($upload = Storage::disk('s3')->put($path, $file, 'public')) {
                    if ($old_file_path) {
                        if (!is_null($old_file_path) && Storage::disk('s3')->exists($path)) {
                            Storage::disk('s3')->delete($old_file_path);
                        }
                    }
                    return Storage::disk('s3')->url($path);
                }
            }
            return $old_file_path;
        } catch (\Exception $e) {
            Log::error('************ Error While Uploading File Start **************');
            Log::error($e->getMessage());
            Log::error('************ Error While Uploading File End **************');
            return $old_file_path;
        }
    }
}
