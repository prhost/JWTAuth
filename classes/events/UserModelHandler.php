<?php namespace Prhost\JWTAuth\Classes\Events;

use Illuminate\Contracts\Auth\Authenticatable;
use Prhost\JWTAuth\Classes\Contracts\UserPluginResolver;
use Prhost\JWTAuth\Classes\Behaviors\UserSubjectBehavior;

class UserModelHandler
{
    /**
     * Add listeners
     * @param \October\Rain\Events\Dispatcher $event
     */
    public function subscribe($event)
    {
        $model = app(UserPluginResolver::class)->getModel();
        $model::extend(static function (Authenticatable $userModel) {
            $userModel->implement[] = UserSubjectBehavior::class;
        });
    }
}
