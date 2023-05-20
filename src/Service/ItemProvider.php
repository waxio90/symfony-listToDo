<?php

namespace App\Service;

class ItemProvider
{
    public function transformDataForTwig(array $items, int $listId): array
    {
        $transformData = [];
        $transformData['list'] = [
            'list_id' => $listId,
        ];
        foreach ($items as $item) {
            $transformData['items'][] = [
                'id' => $item->getId(),
                'name' => $item->getName(),
                'done' => $item->isDone(),
            ];
        }

        return $transformData;
    }
}