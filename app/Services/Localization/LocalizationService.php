<?php

namespace App\Services\Localization;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocalizationService
{
    public function __construct(
        private readonly Request $request
    ) {}

    public function setLocale(): string
    {
        $locale = $this->request->segment(1, '');

        $currentLocalization = config('app.locale');

        if ($this->isSupportedLocalization($locale)) {
            $currentLocalization = $locale;
        } else {
            $locale = '';
        }

        App::setLocale($currentLocalization);

        return $locale;
    }

    public function setLocaleFromQuery(): void
    {
        $locale = $this->request->input('locale', config('app.fallback_locale'));

        if ($this->isSupportedLocalization($locale)) {
            App::setLocale($locale);
        }
    }

    private function supportedLocalizations(): array
    {
        return array_keys(config('localizations.supported_locales', []));
    }

    private function isSupportedLocalization(string $locale): bool
    {
        return in_array($locale, $this->supportedLocalizations());
    }
}
