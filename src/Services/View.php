<?php

namespace app\Services;

class View
{
    public static function start(): void
    {
        echo '<pre>';
    }

    public static function finish(): void
    {
        echo '</pre>';
        die;
    }

    public static function show($data): void
    {
        print_r($data);
    }
}