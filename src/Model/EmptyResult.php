<?php
namespace Darrigo\WeeklyOffers\Model;

/**
 * Class EmptyResult
 * @package Darrigo\WeeklyOffers\Model
 * @author Gabriele D'Arrigo - darrigo.g@gmail.com
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