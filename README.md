# db-repository
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
    $hydratingResultSet = new \Zend\Db\ResultSet\HydratingResultSet(
        new Hydrator(),
        new Model()
    );

    $tableGateway = new \Zend\Db\TableGateway\TableGateway(
        'table_name',
        new \Zend\Db\Adapter\Adapter($config),
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
