<?php

if (! function_exists('translation')) {

    function translation(array $data, string $locale = '', string $default = ''): string {
        $locale = ! empty($locale) ? $locale : app()->getLocale();

        return $data[$locale] ?? array_shift($data) ?? $default;
    }

}
