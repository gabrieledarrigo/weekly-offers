<?php
namespace Darrigo\WeeklyOffers\Model;

/**
 * Interface ToArray
 * @package Darrigo\WeeklyOffers\Model
 * @author Gabriele D'Arrigo - darrigo.g@gmail.com
 */
interface ToArray
{
    /**
     * @return array
     */
    public function __toArray();
}