<?php

if (!function_exists('response')) {
    function response()
    {
        return new class {
            public function json($data, $status = 200, $headers = [], $options = 0)
            {
                return null;
            }
        };
    }
}

if (!function_exists('storage_path')) {
    function storage_path($path = '')
    {
        return __DIR__ . '/../storage/' . ltrim($path, '/');
    }
}
