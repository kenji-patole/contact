<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ContactModel;


class Api extends BaseController 
{
   public $contactModel = null;

    public function __construct()
	{
		// Instanciation de la classe //
		$this->contactModel = new ContactModel();

    }

    public function index() 
    {
        
        $listContact = $this->contactModel->orderBy('first_Name', 'ASC')
                                          ->orderBy('last_Name', 'ASC')
                                          ->paginate(9);
                                            
        //echo json_encode($listContact);
        
       // echo $this->request->getVar('type');

            if(!empty($this->request->getVar('type')) && !empty($this->request->getVar('elementsRecherches'))) {

                $elementsRecherches = $this->request->getVar('elementsRecherches');
                $type = $this->request->getVar('type');

                switch ($type) {    

                    case "recherche" : 
                        $listContact = $this->contactModel->like('first_Name', $elementsRecherches, 'both', null, true)
                                                          ->orlike('last_Name', $elementsRecherches, 'both', null, true)
                                                          ->orderBy('first_Name', 'ASC')
                                                          ->orderBy('last_Name', 'ASC')
                                                          ->paginate(9);
                    break;

                }

            }

            return $this->response->setJSON($listContact);
       

    }
    // La fonction EDIT peut modifier des contacts //
    public function edit()
    {

        $etatAction = ['response' => false];

        $rules = [

            'id'       => 'required',
            'lastName' => 'required',
            'phone'    => 'required',
            
            
        ];


            if($this->validate($rules)) {

                
                $id = $this->request->getVar('id'); 

                // Je dois intérroger la base à partir de l'id pour vérifier que l'id existe en base //
                $contact = $this->contactModel->where('id', $id)
                                             ->first();

                    if(!empty($contact)) {

                        // ÉLÉMENTS A MODIFIER //
                        $dataSave = [

                            'last_Name' => $this->request->getVar('lastName'),
                            'phone'     => $this->request->getVar('phone'),
                            'first_Name'=> $this->request->getVar('firstName'),
                    
                        ];

                            if($this->request->getVar('email') !='') {

                                $dataSave['email'] = $this->request->getVar('email');

                            }

                        $this->contactModel->where('id', $id)
                                           ->set($dataSave)
                                           ->update();

                        $etatAction = ['response' => true];


                    } else {

                        $etatAction['error']['id'] ='Le contact n\'existe pas';

                    }
                    
            } // THE END IF VALIDATE // 

            else {

                if(empty($this->request->getVar('id'))) {

                    $etatAction['error']['id'] ='NO ID';
            
                }

                if(empty($this->request->getVar('lastName'))) {

                    $etatAction['error']['lastName'] ='NO LASTNAME';
            
                }
            
                if (empty($this->request->getVar('phone'))) {

                    $etatAction['error']['phone'] ='NO PHONE';

                }

            }

            return $this->response->setJSON($etatAction);

    }
    // La fonction DELETE peut supprimer un ou plusieurs contacts //
    public function delete()
    {
       
        
        $etatAction = ['response'=> false];

            // 2. S'IL EXISTE JE PASSE AU 3
            if(!empty($this->request->getVar('id'))) {

                 //1. JE RÉCUPERE L'IDENTIFIANT DU CONTACT A SUPPRIMER 
                $id = $this->request->getVar('id');

                //3. JE FAIS MA REQUETE POUR SUPPRIMER
                $this->contactModel->where('id', $id)->delete();

                $etatAction = ['response'=> true];

            }
        // 4. J'INFORME DE L'ÉTAT DE LA SUPPRESSION
        return $this->response->setJSON($etatAction);
        
    
    }   


    
    // La fonction FAVORIS peut ajouter ou supprimer des contacts//
    public function favory()
    {
        $etatAction = ['response'=> false];

        // 2. S'IL EXISTE JE PASSE AU 3
        if(!empty($this->request->getVar('id'))) {

            // 1. JE RÉCUPERE L'IDENTIFIANT DU CONTACT 
            $id = $this->request->getVar('id');

            // 3. JE FAIS MA REQUÊTE POUR INTERROGER LA BASE POUR VÉRIFIER SON ÉTAT 
            $contact = $this->contactModel->where('id', $id)->first();

            //echo $contact['favory'];

                // 4. SI IL EST EN FAVORIS -> ON lE RETIRE, S'IL NE L'EST PAS -> ON L'AJOUTE

                // JE VÉRIFIE QUE LA REQUÊTE A UN RÊSULTAT 
                if(!empty($contact)) {

                    if($contact['favory'] == 'Yes') {

                        $contact = $this->contactModel->where('id', $id)->set('favory', 'No')->update();
                                

                    } else {

                        $contact = $this->contactModel->where('id', $id)->set('favory', 'Yes')->update();


                    }

                }

        }


    }

       /**********************************************************************
       La fonction CREATE reçoit les informations suivantes en POST via l'API
            $this->request-getVar
        
                LES VALEURS : 

                le nom : string, REQUIRED
                le prénom : string
                l'entreprise : string 
                le métier : string
                l'email : string
                le téléphone : string, REQUIRED
                les notes : string 
                la date de création du contact : string 
                l'image : string
       
       La fonction retourne : 
        - contact créée = TRUE
        - contact pas créée = FALSE
       **********************************************************************/


    // La fonction CREATE permet de créer un nouveau Contact
    public function create()
    {

        $etatAction = ['response' => false];

        $rules = [

            'lastName' => 'required',
            'phone'    => 'required',

        ];

            if($this->validate($rules)) {

                // Intercepter le nom et le phone

                // NOM
                $lastName = $this->request->getVar('lastName');

                // PHONE
                $phone = $this->request->getVar('phone');

                $dataSave = [

                    'last_Name' => $this->request->getVar('lastName'),
                    'phone'     => $this->request->getVar('phone')

                ];

                $this->contactModel->save($dataSave);

                $etatAction = ['response' => true];



            }// THE END IF VALIDATE // 

            else {
                

                    if(empty($this->request->getVar('lastName'))) {

                        $etatAction['error']['lastName'] ='NO LASTNAME';
                
                    }
                
                    if (empty($this->request->getVar('phone'))) {

                        $etatAction['error']['phone'] ='NO PHONE';

                    }

            }
        
        
        return $this->response->setJSON($etatAction);


    }



}




    





