<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsAdminController extends Controller
{
    public function create(){
        return view('admin.new.add', [
            'title' => 'Thêm tin tức',
        ]);
    }
}
