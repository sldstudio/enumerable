<?php

namespace Tests\Collection\Concretes;

use Solid\Foundation\Collections\GenericCollection;

/**
 * @internal
 * @implements GenericCollection<TestEntity, string|int>
 */
final class TestEntityCollection extends GenericCollection
{
    protected function isValidValue($value): bool
    {
        return $value instanceof TestEntity;
    }

}