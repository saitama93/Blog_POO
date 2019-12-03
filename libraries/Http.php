<?php

class Http
{
    /**
     * Redirige le visiteur vers une url
     */
    public static function redirect(string $url): void
    {

        header("Location: $url");
        exit();
    }
}
