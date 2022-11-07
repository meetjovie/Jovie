<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SebastianBergmann\Type\Exception;

trait GeneralTrait
{
    public function uploadFile($file, $path, $old_file_path = null)
    {
        try {
            if ($file) {
                $timestamps = Str::slug(Carbon::now(), '_');
                $extension = null;
                // check if it is uploaded file instance the get extension as it is probably import file csv
                if (! is_string($file)) {
                    $extension = $file->extension();
                    if ($extension) {
                        $extension = '.'.$extension;
                    }
                }
                $file = file_get_contents($file);
                $path = ($path.$timestamps.'_'.uniqid(rand(), true).uniqid(rand(), true).$extension);
                if ($upload = Storage::disk('s3')->put($path, $file, 'public')) {
                    if ($old_file_path) {
                        if (! is_null($old_file_path) && Storage::disk('s3')->exists($path)) {
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

            return $e->getMessage();
        }
    }

    public static function getEmailFromString($string)
    {
        $pattern = '/[a-z0-9_\-\+\.]+@[a-z0-9\-]+\.([a-z]{2,4})(?:\.[a-z]{2})?/i';
        preg_match_all($pattern, $string, $matches);

        return $matches[0] ? ($matches[0][0] ?? null) : null;
    }
}
