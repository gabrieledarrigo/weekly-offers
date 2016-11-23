<?php
namespace Darrigo\WeeklyOffers\Model;

/**
 * Class ViewModel
 * @package Darrigo\WeeklyOffers\Model
 * @author Gabriele D'Arrigo - darrigo.g@gmail.com
 */
abstract class ViewModel implements ToArray
{
    /**
     * @return array
     */
    public function __toArray()
    {
        return get_object_vars($this);
    }
}