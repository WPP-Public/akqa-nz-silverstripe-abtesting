<?php

/**
 * Class ABTestingExtension
 */
class ABTestingExtension extends Extension
{
    /**
     * @var array
     */
    protected $allowed = array();
    /**
     * @param $allowed
     */
    public function __construct($allowed)
    {
        parent::__construct();
        if (!is_array($allowed)) {
            $allowed = func_get_args();
        }
        $this->allowed = $allowed;
    }
    /**
     * @param $vars
     * @return bool
     */
    public function getABTesting($vars)
    {
        list($flag, $val) = explode('_', $vars);

        if (isset($_GET[$flag]) && in_array($_GET[$flag], $this->allowed)) {
            $flag = $_GET[$flag];
        }

        return $val == $flag;
    }
}