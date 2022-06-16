<?php
namespace Rist\Console\Util;

trait UtilImporter
{
    /**
     * An instance of the UtilFactory
     *
     * @var \Rist\Console\Util\UtilFactory $util
     */
    protected $util;

    /**
     * Sets the $util property
     *
     * @param UtilFactory $util
     */
    public function util(UtilFactory $util)
    {
        $this->util = $util;
    }
}
