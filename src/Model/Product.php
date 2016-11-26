<?php
namespace Darrigo\WeeklyOffers\Model;

use Darrigo\WpPluginUtils\Model\ViewModel;

/**
 * Class Product
 * @package Darrigo\WeeklyOffers\Model
 * @author Gabriele D'Arrigo - darrigo.g@gmail.com
 */
final class Product extends ViewModel
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $externalLink;

    /**
     * Product constructor.
     * @param $id
     * @param $title
     * @param $externalLink
     */
    public function __construct($id, $title, $externalLink)
    {
        $this->id = (int)$id;
        $this->title = (string) $title;
        $this->externalLink = (string) $externalLink;
     }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getExternalLink()
    {
        return $this->externalLink;
    }

    /**
     * @return array
     */
    public function __toArray()
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'externalLink' => $this->getExternalLink()
        ];
    }
}