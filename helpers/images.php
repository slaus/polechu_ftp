<?php

if (! function_exists('image_uri')) {

    function image_uri($path, $template = 'original', $absolute = true): string {
        return asset($path);
    }

}
