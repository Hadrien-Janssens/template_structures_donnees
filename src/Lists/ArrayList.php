<?php

declare(strict_types=1);

namespace Opmvpc\StructuresDonnees\Lists;

class ArrayList implements ListInterface
{
    protected array $elements;

    public function __construct()
    {
        $this->elements = [];
    }

    public function __toString(): string
    {
        return json_encode($this->elements, JSON_PRETTY_PRINT);
    }

    public function push(mixed $element = null): void
    {
        if (!empty($this->elements)) {
            if (gettype($this->elements[0]) === gettype($element)) {
                $this->elements[] = $element;
            } else {
                throw new \InvalidArgumentException("Type mismatch", 1);
            }
        } else {
            $this->elements[] = $element;
        }
    }

    public function get(int $index): mixed
    {
        if (!isset($this->elements[$index])) {
            throw new \Exception("Index $index does not exist");
        }
        return $this->elements[$index];
    }

    public function set(int $index, mixed $element): void
    {
        if (!isset($this->elements[$index])) {
            throw new \Exception("Index $index does not exist");
        }
        $this->elements[$index] = $element;
    }

    public function clear(): void
    {
        $this->elements = [];
    }

    public function includes(mixed $element): bool
    {
        return in_array($element, $this->elements);
    }

    public function isEmpty(): bool
    {
        return empty($this->elements);
    }

    public function indexOf(mixed $element): int
    {
        if (array_search($element, $this->elements)) {
            return array_search($element, $this->elements);
        }
        throw new \Exception("Element doesn't exist", 1);
    }

    public function remove(int $index): void
    {
        if (!isset($this->elements[$index])) {
            throw new \Exception("Index $index does not exist");
        }
        unset($this->elements[$index]);
        //reindex array 
        $this->elements = array_values($this->elements);
    }

    public function size(): int
    {
        return count($this->elements);
    }

    public function toArray(): array
    {
        return $this->elements;
    }
}