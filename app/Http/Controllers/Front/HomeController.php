<?php

namespace App\Http\Controllers\Front;

use App;
use App\Http\Controllers\Controller;
use App\Repositories\ArticleRepository;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('front.home.index');
    }
}
