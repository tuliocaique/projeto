<?php

namespace Projeto;
class Flash
{

    public static function flash($key, $message)
    {
        if (empty(session_id()) && !headers_sent()) {
            session_start();
        }

        $_SESSION['flash'][$key] = $message;
    }

    /**
     * @param $key
     * @return string|null
     */
    public static function message($key)
    {
        if (empty(session_id()) && !headers_sent()) {
            session_start();
        }

        if (isset($_SESSION['flash'][$key])) {
            $flash = $_SESSION['flash'][$key];
            unset($_SESSION['flash'][$key]);
            return $flash;
        }
        return null;
    }

}