<?php
namespace Darrigo\WeeklyOffers\Model;

/**
 * Interface ToArray
 * @package Darrigo\WeeklyOffers\Model
 */
interface ToArray
{
    /**
     * @return array
     */
    public function __toArray();
}