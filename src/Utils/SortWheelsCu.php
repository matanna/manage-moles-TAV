<?php

namespace App\Utils;

/**
 * This class sort WheelsCuType objects retrieved by a request on the the database
 */
class SortWheelsCu
{
    /**
     * Wheels are sort by there category and typel name
     * We create an array taking for index the category of wheels and type
     */
    public function sortWheelsCuByType($wheelsCu) 
    {
        foreach ($wheelsCu as $wheels) {

            $category = $wheels->getCuCategory()->getName();

            $tableResults[$category][] = $wheels;
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