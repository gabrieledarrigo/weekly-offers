<?php
namespace Darrigo\WeeklyOffers\Utils;

/**
 * Class IsEmpty
 * @package Darrigo\WeeklyOffers\Utils
 * @author Gabriele D'Arrigo - darrigo.g@gmail.com
 */
trait IsEmpty
{
    /**
     * @param mixed $value
     * @return bool
     */
    public function isEmpty($value)
    {
        return empty($value);
    }
}