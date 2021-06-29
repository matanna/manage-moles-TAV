<?php

namespace App\Utils;

/**
 * This class try WheelsRectiMachine objects retrieved by a request on the the database
 * We create an array with arrays having for index the value of WheelsRectiMachine position parameter
 * Each WheelsRectiMachine objects is replaced in an array having for index his position parameter
 */
class SortWheelsRectiMachine
{
    public function sortWheelsByPosition($results) 
    {
        //The meta array is initialize
        $tableResults = [];
        
        //Initialization of the array who are the same index (position parameter name)
        $resultByPosition = [];
        
        foreach ($results as $result) {
            //We retrieve wheels position - There is only one position in the Array Collection because results are only for one machine
            $position = $result->getPosition()->getName(); 

            //If array resultPerPosition is not empty
            if ($resultByPosition != []){

                //We retrieve value of the last line of the array
                $lastResult = end($resultByPosition);

                //We compared the position retrieved to the last line position
                if ($position != $lastResult->getPosition()->getName()) {

                    //If the positions are different, we empty the array
                    $resultByPosition = [];
                }
            }
            
            $resultByPosition[] = $result;

            if ($position == NULL) {
                $tableResults['NULL'] = $resultByPosition;
            } else {
                $tableResults[$position] = $resultByPosition; 
            }
                  
        }
  
        return $tableResults;
    }
}