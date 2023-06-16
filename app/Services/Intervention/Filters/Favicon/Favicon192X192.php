<?php

namespace App\Services\Intervention\Filters\Favicon;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

class Favicon192X192 implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(196, 196);
    }
}
