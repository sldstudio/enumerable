<?php

namespace Solid\Foundation\Collections;

use Illuminate\Support\Collection;
use Solid\Foundation\Exceptions\UnexpectedValueException;

/**
 * @template V
 * @template K
 * @template-extends Collection<V, K>
 * @psalm-template V
 * @psalm-template K
 */
abstract class GenericCollection extends Collection
{
    /**
     * @param V[] $items
     * @psalm-param V[] $items
     */
    public function __construct($items = [])
    {
        /**
         * @var V[] $items
         * @psalm-var V[] $items
         */
        $items = $this->getArrayableItems($items);

        foreach ($items as $item) {
            if (!$this->isValidValue($item)) {
                throw new UnexpectedValueException;
            }
        }

        parent::__construct($items);
    }

    /**
     * @param V[] $values
     * @psalm-param V[] $values
     * @return $this
     */
    final public function push(...$values): self
    {
        foreach ($values as $value) {
            if (!$this->isValidValue($value)) {
                throw new UnexpectedValueException;
            }

            $this->items[] = $value;
        }

        return $this;
    }

    /**
     * @param K $key
     * @param V $value
     *
     * @psalm-param K $key
     * @psalm-param V $value
     *
     * @return $this
     */
    final public function put($key, $value): self
    {
        if (!$this->isValidValue($value)) {
            throw new UnexpectedValueException;
        }

        return parent::put($key, $value);
    }

    /**
     * @param V $item
     * @psalm-param V $item
     *
     * @return $this
     */
    final public function add($item): self
    {
        if (!$this->isValidValue($item)) {
            throw new UnexpectedValueException;
        }

        return parent::add($item);
    }

    /**
     * @param K $key
     * @param V $value
     *
     * @psalm-param K $key
     * @psalm-param V $value
     *
     * @return void
     */
    final public function offsetSet($key, $value)
    {
        if (!$this->isValidValue($value)) {
            throw new UnexpectedValueException;
        }

        parent::offsetSet($key, $value);
    }

    /**
     * @param callable $callback
     * @return Collection
     */
    final public function map(callable $callback): Collection
    {
        return collect($this->items)->map($callback);
    }

    /**
     * @param $value
     *
     * @return bool
     */
    abstract protected function isValidValue($value): bool;
}