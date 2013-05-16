<?php

/**
 * Class ABTestingExtension
 */
class ABTestingExtension extends Extension
{

    /**
     * Required for DataObject extensions
     *
     * @return array
     */
    public function extraStatics()
    {
        return array();
    }

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
     * @throws RuntimeException
     * @return bool
     */
    public function getABTesting()
    {
        $args = func_get_args();
        $num = count($args);
        if ($num === 0) {
           throw new RuntimeException('Need at least one argument to ABTestingExtension::getABTesting');
        } elseif ($num === 1) {
            $args = explode('_', $args[0]);
        }
        list($flag, $val) = $args;

        if (isset($_GET[$flag]) && in_array($_GET[$flag], $this->allowed)) {
            $flag = $_GET[$flag];
        }

        return $val == $flag;
    }
}