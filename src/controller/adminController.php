<?php


class AdminController
{
   public function getAllAuthor():array
   {
       return Database::connect()->query("select * from author")->fetchAll(PDO::FETCH_ASSOC);
   }

   public function getAllCategory():array
   {
       return Database::connect()->query("select * from category")->fetchAll(PDO::FETCH_ASSOC);
   }

   public function createArticles(array $articles):void
   {
      $saved = 0;
      echo "Back-end active";
      die;
      foreach ($articles as $article){
          $article['title'] = htmlspecialchars( $article['title'] );
           //$_SESSION['admin']->createArticle($article);
      }

   }
}
