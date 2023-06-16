<?php

namespace App\Services\Intervention\Filters\Favicon;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

class Favicon16X16 implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(16, 16);
    }
}
