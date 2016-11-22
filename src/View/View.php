<?php

namespace Darrigo\WeeklyOffers\View;

/**
 * Class View
 * @package Darrigo\WeeklyOffers\View
 */
class View implements Renderer
{
    /**
     * @var string
     */
    protected $templatePath;

    /**
     * @var array
     */
    protected $viewArgs = [];

    /**
     * ViewRenderer constructor.
     * @param $templatePath
     * @param array $viewArgs
     */
    public function __construct($templatePath, array $viewArgs)
    {
        if (file_exists($templatePath) === false) {
            throw new \InvalidArgumentException(self::class . ' cannot found template ' . $templatePath);
        }

        $this->templatePath = $templatePath;
        $this->viewArgs = $viewArgs;
    }

    /**
     * @return string
     */
    public function getTemplatePath()
    {
        return $this->templatePath;
    }

    /**
     * @return array
     */
    public function getViewArgs()
    {
        return $this->viewArgs;
    }

    /**
     * @return void
     */
    public function render()
    {
        if (!empty($this->viewArgs)) {
            extract($this->viewArgs);
        }

        ob_start();
        include($this->templatePath);
        $out = ob_get_contents();
        ob_end_clean();
        echo $out;
    }
}
