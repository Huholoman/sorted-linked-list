<?php

declare(strict_types=1);

namespace Huholoman\SortedLinkedList;

/**
 * @template T of int|string
 */
final class Node
{
    /**
     * @param T $value
     * @param Node<T>|null $nextNode
     */
    public function __construct(
        private mixed $value,
        private ?Node $nextNode = null,
    ) {}

    /**
     * @return Node<T>|null
     */
    function getNextNode(): Node|null {
        return $this->nextNode;
    }

    /**
     * @param Node<T>|null $nextNode
     * @return void
     */
    function setNextNode(?Node $nextNode): void {
        $this->nextNode = $nextNode;
    }

    /**
     * @param T $value
     *
     * @return void
     */
    function setValue(mixed $value): void {
        $this->value = $value;
    }

    /**
     * @return T
     */
    function getValue(): mixed {
        return $this->value;
    }
}
