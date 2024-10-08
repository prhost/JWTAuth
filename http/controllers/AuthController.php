<?php
declare(strict_types=1);

namespace Prhost\JWTAuth\Http\Controllers;

use October\Rain\Argon\Argon;
use Prhost\JWTAuth\Classes\Dto\TokenDto;
use Prhost\JWTAuth\Http\Requests\LoginRequest;
use Prhost\JWTAuth\Http\Resources\TokenResource;

/**
 *
 */
class AuthController extends Controller
{
    /**
     * @param LoginRequest $loginRequest
     * @return array
     * @throws \ApplicationException
     */
    public function __invoke(LoginRequest $loginRequest): array
    {
        $user = $this->userPluginResolver
            ->getProvider()
            ->authenticate($loginRequest->validated());

        if (empty($user)) {
            throw new \ApplicationException('Login failed');
        }

        $tokenDto = new TokenDto([
            'token' => $this->JWTGuard->login($user),
            'expires' => Argon::createFromTimestamp($this->JWTGuard->getPayload()->get('exp')),
            'user' => $user,
        ]);

        return ['data' => $tokenDto->toArray()];
    }
}
