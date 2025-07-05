<?php
namespace App\Repositories;

class FournisseurRepository extends BaseRepository {
    public function __construct() {
        parent::__construct('fournisseurs', 'fournisseur_id'); 
    }

}