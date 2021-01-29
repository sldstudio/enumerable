<?php

namespace Solid\Foundation\Adapters;

use Carbon\Carbon;
use DateTimeInterface;

class DateAdapter
{
    /**
     * @param DateTimeInterface|int|Carbon $source
     * @return \Carbon\Carbon
     */
    public static function asCarbon($source): Carbon {
        if($source instanceof Carbon) {
            return $source;
        }

        if(is_int($source)) {
            return Carbon::createFromTimestamp($source);
        }

        return Carbon::parse($source);
    }
}