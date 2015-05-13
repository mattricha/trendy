<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;

    public static function errorResponseFactory($message, $code=200, $validation=null){

        $data = array(
            'error'   => true,
            'message' => $message,
            'code'    => $code,
        );

        if (!empty($validation)) {
            if ((is_object($validation)) && (method_exists($validation, 'toArray'))) {

                $validation = $validation->toArray();
            }
            $data['validation'] = $validation;
        }

        return self::JSON($data, $code);
    }

    /**
     * Return JSON data and set proper headers
     *
     * @param mixed  $data
     * @param int    $code         HTTP Code
     * @param string $lastModified in gmdate('r') format
     * @param string $eTag
     * @param int    $maxAge       in seconds
     */
    public static function JSON($data, $code=200, $lastModified=null, $eTag=null, $maxAge=null){

        $data = self::converToJson($data);
        return $data;

        //$response = Response::make($data, $code);
        $response->header('Content-Type', 'application/json; charset=UTF-8');
        $response->header('Content-Length', strlen($data));
        //$response->header('X-Environment', App::environment());

        return $response;
    }

    /**
     * Convert variable to JSON using toJson or toArray functions
     * if they are available.
     *
     * @param  mixed  $data
     * @return string JSON
     */
    public static function converToJson($data){

        if (is_array($data)) {
            foreach ($data as &$val) {
                if ((is_object($val)) || (is_array($val))) {
                    $val = json_decode(self::converToJson($val));
                }
            }

            return json_encode($data);
        } elseif (is_object($data)) {
            if (method_exists($data, 'toJson')) return $data->toJson();
            elseif (method_exists($data, 'toArray')) return json_encode($data->toJson());
            else return json_encode($data);
        } else return json_encode($data);
    }

}
