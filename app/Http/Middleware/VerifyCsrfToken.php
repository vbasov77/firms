<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
//        '/get_inn',
//        '/add_inn',
//        '/add_about',
//        '/get_about',
//        '/add_dir',
//        '/get_dir',
//        '/add_addr',
//        '/get_addr',
    ];
}
