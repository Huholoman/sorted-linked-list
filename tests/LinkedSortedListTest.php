<?php

declare(strict_types=1);

use Huholoman\SortedLinkedList\LinkedSortedList;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class LinkedSortedListTest extends TestCase
{
    /**
     * @param list<int|string> $givenValues
     * @param list<int|string> $expectedValues
     *
     * @dataProvider itCanCreateListFromValuesProvider
     */
    public function testItCanCreateListFromArray(array $givenValues, int $expectedCount, array $expectedValues): void {
        // when
        $list = LinkedSortedList::CreateFromArray($givenValues);

        // then
        Assert::assertSame($expectedCount, $list->count());

        foreach ($expectedValues as $index => $expectedValue) {
            $firstNode =  $list->get($index);
            Assert::assertNotNull($firstNode);
            Assert::assertSame($expectedValue, $firstNode->getValue());
        }
    }

    /**
     * @return array<string, array<int, int|string|list<int|string>>>
     */
    public static function itCanCreateListFromValuesProvider(): array
    {
        return [
            "it can create list from integers" => [
                [3, 2, 1],
                3,
                [1, 2, 3],
            ],
            "it can create list from strings" => [
                ["ijkl", "efgh", "abcd"],
                3,
                ["abcd", "efgh", "ijkl"],
            ],
        ];
    }

    /**
     * @param list<int|string> $givenValues
     *
     * @dataProvider itCanAddValueProvider
     */
    public function testItCanAddValue(array $givenValues, int|string $valueToAdd, int $expectedIndex): void {
        // given
        $list = LinkedSortedList::CreateFromArray($givenValues);

        // when
        $list->add($valueToAdd);

        // then
        $node = $list->get($expectedIndex);
        Assert::assertNotNull($node);
        Assert::assertSame($valueToAdd, $node->getValue());
    }

    /**
     * @return array<string, array<int, int|string|list<int|string>>>
     */
    public static function itCanAddValueProvider(): array {
        return [
            "it can append int value" => [
                [1, 2, 3],
                4,
                3,
            ],
            "it can append string value" => [
                ["a", "b", "c"],
                "d",
                3,
            ],
            "it can prepend int value" => [
                [1, 2, 3],
                0,
                0,
            ],
            "it can prepend string value" => [
                ["a", "b", "c"],
                "A",
                0,
            ],
            "it can add int value in the middle" => [
                [1, 3],
                2,
                1,
            ],
            "it can add string value in the middle" => [
                ["a", "c"],
                "b",
                1,
            ],
            "it can add duplicit int value" => [
                [1],
                1,
                1,
            ],
            "it can add duplicit string value" => [
                ["a"],
                "a",
                1,
            ],
        ];
    }

    /**
     * @param list<int|string> $givenValues
     * @param list<int|string> $expectedValues
     *
     * @dataProvider itCanRemoveValueProvider
     */
    public function testItCanRemoveValue(
        array $givenValues,
        int|string $valueToAdd,
        int $expectedCount,
        array $expectedValues,
    ): void {
        // given
        $list = LinkedSortedList::CreateFromArray($givenValues);

        // when
        $list->remove($valueToAdd);

        // then
        Assert::assertSame($expectedCount, $list->count());
        foreach ($expectedValues as $index => $expectedValue) {
            $firstNode =  $list->get($index);
            Assert::assertNotNull($firstNode);
            Assert::assertSame($expectedValue, $firstNode->getValue());
        }
    }

    /**
     * @return array<string, array<int, int|string|list<int|string>>>
     */
    public static function itCanRemoveValueProvider(): array {
        return [
            "it can remove last int value" => [
                [1, 2, 3],
                3,
                2,
                [1, 2],
            ],
            "it can remove string value" => [
                ["a", "b", "c"],
                "c",
                2,
                ["a", "b"],
            ],
            "it can remove first int value" => [
                [1, 2, 3],
                1,
                2,
                [2, 3]
            ],
            "it can remove first string value" => [
                ["a", "b", "c"],
                "a",
                2,
                ["b", "c"]
            ],
            "it can remove int value from the middle" => [
                [1, 2, 3],
                2,
                2,
                [1, 3],
            ],
            "it can remove string value in the middle" => [
                ["a", "b", "c"],
                "b",
                2,
                ["a", "c"],
            ],
            "it can remove first duplicist string value" => [
                ["a", "a", "c"],
                "a",
                2,
                ["a", "c"],
            ],
        ];
    }
}
