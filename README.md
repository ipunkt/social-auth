ipunkt/social-auth
============

Social-Auth is a Laravel package which wraps around a oauth library and laravel with the goal to let you simply
set the provider credentials and be done.

It currently uses hybrid_auth in the background.
With the coming of the new SocialLite package for laravel i will probably switch out hybrid_auth for it.


# Install

## Installation

Add the following lines to your composer.json:

    "require": {
        "ipunkt/social-auth": "dev-master"
    }

## Configuration

To configure 3 steps are necessary.  
If you wish for user deletes to trigger deletion of their mappings to provider accounts make sure to set the
'user table' variable in the config before migrating

### Add the Social provider
Add 

    'Ipunkt\SocialAuth\SocialAuthServiceProvider'


to your app.php

### Publish and set your config

Publish

    php artisan config:publish ipunkt/social-auth

then set your provider credentials in

    app/config/packages/ipunkt/social-auth/config.php

### Migrate
Migrate the necessary database tables.

    php artisan migrate --package="ipunkt/social-auth"
    
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

Action                                  |True                               |False
----------------------------------------|-----------------------------------|----------------
Already logged in?                      |                                   | Ask user to log in to the provider
Provider account already mapped to user | set $errors['message'] in Session | Create mapping between the currently logged in user and the provider account
Redirect back | |

#### Logging in through a service provider account
How: provide the user with a link to the social.login route, with the provider name as Parameter  
Example: `{{ link_to_route('social.login', 'Facebook') }}`

What happens:

Action                                  |True                               |False
----------------------------------------|-----------------------------------|----------------
Logged in to local account?             |                                   | Redirect back with errors['message'] set
Logged in to provider account?          |                                   | User is asked to log into the provider
Provider account already mapped to user | Log in local account              | set $errors['message'] in Session
Redirect back | |

#### Registering a new local account using a provider account
This is done through the 'social.register' route _from within the register process_.  
It expects the name of the Provider as set in the config as its parameter.  
Example: `{{ link_to_route('social.register', 'Facebook') }}`

Action                                  |True                               |False
----------------------------------------|-----------------------------------|----------------
User logged in to local account?        | Redirect back                     |
User logged in to provider account?     |                                   | User is asked to log into the provider
Provider account mapped to local user?  | set $errors['message'] in Session | Set RegisterInfoInterface to be retrieved with SocialAuth::getRegisteration()

The RegisterInfo Object provides information about the user and allows the creation of the mapping once the register
process is done.  

- $registerInfo->providesLogin() will return true if the mapping can be used to log in, thus it is not necessary to ask
for a separate password.
- $registerInfo->getInfo($fieldName) allows to access the profile of the service provider account. See 
http://hybridauth.sourceforge.net/userguide/Profile_Data_User_Profile.html for what info can be obtained through which
fieldName
- $registerInfo->success($registeredUser) will create the mapping of the provider account to the given local account
- $registerInfo->fail() is deprecated

Note that the registerInfo Object is 'flashed' to the Session so it will not linger between registering attemps.  
This means however that you have to reflash in your registration controller or it will be lost going from creating to
storing the user.

### Links to all available providers
To provide links to all enabled providers use the SocialAuth::get*Links() functions.

- getLoginLinks()
- getRegisterLinks()
- getAttachLinks()

Example use:  
```blade
@foreach( SocialAuth::getLoginLinks() as $link)
    {{ $link->getLink($link->getName()) }}
@endforeach
```


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
