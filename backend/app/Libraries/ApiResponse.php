<?php

namespace App\Libraries;

use Illuminate\Http\Response;
use App\Traits\Staticable;

class ApiResponse extends Response
{
    use Staticable;

   /**
     *  Create api response.
     *  
     *  @param string $message
     *  @param int $code
     *  @param (array || null) $data
     * 
     *  @return \Illuminate\Http\Response
     */
    public static function response(string $message, int $code, array $data = null)
    {
        $content = [
            'message' => $message,
            'statusCode' => $code
        ];

        if ($data) {
            foreach ($data as $key => $data) {
                $content[$key] = $data;
            }
        }

        return response()->json($content, $code);
    }

    /**
     *  Success response.
     *  
     *  @param string $mesage
     *  @param int $code 
     * 
     *  @return \Illuminate\Http\Response
     */
    public static function success(string $message = 'Success', int $code = Response::HTTP_OK)
    {
        return self::successWithData([], $message, $code);
    }

    /**
     *  Failed response.
     * 
     *  @param string $message
     *  @param int $code
     * 
     *  @return \Illumnate\Http\Response
     */
    public static function failed(string $message = 'Unprocessable entity', $code = Response::HTTP_UNPROCESSABLE_ENTITY)
    {
        return self::response($message, $code);
    }

    public static function notFound(string $message = 'Not Found')
    {
        return self::response($message, Response::HTTP_NOT_FOUND);
    }

    /**
     *  Unauthorized user response.
     *  
     *  @return \Illuminate\Http\Response
     */
    public static function unauthorized()
    {
        return self::response('Unauthorized', Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Success response with additional data.
     * 
     * @return \Illuminate\Http\Response
     */
    public static function successWithData($data, string $message = 'Success', int $code = Response::HTTP_OK)
    {
        $data = collect($data)->put('success', true);
        return self::response($message, $code, $data->toArray());
    }
}
