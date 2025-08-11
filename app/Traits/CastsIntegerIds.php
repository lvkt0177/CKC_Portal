<?php

namespace App\Traits;

trait CastsIntegerIds
{
    public function toArray()
    {
        $array = parent::toArray();

        foreach ($array as $key => $value) {
            if (preg_match('/^id(_|$)/', $key) && is_string($value) && is_numeric($value)) {
                $array[$key] = (int) $value;
            }
        }

        return $array;
    }
}
