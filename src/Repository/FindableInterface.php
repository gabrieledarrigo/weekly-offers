<?php
namespace Darrigo\WeeklyOffers\Repository;

/**
 * Interface FindableInterface
 * @package Darrigo\WeeklyOffers\Repository
 */
interface FindableInterface
{
    public function findById($id);
}