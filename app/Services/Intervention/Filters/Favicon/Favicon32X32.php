<?php

namespace App\Services\Intervention\Filters\Favicon;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

class Favicon32X32 implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(32, 32);
    }
}
