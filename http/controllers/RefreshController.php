<?php
declare(strict_types=1);

namespace Prhost\JWTAuth\Http\Controllers;

use October\Rain\Argon\Argon;
use Prhost\JWTAuth\Classes\Dto\TokenDto;

/**
 *
 */
class RefreshController extends Controller
{
    /**
     * @return array
     */
    public function __invoke(): array
    {
        $tokenRefreshed = $this->JWTGuard->refresh(true);
        $this->JWTGuard->setToken($tokenRefreshed);

        $tokenDto = new TokenDto([
            'token' => $tokenRefreshed,
            'expires' => Argon::createFromTimestamp($this->JWTGuard->getPayload()->get('exp')),
            'user' => $this->JWTGuard->user(),
        ]);

        return ['data' => $tokenDto->toArray()];
    }
}
