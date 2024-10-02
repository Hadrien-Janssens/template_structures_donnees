<?php

declare(strict_types=1);

namespace Opmvpc\StructuresDonnees\Lists;

use Error;
use Exception;
use Opmvpc\StructuresDonnees\Node;

class LinkedList implements ListInterface
{
    protected Node $head;
    protected int $size;

    public function __construct()
    {
        $this->head = new Node(null);
        $this->size = 0;
    }

    public function __toString(): string
    {
        return json_encode($this->toArray(), JSON_PRETTY_PRINT);
    }

    public function push(mixed $element): void
    {
        $newNode = new Node($element);

        if ($this->head->getNext() === null) {
            $this->head->setNext($newNode);
            $this->size++;
        } else {
            $node = $this->head->getNext();

            while ($node->getNext() !== null) {
                $node = $node->getNext();
            }
            $node->setNext($newNode);
            $this->size++;
        }
    }

    public function get(int $index): mixed
    {
        $i = 0;
        $node = $this->head->getNext();

        while ($index !== $i) {
            $node = $node->getNext();
            $i++;
        }
        return $node->getELement();
    }


    public function set(int $index, mixed $element): void
    {
        $i = 0;
        $node = $this->head->getNext();

        if ($index <= $this->size) {
            while ($index !== $i) {
                $node = $node->getNext();
                $i++;
            }
            $node->setElement($element);
        } else {
            throw new Exception();
        }
    }

    public function clear(): void
    {
        $this->head->setNext(null);
        $this->size = 0;
    }

    public function includes(mixed $element): bool {}

    public function isEmpty(): bool {}

    public function indexOf(mixed $element): int
    {
        $node = $this->head;
        $i = 0;

        while ($i <= $this->size) {
            $node = $node->getNext();
            if ($node->getElement() === $element) {
                return $i;
            }
            $i++;
        }
        throw new Exception();
    }

    public function remove(int $index): void
    {
        $i = 0;
        $node = $this->head->getNext();

        if ($index <= $this->size) {
            while ($index !== $i) {
                $node = $node->getNext();
                $i++;
            }
            $node->setNext(null);
            $this->size--;
        } else {
            throw new Exception();
        }
    }

    public function size(): int
    {
        return $this->size;
    }

    public function toArray(): array
    {
        $array = [];
        $node = $this->head->getNext();
        while ($node !== null) {
            $el =  $node->getElement();
            $array[] = $el;
            $node = $node->getNext();
        }
        return  $array;
    }
}
