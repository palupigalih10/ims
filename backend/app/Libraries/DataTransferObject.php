<?php

namespace App\Libraries;

use Illuminate\Http\Request;
use App\Traits\Staticable;
use RuntimeException;

class DataTransferObject
{
    use Staticable;

    /**
     *  The incoming request parameters.
     *  
     *  @return \Iluminate\Http\Request
     */
    protected static $request;

    /**
     *  The applicatin that should resolved.
     *  
     *  @return string
     */
    protected static $shouldResolve;

    public function __construct()
    {
        $this->request = self::$request;
    }

    /**
     *  Get class property.
     * 
     *  @param string $prop
     *  @return mixed
     */
    public function __get($prop)
    {
        return $this->$prop;
    }

    /**
     *  Set new class property.
     * 
     *  @param string $prop
     *  @param mixed $value
     *  @return void
     */
    public function __set($prop, $value): void
    {
        $this->$prop  = $value;
    }

    /**
     *  Resolve sub class.
     *  
     *  @return void
     */
    protected static function resolveSubClass(): void
    {
        $subClass = self::$shouldResolve;
        if (method_exists($subClass, 'boot')) {
            $app = app()->make($subClass);
            $app->boot();
        }
    }

    /**
     *  Initialize incoming request instance.
     * 
     *  @param \Illuminate\Http\Request
     */
    public static function initRequest(Request $request): void
    {
        static::$request = $request;
    }

    /**
     *  Initialize incoming request data.
     * 
     *  @param \Illuminate\Http\Request $request
     *  @return self::class
     */
    public static function fromRequest(Request $request)
    {
        $app = self::root();
        $app->initRequest($request);
        $app->merge($request->all());
        if (get_called_class()) {
            static::$shouldResolve = get_called_class();
        }
        $app->resolveSubClass();

        return $app;
    }

    /**
     * Initialize incoming array data.
     *  
     * @param array $resource
     * @return self::class
     */
    public function fromArray(array $resource)
    {
        $app = self::root();
        $app->merge($resource);

        if (get_called_class()) {
            static::$shouldResolve = get_called_class();
        }
        $app->resolveSubClass();

        return $app;
    }

    /**
     *  Merge data property.
     * 
     *  @param array $properties
     *  @return self::class
     */
    public static function merge(array $properties)
    {
        $instance = self::root();

        if (is_array($properties)) {
            foreach ($properties as $key => $value) {
                $instance->$key = $value;
            }
        }

        return $instance;
    }

    /**
     *  Unset the given property.
     * 
     *  @param (string|array) $property
     *  @return void
     * 
     *  @throws RuntimeException
     */
    public static function unset($property): void
    {
        if (!is_array($property) && !is_string($property)) {
            throw new RuntimeException('Invalid the given parameter $property');
        }

        switch (is_array($property)) {
            case true:
                foreach ($property as $key => $prop) {
                    unset(self::$app->$prop);
                }
                break;

            default:
                unset(self::$app->$property);
                break;
        }
    }
}
