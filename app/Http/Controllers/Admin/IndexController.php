<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CondominiumsmanilaRepositoryInterface;
use App\Repositories\PhrealestateRepositoryInterface;

class IndexController extends Controller
{
    /** @var \App\Repositories\CondominiumsmanilaRepositoryInterface */
    protected $condominiumsmanilaRepository;

    /** @var \App\Repositories\PhrealestateRepositoryInterface */
    protected $phrealestateRepository;

    public function __construct(
        CondominiumsmanilaRepositoryInterface   $condominiumsmanilaRepository,
        PhrealestateRepositoryInterface         $phrealestateRepository
    )
    {
        $this->condominiumsmanilaRepository     = $condominiumsmanilaRepository;
        $this->phrealestateRepository           = $phrealestateRepository;
    }

    public function index()
    {
        return view('pages.admin.' . config('view.admin') . '.index', [
        ]);
    }

}
