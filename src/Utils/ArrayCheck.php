<?php

namespace Darrigo\WeeklyOffers\Utils;

/**
 * Class ArrayCheck
 * @package Darrigo\WeeklyOffers\Utils
 * @author Gabriele D'Arrigo - darrigo.g@gmail.com
 */
trait ArrayCheck
{
    /**
     * @param array $array
     * @param string $key
     * @return bool
     */
    public function isValueSet(array $array, $key)
    {
        return isset($array[$key]);
    }
}