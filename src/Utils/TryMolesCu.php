<?php

namespace App\Utils;

/**
 * This class try MeuleTypeCus objects retrieved by a request on the the database
 * The moles are try by there type
 * We create an array taking for index the type of moles
 */
class TryMolesCu
{
    public function tryMolesPerType($typeMoles) 
    {
        //The meta array is initialize
        $tableResults = [];
        

        foreach ($typeMoles as $mole) {
            $type = $mole->getTypeMeule();
            $tableResults[$type] = $mole;
        }
       
        return $tableResults;
    }
}