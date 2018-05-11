<?php

namespace App\Traits;

use Image;
use File;

trait FileTrait
{
    public function uploadImage($file, $stringPath, $resizeWidth = null, $width = null, $height = null)
    {
        ini_set('upload_max_filesize', '10M');

        $image = $file;
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $imageLocation = getcwd() . '/' . $stringPath . '/' . $imageName;
        if ($resizeWidth == null && $width == null && $height == null) {
            Image::make($image)->save($imageLocation);
        } else {
            // Upload Image
            Image::make($image)->resize($resizeWidth, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->crop($width, $height)->save($imageLocation);
        }

        return $imageName;
    }

    public function uploadFile($file, $stringPath, $type = 1)
    {
        if ($type == 1) {
            if (!file_exists($stringPath)) {
                mkdir(getcwd() . $stringPath, 0777, true);
            }
            $image = $file;
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imageLocation = getcwd() . '/' . $stringPath . '/';
            $image->move($imageLocation, $imageName);
            if (!$image) {
                return false;
            }
            return $imageName;
        } else {
            $file = str_replace(['data:image/jpeg;base64,', 'data:image/jpg;base64,', 'data:image/png;base64,'], '', $file);
            $file = str_replace(' ', '+', $file);
            $filename = time() . '.' . 'png'; // file name based on time
            $fileLocation = getcwd() . '/' . $stringPath . '/' . $filename;
            $file_uploaded = base64_decode($file);
            file_put_contents($fileLocation, $file_uploaded);
            if (!$file_uploaded) {
                return false;
            }
            return $filename;
        }
    }

    public function uploadFile64($string, $stringPath)
    {
        $string = str_replace(['data:image/jpeg;base64,', 'data:image/jpg;base64,', 'data:image/png;base64,'], '', $string);
        $string = str_replace(' ', '+', $string);
        $filename = time() . '.' . 'png'; // file name based on time
        $fileLocation = getcwd() . '/' . $stringPath . '/' . $filename;
        $file = base64_decode($string);
        file_put_contents($fileLocation, $file);
        if (!$file) {
            return FALSE;
        }
        return $filename;
    }

    public function deleteFile($path)
    {
        File::delete(getcwd() . '/' . $path);
    }

    public function getProfileImage($user)
    {
        if ($user->image == NULL) {
            $image = url('assets\images\profiles\default.png');
        } elseif ($user->is_facebook == 1) {
            $image = url($user->image);
        } else {
            $image = url('assets\images\profiles/' . $user->image);
        }
        return $image;
    }
}