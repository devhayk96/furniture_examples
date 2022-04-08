<?php
/**
 * Created by PhpStorm.
 * User: sky
 * Date: 13.01.2022
 * Time: 22:12
 */

namespace App\Helpers;
use Closure;
use Image;
use Intervention\Image\Constraint;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class FileHelper
{
    /**
     * Save the uploaded image.
     *
     * @param UploadedFile $file     Uploaded file.
     * @param int          $resizeWidth
     * @param string       $path
     * @param Closure      $callback Custom file naming method.
     *
     * @return string File name.
     */
    public static function saveImage(UploadedFile $file, $resizeWidth, $path = null, Closure $callback = null)
    {
        if (!$path) {
            return null;
//            $path = config('filesystems.uploads.images');
        }

        if ($callback) {
            $fileName = $callback();
        } else {
            $fileName = self::getFileName($file);
        }

        $img = self::makeImage($file);
        if ($resizeWidth != 0) {
            $img = self::resizeImage($img, $resizeWidth);
        }
        self::uploadImage($img, $fileName, $path);

        return $fileName;
    }

    /**
     * Get uploaded file's name.
     *
     * @param UploadedFile $file
     *
     * @return null|string
     */
    protected static function getFileName(UploadedFile $file)
    {
        $filename = $file->getClientOriginalName();
        $filename = date('Ymd_His') . '.' . pathinfo($filename, PATHINFO_EXTENSION);

        return $filename;
    }

    /**
     * Create the image from upload file.
     *
     * @param UploadedFile $file
     *
     * @return \Intervention\Image\Image
     */
    protected static function makeImage(UploadedFile $file)
    {
        return Image::make($file);
    }

    /**
     * Resize image to the configured size.
     *
     * @param \Intervention\Image\Image $img
     * @param int                       $maxWidth
     *
     * @return \Intervention\Image\Image
     */
    protected static function resizeImage(\Intervention\Image\Image $img, $maxWidth = 150)
    {
        $img->resize($maxWidth, null, function (Constraint $constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        return $img;
    }

    /**
     * Save the uploaded image to the file system.
     *
     * @param \Intervention\Image\Image $img
     * @param string                    $fileName
     * @param string                    $path
     */
    protected static function uploadImage($img, $fileName, $path)
    {
        $img->save($path . $fileName);
    }
}
