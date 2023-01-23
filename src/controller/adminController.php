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
      $res = 'true';
      foreach ($articles as $article){
          $article['title'] = htmlspecialchars( $article['title'] );
          $article['content'] = htmlspecialchars( $article['content'] );
          try {
                $_SESSION['admin']->createArticle($article);
              }
              catch (Exception $e){
                  $res = 'false';
                  break;
              }
      }
      echo $res;
   }
}
