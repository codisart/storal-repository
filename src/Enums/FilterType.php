<?php

namespace Storal\Enums;

class FilterType
{
    public const EQUAL_TO = 'eq';
    public const GREATER_THAN = 'gt';
    public const GREATER_THAN_OR_EQUAL_TO = 'gte';
    public const LESS_THAN = 'lt';
    public const LESS_THAN_OR_EQUAL_TO = 'lte';
    public const LIKE = 'like';
    public const IN = 'in';

    public static function getAll(): array
    {
        return [
            self::EQUAL_TO,
            self::GREATER_THAN,
            self::GREATER_THAN_OR_EQUAL_TO,
            self::LESS_THAN,
            self::LESS_THAN_OR_EQUAL_TO,
            self::LIKE,
            self::IN,
        ];
    }
}
