<?php

    /**
     * Flickr pages
     */

    namespace IdnoPlugins\Flickr\Pages {

        /**
         * Default class to serve Flickr settings in administration
         */
        class Admin extends \Idno\Common\Page
        {

            function getContent()
            {
                $this->adminGatekeeper(); // Admins only
                $t = \Idno\Core\site()->template();
                $body = $t->draw('admin/flickr');
                $t->__(array('title' => 'Flickr', 'body' => $body))->drawPage();
            }

            function postContent() {
                $this->adminGatekeeper(); // Admins only
                $apiKey = $this->getInput('apiKey');
                $secret = $this->getInput('secret');
                \Idno\Core\site()->config->config['flickr'] = array(
                    'apiKey' => $apiKey,
                    'secret' => $secret
                );
                \Idno\Core\site()->config()->save();
                \Idno\Core\site()->session()->addMessage('Your Flickr application details were saved.');
                $this->forward(\Idno\Core\site()->config()->getDisplayURL() . 'admin/flickr/');
            }

        }

    }