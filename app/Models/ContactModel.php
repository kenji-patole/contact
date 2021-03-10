<?php namespace App\Models;
 
use CodeIgniter\Model;

class ContactModel extends Model{
    protected $table = 'contact';
    protected $allowedFields = ['ContactID','ContactFirstName','ContactLastName','ContactCompany','ContactJobTitle','ContactEmail','ContactPhone','ContactNotes','ContactFavoris','ContactImage','ContactDateCreate'];
}
