<?php
namespace App\Repositories;

class ArticleConfectionRepository extends BaseRepository {
    public function __construct() {
        parent::__construct('articles_confection', 'article_confection_id');
    }

}