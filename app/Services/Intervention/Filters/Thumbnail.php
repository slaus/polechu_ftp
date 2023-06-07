<?php

namespace App\Services\Intervention\Filters;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

class Thumbnail implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(65, 65);
    }
}
