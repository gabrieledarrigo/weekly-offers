<?php
namespace Darrigo\WeeklyOffers\Model;

/**
 * Class EmptyResult
 * @package Darrigo\WeeklyOffers\Model
 */
final class EmptyResult extends ViewModel
{
    const IS_EMPTY = true;

    /**
     * @return array
     */
    public function __toArray()
    {
        return [];
    }
}