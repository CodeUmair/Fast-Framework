<?php

namespace App\Core;

class Session
{
    public static function startSession()
    {
        ini_set('session.use_only_cookies', SESSION_USE_ONLY_COOKIES);

        $cookieParams = session_get_cookie_params();
        session_set_cookie_params(
            $cookieParams["lifetime"],
            $cookieParams["path"],
            $cookieParams["domain"],
            SESSION_SECURE,
            SESSION_HTTP_ONLY
        );

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function destroySession()
    {
        $_SESSION = array();

        $params = session_get_cookie_params();

        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );

        session_destroy();
    }

    public static function regenerate($deleteOldSession = true)
    {
        return session_regenerate_id($deleteOldSession);
    }

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function destroy($key)
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    public static function get($key, $default = null)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }

        return $default;
    }

    public static function is_Admin()
    {
        return (isset($_SESSION["is_admin"]) && $_SESSION["is_admin"] === 1) ? true : false;
        // Session::set("is_admin", 1);
    }

    public static function is_User()
    {
        return (isset($_SESSION["is_user"]) && $_SESSION["is_user"] === 1) ? true : false;
        // Session::set("is_user", 1);
    }
}
