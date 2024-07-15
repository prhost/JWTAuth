<?php
declare(strict_types=1);

namespace Prhost\JWTAuth\Http\Controllers;

use Prhost\JWTAuth\Classes\Contracts\UserPluginResolver;
use Prhost\JWTAuth\Classes\Guards\JWTGuard;

/**
 * Base JWTAuth Controller
 */
abstract class Controller
{
    /**
     * @var UserPluginResolver
     */
    protected UserPluginResolver $userPluginResolver;

    /**
     * @var JWTGuard
     */
    protected JWTGuard $JWTGuard;

    /**
     * @param UserPluginResolver $userPluginResolver
     */
    public function __construct(UserPluginResolver $userPluginResolver)
    {
        $this->userPluginResolver = $userPluginResolver;
        $this->JWTGuard = app('JWTGuard');
    }
}
