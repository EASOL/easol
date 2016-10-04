<?php

namespace PhpParser\Node\Stmt;

use PhpParser\Node;

class Break_ extends Node\Stmt
{
    /** @var null|Node\Expr Number of loops to break */
    public $num;

    /**
     * Constructs a break node.
     *
     * @param null|Node\Expr $num        Number of loops to break
     * @param array          $attributes Additional attributes
     */
    public function __construct(Node\Expr $num = NULL, array $attributes = array()) 
    {
        parent::__construct(NULL, $attributes);
        $this->num = $num;
    }

    public function getSubNodeNames() 
    {
        return array('num');
    }
}
