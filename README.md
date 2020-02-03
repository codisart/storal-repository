# storal-repository

[![Build Status](https://travis-ci.org/codisart/storal-repository.svg?branch=master)](https://travis-ci.org/codisart/storal-repository)
[![Maintainability](https://api.codeclimate.com/v1/badges/dfd76cbcf9a90b0f4e25/maintainability)](https://codeclimate.com/github/codisart/storal-repository/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/dfd76cbcf9a90b0f4e25/test_coverage)](https://codeclimate.com/github/codisart/storal-repository/test_coverage)

A proposal on how to use laminas/laminas-db

# Usage

## Definition of a \Storal\Repository

```php
<?php
    class TableRepository extends \Storal\Repository {

        public function findAllByName(string $name)
        {
            $select = $this->select();
            $select->where
                ->equalTo([
                    'name'       => $name,
                ]);

            $select->order(['created_at' => 'DESC']);

            return $this->fetchListEntities($select);
        }
    }
```

## Instanciation

```php
<?php
    $hydratingResultSet = new \Laminas\Db\ResultSet\HydratingResultSet(
        new Hydrator(),
        new Model()
    );

    $tableGateway = new \Laminas\Db\TableGateway\TableGateway(
        'table_name',
        new \Laminas\Db\Adapter\Adapter($config),
        null,
        $hydratingResultSet
    );

    $tableRepository = new TableRepository($tableGateway);
    $entities = $tableRepository->findAllByName('Bob');    
```

# Tests

```php
./vendor/bin/phpunit tests
```
