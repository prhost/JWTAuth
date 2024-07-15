<?php
declare(strict_types=1);
namespace Prhost\JWTAuth\Http\Middlewares;

use Prhost\JWTAuth\Classes\Guards\JWTGuard;

/**
 * Class SoftResolveUser
 * @package Prhost\JWTAuth\Http\Middlewares
 */
class SoftResolveUser
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($obRequest, \Closure $next)
    {
        try {
            /** @var JWTGuard $obJWTGuard */
            $obJWTGuard = app('JWTGuard');
            $obJWTGuard->user();
        } catch (\Exception $ex) {}

        return $next($obRequest);
    }
}
