<?php

if (!function_exists('testbds')) {
    function testbds()
    {
        $testbds = cache()->remember('testbds', 24 * 60, function () {
            return \Modules\Testbd\Entities\Testbd::firstOrFail();
        });

        return $testbds;
    }
}

if (!function_exists('institutes')) {
    function institutes()
    {
        $institutes = cache()->remember('institutes', 24 * 60, function () {
            return \Modules\Informat\Entities\Institute::firstOrFail();
        });

        return $institutes;
    }
}

if (!function_exists('settings')) {
    function settings()
    {
        $settings = cache()->remember('settings', 24 * 60, function () {
            return \Modules\Setting\Entities\Setting::firstOrFail();
        });

        return $settings;
    }
  
}
if (!function_exists('machines')) {
    function machines()
    {
        $machines = cache()->remember('machines', 24 * 60, function () {
            return \Modules\Informat\Entities\Machine::firstOrFail();
        });

        return $machines;
    }
}

if (!function_exists('labelqrs')) {
    function labelqrs()
    {
        $labelqrs = cache()->remember('labelqrs', 24 * 60, function () {
            return \Modules\Labelqr\Entities\Labelqr::firstOrFail();
        });

        return $labelqrs;
    }
}

if (!function_exists('expeditions')) {
    function expeditions()
    {
        $expeditions = cache()->remember('expeditions', 24 * 60, function () {
            return \Modules\Expedition\Entities\Expedition::firstOrFail();
        });

        return $expeditions;
    }
}

if (!function_exists('format_currency')) {
    function format_currency($value, $format = true)
    {
        if (!$format) {
            return $value;
        }

        $settings = settings();
        $position = $settings->default_currency_position;
        $symbol = $settings->currency->symbol;
        $decimal_separator = $settings->currency->decimal_separator;
        $thousand_separator = $settings->currency->thousand_separator;

        if ($position == 'prefix') {
            $formatted_value = $symbol . number_format((float) $value, 2, $decimal_separator, $thousand_separator);
        } else {
            $formatted_value = number_format((float) $value, 2, $decimal_separator, $thousand_separator) . $symbol;
        }

        return $formatted_value;
    }
}

if (!function_exists('make_reference_id')) {
    function make_reference_id($prefix, $number)
    {
        $padded_text = $prefix . '-' . str_pad($number, 5, 0, STR_PAD_LEFT);

        return $padded_text;
    }
}

if (!function_exists('array_merge_numeric_values')) {
    function array_merge_numeric_values()
    {
        $arrays = func_get_args();
        $merged = array();
        foreach ($arrays as $array) {
            foreach ($array as $key => $value) {
                if (!is_numeric($value)) {
                    continue;
                }
                if (!isset($merged[$key])) {
                    $merged[$key] = $value;
                } else {
                    $merged[$key] += $value;
                }
            }
        }

        return $merged;
    }
}
