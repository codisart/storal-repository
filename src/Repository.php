<?php

namespace Storal;

use Laminas\Db\ResultSet\HydratingResultSet;
use Laminas\Db\ResultSet\ResultSetInterface;
use Laminas\Db\Sql\Literal;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Where;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\Hydrator\HydratorInterface;
use Storal\Enums\FilterType;
use Storal\Select\Count;
use Storal\Select\Exists;

abstract class Repository
{
    /** @var TableGateway */
    protected $tableGateway;

    /**
     * @param TableGateway $tableGateway
     */
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    /**
     * @return \Laminas\Db\Sql\Select
     */
    protected function select() : Select
    {
        return new Select($this->tableGateway->getTable());
    }

    /**
     * @return \Laminas\Db\Sql\Select
     */
    protected function count() : Select
    {
        return new Count($this->tableGateway->getTable());
    }

    /**
     * Return the id of the last row inserted in the current table
     * @return int
     */
    protected function getLastIdInserted()
    {
        return $this->tableGateway->getAdapter()->getDriver()->getLastGeneratedValue(
            $this->tableGateway->getTable() . '_id_seq'
        );
    }

    /**
     * @return \Laminas\Hydrator\HydratorInterface
     */
    protected function getHydrator() : HydratorInterface
    {
        return $this->tableGateway->getResultSetPrototype()->getHydrator();
    }

    protected function beginTransaction()
    {
        return $this->tableGateway->getAdapter()->getDriver()->getConnection()->beginTransaction();
    }

    protected function rollback()
    {
        return $this->tableGateway->getAdapter()->getDriver()->getConnection()->rollback();
    }

    protected function commit()
    {
        return $this->tableGateway->getAdapter()->getDriver()->getConnection()->commit();
    }

    /**
     * @param \Laminas\Db\Sql\Select $select
     * @return null|object
     */
    protected function fetchOneEntity(Select $select)
    {
        /** @var HydratingResultSet $result */
        $result = $this->tableGateway->selectWith($select);
        return count($result) > 0 ? $result->current() : null;
    }

    /**
     * @param \Laminas\Db\Sql\Select $select
     * @return \Laminas\Db\ResultSet\ResultSetInterface
     */
    protected function fetchListEntities(Select $select) : ResultSetInterface
    {
        return $this->tableGateway->selectWith($select);
    }

    protected function fetchCount(Count $select) : int
    {
        $statement = $this->tableGateway->getSql()->prepareStatementForSqlObject($select);
        $results   = $statement->execute();

        return $results->current()[Count::COUNT_COLUMN];
    }

    protected function fetchExists(Exists $select) : bool
    {
        $statement  = $this->tableGateway->getSql()->prepareStatementForSqlObject($select);
        $result = $statement->execute();

        return \count($result) > 0;
    }

    /**
     * @param \Laminas\Db\Sql\Where $where
     * @param array $filters
     * @return \Laminas\Db\Sql\Where
     */
    public function applyQueryFilters(Where $where, array $filters)
    {
        /** @var \Storal\ValueObjects\QueryFilter $filter */
        foreach ($filters as $filter) {
            switch ($filter->getType()) {
                case FilterType::EQUAL_TO:
                    $where->equalTo($filter->getField(), $filter->getValue());
                    break;
                case FilterType::GREATER_THAN:
                    $where->greaterThan($filter->getField(), $filter->getValue());
                    break;
                case FilterType::GREATER_THAN_OR_EQUAL_TO:
                    $where->greaterThanOrEqualTo($filter->getField(), $filter->getValue());
                    break;
                case FilterType::LESS_THAN:
                    $where->lessThan($filter->getField(), $filter->getValue());
                    break;
                case FilterType::LESS_THAN_OR_EQUAL_TO:
                    $where->lessThanOrEqualTo($filter->getField(), $filter->getValue());
                    break;
                case FilterType::LIKE:
                    $where->like($filter->getField(), '%' . $filter->getValue() . '%');
                    break;
                case FilterType::IN:
                    $where->in($filter->getField(), $filter->getValue());
                    break;
                default:
                    break;
            }
        }

        return $where;
    }
}
