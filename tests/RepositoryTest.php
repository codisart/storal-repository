<?php

namespace Storal;

use Storal\Enums\FilterType;
use Storal\ValueObjects\QueryFilter;
use Mockery as m;
use PHPUnit\Framework\TestCase;
use Laminas\Db\Sql\Where;
use Laminas\Db\TableGateway\TableGateway;
use Storal\Filter\EqualTo;
use Storal\Filter\GreaterThan;
use Storal\Filter\LessThan;
use Storal\Filter\GreaterThanOrEqualTo;
use Storal\Filter\LessThanOrEqualTo;
use Storal\Filter\Like;
use Storal\Filter\In;

class RepositoryTest extends TestCase
{
    use \Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

    /**
     * @var Repository
     */
    private $testedInstance;

    /**
     * @var m\MockInterface
     */
    private $tableGateway;

    protected function setUp(): void
    {
        $this->tableGateway = m::mock(TableGateway::class);

        $this->testedInstance = new class($this->tableGateway) extends Repository {};
    }

    public function testInstance()
    {
        self::assertInstanceOf(Repository::class, $this->testedInstance);
    }
}
