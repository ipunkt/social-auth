<?php namespace Ipunkt\SocialAuth\Composers;

use Session;

class RegisterInfoComposer {
    public function compose($view) {
        if(Session::has('registerInfo'))
            $view->with('registerInfo', Session::get('registerInfo'));
    }
}