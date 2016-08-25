<?php

namespace Murich\Logbag\Model\Bag;

use Murich\Logbag\Model\Ray;

abstract class Base {

    /**
     * Log ray id
     *
     * @var Ray
     */
    protected $ray;

    public function __construct(Ray $ray)
    {
        $this->ray = $ray;
    }

    /**
     * Returns array of values which should be logged
     *
     * @return array
     */
    abstract protected function _getValues();

    /**
     * Returns logger message
     *
     * @return string
     */
    public function getMessage()
    {
        $values = $this->_getValues();
        $values['logbag'] = static::class;

        return json_encode($values);
    }

    /**
     * Returns logger severity
     *
     * @return int
     */
    abstract public function getSeverity();
}