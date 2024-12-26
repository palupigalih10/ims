<?php

namespace App\Traits;

use Illuminate\Support\Facades\App;

trait Staticable
{
    /**
     *  The static application.
     * 
     *  @return static::class
     */
    protected static $app;

    /**
     *  Get the application.
     * 
     *  @return self::class
     */
    protected static function root()
    {
        if (!static::$app) {
            static::$app = App::make(self::class);
        }

        return self::$app;
    }
}
