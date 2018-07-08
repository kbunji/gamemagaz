<?php

namespace App\Http\Controllers;

class AdminController extends MainDataController
{
    const TITLE_CODE = 0;

    public function index()
    {
        $data = $this->getData();
        return view('admin.index')->with($data);
    }
}
