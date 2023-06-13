<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        '/api/v1/auth/createSchool',
        '/api/v1/auth/schoolLogin',
        '/api/v1/auth/createStudent',
        '/api/v1/auth/studentLogin',
        '/api/v1/auth/*'
    ];
}
