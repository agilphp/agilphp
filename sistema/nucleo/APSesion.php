<?php
namespace sistema\nucleo;



class APSesion 
{

    public function __construct(?string $cacheExpire = null, ?string $cacheLimiter = null)
    {
        if (session_status() === PHP_SESSION_NONE) {

            if ($cacheLimiter !== null) {
                session_cache_limiter($cacheLimiter);
            }

            if ($cacheExpire !== null) {
                session_cache_expire($cacheExpire);
            }

            session_start();
        }
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function get(string $key)
    {
        if ($this->has($key)) {
            return $_SESSION[$key];
        }

        return null;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return SessionManager
     */
    public function set(string $key, $value)
    {
        $_SESSION[$key] = $value;
        return $this;
    }

    public function remove(string $key): void
    {
        if ($this->has($key)) {
            unset($_SESSION[$key]);
        }
    }

    public function clear(): void
    {
        session_unset();
    }

    public function has(string $key): bool
    {
        return array_key_exists($key, $_SESSION);
    }

    /*
     * 
     * 
     * $session = new \DevCoder\SessionManager();
        $session->set('token', 'hash');

        var_dump($session->get('token'));
        // hash
        $session->remove('token');
        var_dump($session->get('token'));
        // NULL
        https://dev.to/fadymr/php-create-a-simple-session-wrapper-class-dpk
        Simple and easy!
        https://github.com/devcoder-xyz/php-session-manager
     * 
     */

}