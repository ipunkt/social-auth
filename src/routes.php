<?php

Route::get('social/auth', ['as' => 'social.auth', 'uses' => 'Ipunkt\SocialAuth\SocialLoginController@auth']);
Route::get('social/login/{provider}', ['as' => 'social.login', 'uses' => 'Ipunkt\SocialAuth\SocialLoginController@login', 'before' => 'guest']);
Route::get('social/register/{provider}', ['as' => 'social.register', 'uses' => 'Ipunkt\SocialAuth\SocialRegisterController@register', 'before' => 'guest']);
Route::get('social/attach/{provider}', ['as' => 'social.attach', 'uses' => 'Ipunkt\SocialAuth\SocialRegisterController@attach', 'before' => 'auth']);
