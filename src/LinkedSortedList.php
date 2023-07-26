<?php

declare(strict_types=1);

namespace Huholoman\SortedLinkedList;

use Iterator;

/**
 * @template T of int|string
 */
final class LinkedSortedList
{
    /**
     * @param ?Node<T> $firstNode
     */
    private function __construct(
        private ?Node $firstNode,
        private int $itemsCount,
    ) {}

    /**
     * @param list<T> $values
     * @return static
     */
    public static function CreateFromArray(array $values): self {
        rsort($values);

        /** @var ?Node<T> $firstNode */
        $firstNode = null;
        foreach ($values as $value) {
            $firstNode = new Node($value, $firstNode);
        }

        return new self($firstNode, count($values));
    }

    /**
     * @param T $value
     * @return void
     */
    public function add(mixed $value): void {
        $this->itemsCount++;

        if ($this->firstNode === null) {
            $this->firstNode = new Node($value);
            return;
        }

        if ($this->firstNode->getValue() > $value) {
            $this->firstNode = new Node($value, $this->firstNode);
            return;
        }

        $previousNode = $this->firstNode;
        while (true) {
            // previous node cant be null
            \assert($previousNode !== null);

            $currentNode = $previousNode->getNextNode();
            if ($currentNode === null) {
                $previousNode->setNextNode(new Node($value));
                return;
            }

            \assert($currentNode !== null);
            if ($currentNode->getValue() > $value) {
                $previousNode->setNextNode(new Node($value, $currentNode));
                return;
            }

            $previousNode = $previousNode->getNextNode();
        }
    }

    /**
     * @param T $value
     * @return void
     */
    public function remove(mixed $value): void {
        if ($this->firstNode === null) {
            return;
        }

        if ($this->firstNode->getValue() === $value) {
            $this->firstNode = $this->firstNode->getNextNode();
            $this->itemsCount--;
            return;
        }

        $previousNode = $this->firstNode;
        while (true) {
            \assert($previousNode != null);

            $currentNode = $previousNode->getNextNode();
            if ($currentNode === null) {
                return;
            }

            \assert($currentNode != null);
            if ($currentNode->getValue() === $value) {
                $previousNode->setNextNode($currentNode->getNextNode());
                $this->itemsCount--;
                return;
            }

            $previousNode = $previousNode->getNextNode();
        }
    }

    public function getIterator(): Iterator {
        return new LinkedSortedListIterator($this->firstNode);
    }

    /**
     * @param int $index
     * @return Node<T>|null
     */
    public function get(int $index): ?Node {
        $currentNode = $this->firstNode;
        $currentIndex = 0;

        while ($currentNode !== null) {
            if ($index === $currentIndex) {
                return $currentNode;
            }
            $currentIndex++;
            $currentNode = $currentNode->getNextNode();
        }

        return null;
    }

    public function count(): int {
        return $this->itemsCount;
    }
}
