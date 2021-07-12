<?php

namespace App\Utils;

class TransformInAssocArray
{
    public function changeKeyByNameValue($results)
    {
        $newResults = [];

        foreach ($results as $result) {
            $newResults[$result->getName()] = $result->getName();
        }

        return $newResults;
    }
}