<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ContactModel;


class Exercices extends BaseController 
{

    public function index($ID=null, $nom=null, $age=null, $sexe=null)

    {
        

        echo $ID . ' '. $nom . ' '. $age . ' ';
        echo "<br>";

            if($age>=18) {

                echo $nom . ' '. "tu es majeur" . ' ';
                echo "<br>";

            }else {

                echo $nom . ' '. "tu n'es pas majeur" . ' ';
                echo "<br>";
            }

        switch ($sexe) {

            case "homme" : 
                echo 'Je suis un homme';
                break;
            
            case "femme" : 
                echo 'Je suis une femme';
                break;

            default :
                echo 'Je ne sais pas qui je suis';
                break;

        } 

        $data = ['id' => $ID];

        echo view ('/Exercices', $data);

    }


}