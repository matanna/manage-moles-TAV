<?php

namespace App\Utils;

/**
 * This class sort MeuleTypeCus objects retrieved by a request on the the database
 */
class TryMolesCu
{
    /**
     * Moles are sort by there type and typical name (thikness of glass or diameter or width according to type of each mole)
     * We create an array taking for index the type of moles and typical
     */
    public function tryMolesPerType($typeMoles) 
    {
        foreach ($typeMoles as $mole) {
            $type = $mole->getTypeMeule();
            $typical = $mole->getTypical();

            $tableResults[$type][$typical][] = $mole;
        }
        
        return $tableResults;
    }

    /**
     * Moles are sort by there Cu and ther type
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