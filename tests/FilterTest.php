<?php

namespace Storal;

use Mockery as m;
use PHPUnit\Framework\TestCase;
use Storal\Filter\EqualTo;
use Storal\Filter\GreaterThan;
use Storal\Filter\GreaterThanOrEqualTo;
use Storal\Filter\In;
use Storal\Filter\LessThan;
use Storal\Filter\LessThanOrEqualTo;
use Storal\Filter\Like;

class FilterTest extends TestCase
{
    public function applyQueryFiltersProvider()
    {
        return [
            [
                [],
                [],
            ],
            [
                [new EqualTo('key', 'value')],
                ['equal-to' => 1],
            ],
            [
                [new GreaterThan('key', 'value')],
                ['greater-than' => 1],
            ],
            [
                [new GreaterThanOrEqualTo('key', 'value')],
                ['greater-than-or-equal-to' => 1],
            ],
            [
                [new LessThan('key', 'value')],
                ['less-than' => 1],
            ],
            [
                [new LessThanOrEqualTo('key', 'value')],
                ['less-than-or-equal-to' => 1],
            ],
            [
                [new Like('key', 'value')],
                ['like' => 1],
            ],
            [
                [new EqualTo('key', 'value'), new GreaterThan('key', 'value')],
                ['equal-to' => 1, 'greater-than' => 1],
            ],
            [
                [new LessThan('key', 'value'), new Like('key', 'value')],
                ['less-than' => 1, 'like' => 1],
            ],
            [
                [new In('key', ['value'])],
                ['in' => 1],
            ],
        ];
    }

    /**
     * @dataProvider applyQueryFiltersProvider
     */
    public function testFilters(array $filters, array $totalCalls)
    {
        $where = m::mock(Where::class);
        $where
            ->shouldReceive('equalTo')
            ->with('key', 'value')
            ->times($totalCalls['equal-to'] ?? 0);
        $where
            ->shouldReceive('greaterThan')
            ->with('key', 'value')
            ->times($totalCalls['greater-than'] ?? 0);
        $where
            ->shouldReceive('greaterThanOrEqualTo')
            ->with('key', 'value')
            ->times($totalCalls['greater-than-or-equal-to'] ?? 0);
        $where
            ->shouldReceive('lessThan')
            ->with('key', 'value')
            ->times($totalCalls['less-than'] ?? 0);
        $where
            ->shouldReceive('lessThanOrEqualTo')
            ->with('key', 'value')
            ->times($totalCalls['less-than-or-equal-to'] ?? 0);
        $where
            ->shouldReceive('like')
            ->with('key', '%value%')
            ->times($totalCalls['like'] ?? 0);
        $where
            ->shouldReceive('in')
            ->with('key', ['value'])
            ->times($totalCalls['in'] ?? 0);

        foreach ($filters as $filter) {
            $filter->apply($where);
        }

        self::assertInstanceOf(Where::class, $where);
    }
}
