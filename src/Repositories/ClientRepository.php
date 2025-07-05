<?php
namespace App\Repositories;

class ClientRepository extends BaseRepository {
    public function __construct() {
        parent::__construct('clients', 'client_id');
    }

}