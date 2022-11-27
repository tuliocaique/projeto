<?php

namespace Projeto;
class Flash
{

    public static function flash($key, $message)
    {
        session_status() === PHP_SESSION_ACTIVE || session_start();
        $_SESSION['flash'][$key] = $message;
    }

    /**
     * @param $key
     * @return string|null
     */
    public static function message($key)
    {
        session_status() === PHP_SESSION_ACTIVE || session_start();
        if (isset($_SESSION['flash'][$key])) {
            $flash = $_SESSION['flash'][$key];
            unset($_SESSION['flash'][$key]);
            return $flash;
        }
        return null;
    }

}