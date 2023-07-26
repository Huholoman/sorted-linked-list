<?php

declare(strict_types=1);

namespace Huholoman\SortedLinkedList;

use Iterator;

/**
 * @template T of int|string
 * @implements Iterator<int, T>
 */
final class LinkedSortedListIterator implements Iterator
{
    /**
     * @var ?Node<T>
     */
    private ?Node $firstNode;

    /**
     * @var ?Node<T>
     */
    private ?Node $currentNode;

    private int $index = 0;

    /**
     * @param ?Node<T> $firstNode
     */
    public function __construct(?Node $firstNode) {
        $this->firstNode = $firstNode;
        $this->currentNode = $firstNode;
    }

    /**
     * @return T
     */
    public function current(): mixed
    {
        \assert($this->currentNode != null);

        return $this->currentNode->getValue();
    }

    public function next(): void
    {
        \assert($this->currentNode != null);

        $this->currentNode = $this->currentNode->getNextNode();
        $this->index++;
    }

    public function key(): int
    {
        return $this->index;
    }

    public function valid(): bool
    {
        return $this->currentNode !== null;
    }

    public function rewind(): void
    {
        $this->currentNode = $this->firstNode;
    }
}
