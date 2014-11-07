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

### Add the service provider
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

### Error and Message Handling
This package tries not to bring any views of its own, thus error handling is done through the session.
On success, 'message' will be set directly in the Session. e.g. `{{ Session::get('message') }}`
On error, 'message' will be set in errors. e.g. {{ $errors->first('message') }}

### Authenticating with SocialAuth

#### Login

Letting your users log in through a SocialAuth provider is as simple as directing them to the `social.login` route with
the name of the provider as parameter.
```blade
{{ link_to_route('social.login', 'log in through Facebook',  'Facebook' }}
```

#### Attaching a Provider 

#### Registering

Allowing your users to register using a provider account requires a little more work.  

- First, make sure the 'register route' variable is set correctly in your config file.  
- Provide the user a link to the `social.register` route, with the provider name as its parameter. e.g.
    `{{ link_to_route('social.register', 'register through Facebook', ['Facebook']) }}`
- If the user successfully logs into the provider they will be redirected back to your registration process. There you
    can access their account data through SocialAuth::getRegistration()
- If the registration process finishes successfuly, call SocialAuth::getRegistration()->success($newlyCreatedUser) to
    create the connection between the local and provider account.

#### Links to all enabled Providers
Most of the time you will want to provide links to all enabled providers instead of a certain one.  
To do this, use `SocialAuth::getProviders()` to grab all enabled providers and use *Link($innerHtml) to have it build a link
for you.  

- ProviderInterface::loginLink($innerHtml)
- ProviderInterface::attachLink($innerHtml)
- ProviderInterface::registerLink($innerHtml)

Example:

```blade
@foreach(SocialAuth::getProviders() as $provider)
    if(Auth::check()) {
        // A link which lets you attach a user from this provider to your local account
        {{ $provider->attachLink($provider->getName()) }}
    } else {
        // A link which lets you login through this provider
        {{ $provider->loginLink($provider->getName()) }}
    
        // A link which lets a user request a running registration to use an account on this provider to login
        {{ $provider->registerLink($provider->getName()) }}
    }
@endforeach
```

#### Profile
The Profile is currently dependant on Hybrid_Auth_Profile as the underlying package

ProfileInterface  

Function            | returned value
------------------- | --------------
getIdentifier	    | The unique identifier string by which the provider identifies the user
getProfileUrl	    | Profile URL
getWebsiteUrl	    | Website URL
getPhotoUrl	        | Photo URL
getDisplayName	    | Display name or "$firstName $lastName"
getDescription	    | 
getFirstName	    | First name
getLastName	        | Last name
getGender	        | Gender
getLanguage	        | Language
getAge	            | Age
getBirthDay	        | Day of Birth
getBirthMonth	    | Month of Birth
getBirthYear	    | Year of Birth
getEmail	        | Email
getVerifiedEmail	| Verified Email if the provider allows it
getPhone	        | Phone number
getAddress	        | Address
getCountry	        | Country
getRegion	        | Region
getCity	            | City
getZip	            | ZIP or Postal code

There are 3 Ways to access Profiles:

- Through the providers  
    `SocialAuth::getProviders()['Facebook']->getProfile()`  
    This will give you the currently logged in Users Profile on the given Provider. If the User is not currently logged
    in through this Provider then the values stored in the Database will be returned.
- Through `SocialAuth::getProfile`
    This will give you the Profile of the currently logged in User with the special 'UserProfile' Provider. It contains the
    same data as the first Provider Profile to be registered or attached to this user.
- Through the UserModel implementing HasProfileInterface
    implementing HasProfileInterface will allow you to manage profiles not just for the active user but all users in your database.
    A default implementation using Eloquent is available through the `EloquentHasProfile` trait

### Return Url
Your provider will ask you to set a return url where user logging into your application get sent.
This is static: http://path.to/your/laravel/installation/social/auth

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
