<?php
/**
 * Created by PhpStorm.
 * UserInterface: sven
 * Date: 14.05.14
 * Time: 12:34
 */
return [
    'register route' => 'auth.user.create',

    // This config value is used to set up foreign key and cascade on delete for the social network <-> user table
    // If left at 'null' it will try to  use 'auth::user table.table name' instead
    'user table' => null,

    /**
     * This is 'config file' which is supplied to hybrid_auth.
     * @see http://hybridauth.sourceforge.net/userguide/Configuration.html
     */
    'hybridauth' => [
        'base_url' => 'http://localhost:8000/social/auth',
        'providers' => [
            'Facebook' => [
                'enabled' => true,
                'keys' => ['id' => '314397715379515', 'secret' => 'fefc06c9fb52badab6071558f4162bcb'],
            ],
            'Twitter' => [
                'enabled' => false,
                'keys' => ['key' => 'eTc3liEjj4oZPphPWXzQUL8xp', 'secret' => '5mxqcPAScWWjQ6B5BZcTBKhPq25owqbW1Iddql4bYwc7qlUCvj'],
            ],
        ],
    ],
];