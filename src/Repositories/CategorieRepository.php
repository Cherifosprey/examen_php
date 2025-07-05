<?php
namespace App\Repositories;

class CategorieRepository extends BaseRepository {
    public function __construct() {
        parent::__construct('categories', 'categorie_id'); 
    }

}