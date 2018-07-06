<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    use MainData;

    const TITLE_CODE = 0;

    public function index()
    {
        $data = $this->getData();
        return view('admin.index')->with($data);
    }

    protected function getTitleCode()
    {
        return self::TITLE_CODE;
    }
}
