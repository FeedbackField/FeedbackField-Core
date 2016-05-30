<?php

namespace FeedbackFieldTypeBrowserUserAgentBundle;


use phpbrowscap\Browscap;

class BrowsCapService
{

    protected $browsCap;

    /**
     * BrowsCapService constructor.
     */
    public function __construct()
    {
        $this->browsCap = new Browscap(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'cache');
    }

    /**
     * @return Browscap
     */
    public function getBrowsCap()
    {
        return $this->browsCap;
    }

}
