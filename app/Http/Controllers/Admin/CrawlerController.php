<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class CrawlerController extends Controller
{
    public function index()
    {
        return view('pages.admin.' . config('view.admin') . '.crawlers.index', [
        ]);
    }
}
