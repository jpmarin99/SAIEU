<?php
namespace App\Services;

use Kreait\Firebase\Factory;

require './vendor/autoload.php';

Class FirebaseService
{
    private $firebase;
    private $db;

    /**
     * @return mixed
     */
    public function __construct()
    {
       $this->firebase = (new factory)->withServiceAccount('./key/ageless-period-255501-571466f4b387.json');
        $this->db = $this->firebase->CreateDatabase();
    }

    public function  Avisos()
    {
        $reference = $this->db->getReference('/Aviso');
    }
}
