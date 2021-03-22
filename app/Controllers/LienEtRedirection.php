<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ContactModel;


class LienEtRedirection extends BaseController 
{

    public function index($page=null)
    
    {
        switch ($page) {

            case "accueil" : 
                return redirect()->to('/LienEtRedirection/accueil');
                break;
            
            case "boutique" :
                return redirect()->to('/LienEtRedirection/boutique');
                break;

            default : 
                echo 'ICI';
                break;

        }

        //echo 'page' . $page;
    }

    public function accueil()
    {
        echo 'Je suis dans l\'accueil <br>' ;
        echo "<a href=" . base_url('LienEtRedirection/boutique') . ">Lien vers Boutique</a>";
    }

    public function boutique()
    {
        echo 'Je suis dans la boutique <br>';
        echo "<a href=" . base_url('LienEtRedirection/accueil') . ">Lien vers Accueil</a>";

    }

    








}