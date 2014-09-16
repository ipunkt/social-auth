<?php namespace Ipunkt\SocialAuth\Composers;

use Config;

class LinkComposer {
    protected function makeLinks($route) {
        $links = [];

        $full_config = Config::get('social-auth::hybridauth');
        $providers = $full_config['providers'];
        foreach($providers  as $provider_name => $values) {
            $link = new SocialLink();

            $link->name = $provider_name;
            $link->url = route($route, $provider_name);

            if(array_key_exists('image', $values))
                $links->image = $values['image'];

            $links[] = $link;
        }

        return $links;
    }

    protected function makeLoginLinks() {
        return $this->makeLinks('social.login');
    }

    protected function makeRegisterLinks() {
        return $this->makeLinks('social.register');
    }

    protected function makeAttachLinks() {
        return $this->makeLinks('social.attach');
    }

    public function compose($view) {
        $login_links = $this->makeLoginLinks();
        $register_links = $this->makeRegisterLinks();
        $attach_links = $this->makeAttachLinks();

        $view->with('socialauth_login_links', $login_links);
        $view->with('socialauth_register_links', $register_links);
        $view->with('socialauth_attach_links', $attach_links);
    }
}