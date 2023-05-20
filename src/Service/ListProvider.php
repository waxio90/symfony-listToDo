<?php

namespace App\Service;

class ListProvider
{
    public function transformDataForTwig(array $lists): array
    {
        $transformData = [];
        foreach ($lists as $list) {
            $transformData['lists'][] = [
                'link' => 'lists/' . $list->getId(),
                'name' => $list->getName(),
            ];
        }

        return $transformData;
    }
}