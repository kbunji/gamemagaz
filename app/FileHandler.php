<?php
/**
 * Created by PhpStorm.
 * User: Bunji
 * Date: 06.07.2018
 * Time: 10:16
 */

namespace App;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class FileHandler
{
    public function loadFile($file, $path)
    {
        $img = Image::make($file)->resize(300, 300)->save($path);
    }

    public function hasRequestFile(Request $request)
    {
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            return true;
        }
        return false;
    }
}