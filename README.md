ipunkt/social-auth
============

Social-Auth wraps around an oauth library, currently hybrid_auth, to provide oauth by pulling this package in and
setting your provider credentials.

I will probably switch out hybrid_auth in favor of the new socialite laravel package in the future


# Install

## Installation

Add the following lines to your composer.json:

    "require": {
        "ipunkt/social-auth": "dev-master"
    }

## Configuration

To configure social-auth 3 steps are necessary. The order of these steps does not matter.

### Add the Social provider
Add 

    'Ipunkt\Permissions\SocialAuthServiceProvider'

to your app.php

### Publish and set your config

Publish

    php artisan config::publish ipunkt/social-auth

then set your provider credentials in

    app/config/packages/ipunkt/social-auth/config.php

### Migrate
Migrate the necessary database tables.

    php artisan migrate
    
## Use

To provide 3rd party login we need to provide 2 things:

### Return Url
Your provider will ask you to set a return url where user logging into your application get sent.
This is static: http://path.to/your/laravel/installation/social/auth

### Mapping
After a user logs into their provider we need to map him to a local account, if any exists.  
this is done through an Eloquent model by default. See the Advanced Use sections if you wish to change this.

Thus we need to offer the User 3 interactions with their provider account.

#### Adding a provider account to an already existing local account.
How: provide the user with a link to the social.attach route, with the provider name as Parameter  
Example: `{{ link_to_route('social.attach', 'Facebook') }}`

What happens:

- If the user is not already logged into the provider, he is asked to log in
- If the provider account is already mapped to a local account: flash error message to Session: $errors['message']
- If the provider account is not mapped yet it will now be mapped to the currently logged in account. flash success message to Session: 'message'
- Redirect back to the url the user came from.

#### Logging in through a service provider account
How: provide the user with a link to the social.login route, with the provider name as Parameter  
Example: `{{ link_to_route('social.login', 'Facebook') }}`

What happens:

- If the user is already logged in to a local account he is redirected back to the url he came from
- If the user is not logged in to a local account and is not logged in to a service provider account he is asked to log
into his service provider account
- If the service provider account is mapped to a local account: The user is logged in to the local account and Redirected
to `intended`, flash success message to Session: $message
- If the service provider account is not mapped to a local account: flash error message to Session: $errors['message'],
Redirect back to the url the user came from.

#### Registering a new local account using a provider account
This is done through the 'social.register' route _from within the register process_.  
It expects the name of the Provider as set in the config as its parameter.  
Example: `{{ link_to_route('social.register', 'Facebook') }}`

What happens:
- If the user is already logged in to a local account he is redirected back to the url he came from
- If the user is not logged in to a local account and is not logged in to a service provider account he is asked to log
into his service provider account
- If the service provider account is mapped to a local account: Redirect back, flash error message to Session: $errors['message']
- If the service provider account is not mapped to a local account: flash RegisterInfo object to Session: $registerInfo,
Redirect back to the registering Process

The RegisterInfo Object provides information about the user and allows the creation of the mapping once the register
process is done.  

- $registerInfo->providesLogin() will return true if the mapping can be used to log in, thus it is not necessary to ask
for a sperarate password.
- $registerInfo->getInfo($fieldName) allows to access the profile of the service provider account. See 
http://hybridauth.sourceforge.net/userguide/Profile_Data_User_Profile.html for what info can be obtained through which
fieldName
- $registerInfo->success($registeredUser) will create the mapping of the provider account to the given local account
- $registerInfo->fail() is deprecated

Note that the registerInfo Object is 'flashed' to the Session so it will not linger between registering attemps.  
This means however that you have to reflash in your registration controller or it will be lost going from creating to
storing the user.

### Links to all available providers
Instead of providing each link individualy most of the time it makes more sense provide a list of links to all providers
which have been enabled in the config. To do this, 3 variables are passed to your View: $socialauth_login_links,
$socialauth_register_links and $socialauth_attach_links  

The have the format
`$socialauth_*_links = [
    [
        'name' => 'Facebook',
        'url' => 'http://path.to/your/laravel/installation/social/*/Facebook',
        'image' => '...' // This is only set if you provide image as extra field in the config
    ]
]`

Example use:  
`@foreach( $socialauth_login_links as $link)
    @if (array_key_exists('image', $link))
        <img src="{{ $link['image'] }}">
    @else
        <a href="{{ $link['url'] }}">{{ $link['name'] }}</a>
    @endif
@endforeach
`

## Advanced Use

### Use your own ORM

To switch out Eloquent for the ORM of your choice do the following

1.
Create a model which implements the SocialLoginInterface
Create a repository which implements the SocialLoginrepository interface

bind this repository to 'Ipunkt\SocialAuth\SocialLoginInterface' in the Laravel IoC

2.
Create a repository which implements the UserRepository interface

bind this repository to 'Ipunkt\SocialAuth\Repositories\UserRepository' in the Laravel IoC

## TODO
Provide objects and Facades to make links
