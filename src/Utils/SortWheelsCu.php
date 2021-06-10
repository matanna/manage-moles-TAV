<?php

namespace App\Utils;

/**
 * This class sort WheelsCuType objects retrieved by a request on the the database
 */
class SortWheelsCu
{
    /**
     * Wheels are sort by there type and typical name (thikness of glass or diameter or width according to type of each wheels)
     * We create an array taking for index the type of wheelsand typical
     */
    public function sortWheelsCuByType($wheelsTypes) 
    {
        foreach ($wheelsTypes as $wheels) {
            $type = $wheels->getWheelsType();
            $typical = $wheels->getTypical();

            $tableResults[$type][$typical][] = $wheels;
        }
        
        return $tableResults;
    }

    /**
     * Wheels are sort by there Cu and there type
     * We create an array taking for index the Cu name and the type of mole
     */
    public function tryTypeMoleByCu($allCus)
    {
        foreach ($allCus as $cu) {
            $nameCu = $cu->getName();
            $types = $cu->getTypeMeuleCus();

            foreach ($types as $typeMole) {
                $type = $typeMole->getTypeMeule();
                $tableResults[$nameCu][$type][] = $cu;
            } 
        }
        
        return $tableResults;
    }
}