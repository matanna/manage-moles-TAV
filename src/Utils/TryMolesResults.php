<?php

namespace App\Utils;

/**
 * Cette classe permet de trier les objets MeulesRecti récupérés par requête à la base de données.
 * On crée un tableau comprenant des tablaeux ayant pour index la valeur du paramètre position de MeulesRecti.
 * Chaque Objets MeulesRecti étant placé dans le tableau ayant pour index la valeur correspondant à son paramètre position 
 */
class TryMolesResults
{
    public function tryMolesPerPosition($results) 
    {
        
        //Initialisation du méta tableau
        $tableResults = [];

        //On regroupe les résultats dans un tableau qui a pour index le paramètre position de chaque objet récupéré
        //Ce tableau est lui même placé dans un méta tableau qui est retourné

        //Initialisation du tableau regroupant les objets avec la même position
        $resultPerPosition = [];
        
        foreach ($results as $result) {
            //On récupère la position de la meule
            $position = $result->getPosition(); 
            
            //Si le tableau resultPerPosition n'est pas vide
            if ($resultPerPosition != []){

                //On récupère la valeur de la dernière ligne du tableau
                $lastResult = end($resultPerPosition);
                
                //On compare la position récupérée à la position de la dernière ligne 
                if ($position != $lastResult->getPosition()) {
                    
                    //Si les positions sont différentes, on vide le tableau
                    $resultPerPosition = [];
                }
            }
            
            $resultPerPosition[] = $result;
            
            $tableResults[$position] = $resultPerPosition;        
        }
        
        return $tableResults;
    }
}