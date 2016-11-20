<?php
namespace Darrigo\WeeklyOffers\Model;

/**
 * Class ViewModel
 * @package Darrigo\WeeklyOffers\Model
 */
class ViewModel implements ToArray
{
    /**
     * @return array
     */
    public function __toArray()
    {
        return get_object_vars($this);
    }
}