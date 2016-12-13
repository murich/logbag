<?php

namespace Murich\Logbag\Model\Bag;

use Murich\Logbag\Model\Ray;
use Murich\Logbag\Arr;

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
        $values['ray'] = $this->ray->getRay();

        return json_encode($values);
    }

    public static function prepareObject($object)
    {
        if (is_object($object) && !($object instanceof \JsonSerializable)) {
            $prepared = Arr::dismount($object);
            $prepared['class'] = get_class($object);
        } else {
            $prepared = $object;
        }

        return $prepared;
    }

    public function getRay()
    {
        return $this->ray;
    }

    /**
     * Returns logger severity
     *
     * @return int
     */
    abstract public function getSeverity();
}