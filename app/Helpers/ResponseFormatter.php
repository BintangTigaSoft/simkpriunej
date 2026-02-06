<?php

namespace App\Helpers;

use CodeIgniter\HTTP\ResponseInterface;

class ResponseFormatter
{
    /**
     * Format response sukses standard
     *
     * @param mixed $data Data utama (object/array)
     * @param string|null $message Pesan sukses
     * @param int $code HTTP Status Code (default 200)
     * @return ResponseInterface
     */
    public static function success($data = null, $message = null, $code = 200): ResponseInterface
    {
        $response = [
            'status' => 'success',
            'code'   => $code,
            'message' => $message,
            'data'   => $data,
        ];

        return service('response')->setJSON($response)->setStatusCode($code);
    }

    /**
     * Format response error standard
     *
     * @param mixed $errors Data error detail (biasanya array validasi)
     * @param string|null $message Pesan error global
     * @param int $code HTTP Status Code (default 400)
     * @return ResponseInterface
     */
    public static function error($errors = null, $message = null, $code = 400): ResponseInterface
    {
        $response = [
            'status' => 'error',
            'code'   => $code,
            'message' => $message,
            'errors' => $errors,
        ];

        return service('response')->setJSON($response)->setStatusCode($code);
    }
}
