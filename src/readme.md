# Laravel Socialauth Package
This package allows for easy integration of authenticating through 3rd parties using the hybrid_auth library  

## Install
* composer require  
* export config  
* edit 'user table'  
* migrate  
* Add your providers to the 'hybridauth' config variable. For further info, see the [Hybridauth Dokumentation](http://hybridauth.sourceforge.net/userguide/Configuration.html)  

## Integrate with template
This Package does not bring any views of its own. Warning and infos are flashes as 'message', errors are flashed as errors['error']

### Login
Accessing the url /social/login/{provider} will let the user authenticate with the provider if configured.  

* If the social-auth user is attached to a user in this system, the user will get logged in and redirected with Redirect::intended  
* If the social-auth user is not attached to a user in this system, a redirect to the 'register route' as set in the config will happen, see Registering for more information  

### Attaching a social-auth user to an existing user
Accessing /social/attach/{provider} while logged in will let the user authenticate with the provider if configured  

* If the social-auth user is not attached to a user in this system it will get attached to the currently logged in user  
* If the social-auth user is already attached to a user in this system an error will be displayed  

### Registering a user with a social-auth provider
Accessing /social/register/{provider} while not logged in will let the user authenticate with the provider if configured  

* if the social-auth user is not attached to a user in this system the page will redirect to the register page as set in
    the config and flash it a RegisterInfoInterface object under the name registerInfo.  
    This object can be used to query the profile using getInfo('info name string'), for example to pre-fill the pages of the
    register form.  
    If registerInfo->providesLogin() returns true and registerInfo->success($newUser) is called after the user creation then
    the social-auth user will get attached to the newly created user  
* if the social-auth user is already attached to a user in this system the page will redirect to the register page and
    flash an error  