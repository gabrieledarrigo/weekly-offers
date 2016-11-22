<?php
namespace Darrigo\WeeklyOffers\Repository;

/**
 * Interface FindableInterface
 * @package Darrigo\WeeklyOffers\Repository
 * @author Gabriele D'Arrigo - darrigo.g@gmail.com
 */
interface FindableInterface
{
    public function findById($id);
}