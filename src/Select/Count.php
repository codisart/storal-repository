<?php

namespace Storal\Select;

use Zend\Db\Sql\Literal;
use Zend\Db\Sql\Select;

class Count extends Select
{
    public const COUNT_COLUMN = 'count';

    /**
     * @param  null|string|array|TableIdentifier $table
     */
    public function __construct($table = null)
    {
        parent::__construct($table);
        parent::columns([
            self::COUNT_COLUMN => new Literal('COUNT(1)')
        ]);
    }

    public function columns(array $columns, $prefixColumnsWithTable = true)
    {
        throw new \BadMethodCallException('The columns should not be changed');
    }
}