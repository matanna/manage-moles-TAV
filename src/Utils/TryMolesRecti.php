<?php

namespace App\Utils;

/**
 * This class try MeulesRecti objects retrieved by a request on the the database
 * We create an array with arrays having for index the value of MeulesRecti position parameter
 * Each MeulesRecti objects is replaced in an array having for index his position parameter
 */
class TryMolesRecti
{
    public function tryMolesPerPosition($results) 
    {
        //The meta array is initialize
        $tableResults = [];
        
        //Initialization of the array who are the same index (position parameter name)
        $resultPerPosition = [];
        
        foreach ($results as $result) {
            //We retrieve mole position - There is only one position in the Array Collection because results are only for one machine
            $position = $result->getPosition()->getName(); 

            //If array resultPerPosition is not empty
            if ($resultPerPosition != []){

                //We retrieve value of the last line of the array
                $lastResult = end($resultPerPosition);

                //We compared the position retrieved to the last line position
                if ($position != $lastResult->getPosition()->getName()) {

                    //If the positions are different, we empty the array
                    $resultPerPosition = [];
                }
            }
            
            $resultPerPosition[] = $result;

            if ($position == NULL) {
                $tableResults['NULL'] = $resultPerPosition;
            } else {
                $tableResults[$position] = $resultPerPosition; 
            }
                  
        }
  
        return $tableResults;
    }
}