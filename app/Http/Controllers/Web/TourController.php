<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\ViewModels\TourViewModel;
use App\Models\Tour;
use Illuminate\View\View;

class TourController extends Controller
{
    public function __invoke(string $slug): View
    {
        $tour = Tour::where('slug', $slug)->where('visibility', true)->firstOrFail();

        $data = new TourViewModel($tour);

        return view('web.tours.single', $data);
    }
}
