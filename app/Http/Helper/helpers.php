<?php


if (!function_exists('validate')) {
    function successResponse($data = [], $code = 200, $pagination = null, $message = '', $extra = [])
    {
        $data = [
            'status'    => true,
            'message'   => $message,
            'data'      => $data,
        ];

        if (!empty($extra)) {
            $data = array_merge($data, $extra);
        }

        if ($pagination) {
            $data['pagination'] = $pagination;
        }

        return response()->json($data, $code);
    }
}

if (!function_exists('validate')) {
    function errorResponse($message, $code = 400, $data = [], $extra = [])
    {
        $data = [
            'status'    => false,
            'message'   => $message,
            'data'      => $data,
        ];

        if (!empty($extra)) {
            $data['extra'] = $extra;
        }

        return response()->json($data, $code);
    }
}
