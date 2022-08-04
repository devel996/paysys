<?php

namespace App\Models\Operation;

use App\Services\OperationTransformer;

class OperationContainer
{
    private static array $operations = [];

    public static function addOperation(Operation $operation): void
    {
        self::$operations[] = (new OperationTransformer($operation))->getData();
    }

    public static function getOperationsList(): array
    {
        return self::$operations;
    }

    public static function getCommentSortedOperationsList(): array
    {
        $operationsList = self::getOperationsList();
        $comments = array_column($operationsList, 'comment');
        array_multisort($comments, SORT_ASC, $operationsList);

        return $operationsList;
    }

    public static function getDateTimeSortedOperationsList(): array
    {
        $operationsList = self::getOperationsList();
        $comments = array_column($operationsList, 'dateTime');
        array_multisort($comments, SORT_DESC, $operationsList);

        return $operationsList;
    }
}