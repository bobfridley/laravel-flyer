<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    /**
     * $user
     * 
     * @var Illuminate\Support\Facades\Auth
     */
    protected $user;

    /**
     * [__construct description]
     */
    public function __construct()
    {
        $this->user = Auth::user();

        view()->share('signedIn', Auth::check());
        view()->share('user', $this->user);
    }
}
