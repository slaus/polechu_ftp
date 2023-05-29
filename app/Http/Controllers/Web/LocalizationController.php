<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LocalizationController extends Controller
{
    public function __invoke(Request $request, string $locale): RedirectResponse
    {
        $referer = redirect()->back()->getTargetUrl();

        $parseUrl = parse_url($referer, PHP_URL_PATH);

        $uriParts = explode('/', $parseUrl);

        if (is_array($uriParts) && count($uriParts) >= 2 && in_array($uriParts[1], array_keys(config('localizations.supported_locales', [])))) {
            unset($uriParts[1]);
        }

        if ($locale != config('app.locale')) {
            array_splice($uriParts, 1, 0, $locale);
        }

        $url = $request->root() . implode('/', $uriParts);

        if (parse_url($referer, PHP_URL_QUERY)) {
            $url = $url . '?' . parse_url($referer, PHP_URL_QUERY);
        }

        return redirect(trim($url, '/'));
    }
}
