<?php

return [
    [
        'name'     => 'Rainlab.User',
        'model'    => 'RainLab\User\Models\User',
        'resolver' => \Prhost\JWTAuth\Classes\Resolvers\RainlabPlugin::class,
        'provider' => 'user.auth',
    ],
//    [
//        'name' => 'Lovata.Buddies',
//        'model' => 'Lovata\Buddies\Models\User',
//        'resolver' => \Prhost\JWTAuth\Classes\Resolvers\BuddiesPlugin::class,
//        'provider' => 'auth.helper',
//    ]
];
