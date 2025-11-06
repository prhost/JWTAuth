<?php
declare(strict_types=1);

namespace Prhost\JWTAuth\Classes;

use Model;
use Prhost\JWTAuth\Classes\Contracts\Plugin;
use System\Classes\PluginManager;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use October\Rain\Support\Traits\Singleton;
use October\Rain\Auth\Manager as AuthManager;
use Prhost\JWTAuth\Classes\Contracts\UserPluginResolver as UserPluginResolverContract;

/**
 *
 */
final class UserPluginResolver implements UserPluginResolverContract
{
    use Singleton;

    private array $plugin;

    /**
     * Boot resolver
     *
     * @throws \SystemException
     * @return void
     */
    public function init(): void
    {
        $plugins = $this->getSupportPlugins();
        
        foreach($plugins as $plugin) {
            // Verifica se a classe do modelo existe em vez de verificar se é um plugin real
            // Isso permite usar identificadores personalizados como Metastore.Api.Backend
            if (class_exists($plugin['model'])) {
                $this->plugin = $plugin;
                break;
            }
        }

        if (empty($this->plugin)) {
            $models = implode(', ', array_column($plugins, 'model'));
            throw new \SystemException(
                "No valid user model found. Searched for models: [{$models}]"
            );
        }
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return $this->plugin['model'];
    }

    public function getResolver(): Plugin
    {
        return app($this->plugin['resolver']);
    }

    /**
     * @param $model
     * @return JWTSubject
     */
    public function resolveModel($model): JWTSubject
    {
        return $this->getResolver()->resolve($model);
    }

    /**
     * @return AuthManager
     */
    public function getProvider(): AuthManager
    {
        return app($this->plugin['provider']);
    }

    /**
     * @return array
     */
    public function getSupportPlugins(): array
    {
        return config('prhost.jwtauth::plugins');
    }
}
