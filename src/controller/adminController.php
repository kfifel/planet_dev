<?php


class AdminController
{
   public function getAllAuthor():array
   {
       return Database::connect()->query("select * from author")->fetchAll();
   }

   public function getAllCategory():array
   {
       return Database::connect()->query("select * from category")->fetchAll();
   }

   public function createArticles(array $articles):void
   {
      $res = 'true';
      foreach ($articles as $article){
          $article['title'] = htmlspecialchars( $article['title'] );
          $article['content'] = htmlspecialchars( $article['content'] );
          try {
                if(!$_SESSION['admin']->createArticle($article))
                {
                    $res = 'false';
                    break;
                }

              }
              catch (Exception $e){
                  $res = 'false';
                  break;
              }
      }
      echo $res;
   }
}
