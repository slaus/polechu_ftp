<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\ViewModels\TourViewModel;
use App\Models\Page;
use App\Models\Tour;
use Illuminate\View\View;

class TourController extends Controller
{
    public function __invoke(string $slug): View
    {
        $page = Page::where('slug', 'home')->where('visibility', true)->first();
        $tour = Tour::where('slug', $slug)->where('visibility', true)->firstOrFail();

        $data = new TourViewModel($tour, $page);

        return view('web.tours.single', $data);
    }
}
