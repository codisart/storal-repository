<?php

namespace Storal\Select;

use Laminas\Db\Sql\Expression;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\TableIdentifier;

class Exists extends Select
{
    private const EXISTS_ALIAS = 'exists';

    private const EXISTS_EXPRESSION = "'exists'";

    /**
     * @param array|string|TableIdentifier|null $table
     */
    public function __construct($table = null)
    {
        parent::__construct($table);
        parent::columns([
            self::EXISTS_ALIAS => new Expression(self::EXISTS_EXPRESSION),
        ]);
        parent::limit(1);
    }

    public function columns(array $columns, $prefixColumnsWithTable = true)
    {
        throw new \BadMethodCallException('The columns should not be changed');
    }

    public function limit($limit)
    {
        throw new \BadMethodCallException('The columns should not be changed');
    }
}
