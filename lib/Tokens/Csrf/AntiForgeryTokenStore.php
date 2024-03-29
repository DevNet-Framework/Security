<?php

/**
 * @author      Mohammed Moussaoui
 * @license     MIT license. For more license information, see the LICENSE file in the root directory.
 * @link        https://github.com/DevNet-Framework
 */

namespace DevNet\Security\Tokens\Csrf;

use DevNet\Security\Session;

class AntiForgeryTokenStore
{
    private Session $session;

    public function __construct(AntiForgeryOptions $options)
    {
        $this->session = new Session($options->CookieName, $options->CookieName);
    }

    public function saveCookieToken(AntiForgeryToken $token): void
    {
        $this->session->start();
        $this->session->set(AntiForgeryToken::class, $token);
    }

    public function getCookieToken(): ?AntiForgeryToken
    {
        $this->session->start();
        return $this->session->get(AntiForgeryToken::class);
    }
}
