<?php
/**
 * Created by PhpStorm.
 * User: Bunji
 * Date: 06.07.2018
 * Time: 10:16
 */

namespace App\Services;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class FileHandler
{
    public function loadFile($file, $path)
    {
        $img = Image::make($file)->resize(300, 300)->save($path);
        return $img;
    }

    public function getRequestFile(Request $request)
    {
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $file = $request->file('photo');
            return $file;
        }
    }
}