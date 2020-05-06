<?php

namespace Storal;

use Laminas\Db\ResultSet\HydratingResultSet;
use Laminas\Db\ResultSet\ResultSetInterface;
use Laminas\Db\Sql\Select;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\Hydrator\HydratorInterface;
use Storal\Select\Count;
use Storal\Select\Exists;

abstract class Repository
{
    /** @var TableGateway */
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    protected function select(): Select
    {
        return new Select($this->tableGateway->getTable());
    }

    protected function count(): Select
    {
        return new Count($this->tableGateway->getTable());
    }

    /**
     * Return the id of the last row inserted in the current table.
     */
    protected function getLastIdInserted(): int
    {
        return $this->tableGateway->getAdapter()->getDriver()->getLastGeneratedValue(
            $this->tableGateway->getTable() . '_id_seq'
        );
    }

    protected function getHydrator(): HydratorInterface
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
     * @return null|object
     */
    protected function fetchOneEntity(Select $select)
    {
        /** @var HydratingResultSet $result */
        $result = $this->tableGateway->selectWith($select);

        return count($result) > 0 ? $result->current() : null;
    }

    protected function fetchListEntities(Select $select): ResultSetInterface
    {
        return $this->tableGateway->selectWith($select);
    }

    protected function fetchCount(Count $select): int
    {
        $statement = $this->tableGateway->getSql()->prepareStatementForSqlObject($select);
        $results = $statement->execute();

        return $results->current()[Count::COUNT_COLUMN];
    }

    protected function fetchExists(Exists $select): bool
    {
        $statement = $this->tableGateway->getSql()->prepareStatementForSqlObject($select);
        $result = $statement->execute();

        return \count($result) > 0;
    }
}
