<?php

namespace App\Enums;

use Exception;

enum OrderTypeEnum: int
{
    case TOUR_FORM = 1;

    case CONTACT_FORM = 2;

    case SUBSCRIBE_FORM = 3;

    /**
     * @throws Exception
     */
    public function name(): string
    {
        return match ($this) {
            self::TOUR_FORM => __('Tour form'),
            self::CONTACT_FORM => __('Contact form'),
            self::SUBSCRIBE_FORM => __('Subscribe form'),
            default => throw new Exception('Unexpected match order type value'),
        };
    }
}
