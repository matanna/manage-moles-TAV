<?php

namespace App\Utils;

/**
 * This class try MeuleTypeCus objects retrieved by a request on the the database
 * The moles are try by there type and type of glass
 * We create an array taking for index the type of moles
 */
class TryMolesCu
{
    public function tryMolesPerType($typeMoles) 
    {

        foreach ($typeMoles as $mole) {
            $type = $mole->getTypeMeule();
            $typeVerre = $mole->getTypeVerre();

            $tableResults[$type][$typeVerre][] = $mole;
        }
        
        return $tableResults;
    }
}