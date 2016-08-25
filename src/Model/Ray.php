<?php

namespace Murich\Logbag\Model;

class Ray
{
    /**
     * Logging ray id
     *
     * @var string
     */
    protected $_rayId;

    /**
     * Ray constructor.
     */
    public function __construct()
    {
        $this->_setRay();
    }

    /**
     * Use when you need new logging ray
     */
    public function reset()
    {
        $this->_setRay();
    }

    public function getRay()
    {
        return $this->_rayId;
    }

    protected function _setRay()
    {
        // using __FILE__ as prefix helps to divide rays generated in different apps at same moment of time
        $this->_rayId = md5(uniqid(__FILE__, true));
    }
}