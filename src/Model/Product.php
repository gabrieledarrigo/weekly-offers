<?php
namespace Darrigo\WeeklyOffers\Model;

final class Product extends ViewModel
{
    protected $id;

    protected $title;

    protected $permalink;

    protected $externalLink;

    /**
     * Product constructor.
     * @param $id
     * @param $title
     * @param $permalink
     * @param $externalLink
     */
    public function __construct($id, $title, $permalink, $externalLink)
    {
        $this->id = (int)$id;
        $this->title = (string) $title;
        $this->permalink = (string) $permalink;
        $this->externalLink = (string) $externalLink;
     }

    /**
     * @return int
     */
    public function getId()
    {
        echo 'here';
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
    public function getPermalink()
    {
        return $this->permalink;
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
            'permalink' => $this->getPermalink(),
            'externalLink' => $this->getExternalLink()
        ];
    }
}