<?php
require_once("Manager.php");
class  ManagerMovie extends Manager {

   function checkDB($params){
      $db = $this->dbConnect();
      $req = $db->prepare("SELECT DISTINCT(count(id)) as nb_movies FROM Movie WHERE user_id=?");
      $req->execute(array(
         (int)$params['userId']
      ));
      $countData = $req->fetch();
      return $countData["nb_movies"];
   }

   function addMovie($params){
      $db = $this->dbConnect(); //connect DB
      $countData = $this->checkDB($params);
      $req = $db->prepare('INSERT INTO Movie(title, poster, director, actors, release_date, movie_id, user_id, ranking) VALUES(:title, :poster, :director, :actors, :release_date, :movie_id, :user_id, :ranking)');
      $req->execute(array(
         'title' => $params['title'], 
         'poster' => $params['poster'], 
         'director' => $params['director'], 
         'actors' => $params['actors'], 
         'release_date' => $params['releaseDate'], 
         'movie_id' => $params['movieId'], 
         'user_id' => $params['userId'], 
         'ranking' => $countData + 1
           ));
      //return id of the last record that has been inserted
      $stmt = $db->query("SELECT LAST_INSERT_ID()");
      $lastId = $stmt->fetchColumn();
      return $lastId;
   }

   function getNewMovie($last_id){
      $db = $this->dbConnect(); //connect DB
      $req = $db->prepare('SELECT * FROM Movie WHERE id= ?');
      $req->execute(array(
         $last_id
      ));
      return $req->fetch();
   }

   function deleteMovie($params){
      echo "deleteMovie in manager";
      $db = $this->dbConnect();
      $req=$db->prepare('DELETE FROM Movie WHERE user_id = :user_id AND title = :title');
      $req->execute(array(
            'user_id' => $params['userId'],
            'title' =>  $params['title']
      ));
   }

   /**
    * UPDATE Movie SET ranking = CASE title WHEN 'Mulan' THEN 3 WHEN 'Aladin' THEN 1 END WHERE title IN('Mulan', 'Aladin')
    */
   function updateRanking($params){
      
      $userId = $params['userId'];
      $ranks = $params['ranks'];
      $db = $this->dbConnect();
      echo "updateRanking in manager//rankingObj///";
      
      foreach ($ranks as $rank){
         print_r($rank);

         $req=$db->prepare('UPDATE Movie SET ranking = :ranking WHERE title = :title AND user_id = :user_id'); 
         $req->execute(array(
               'ranking' => $rank->number,
               'title' => $rank->title,
               'user_id' => $userId
         ));
      }


   }

   function loadMovies($userId){
      $db = $this->dbConnect(); //connect DB
      $req = $db->prepare('SELECT * FROM Movie WHERE user_id = :user_id ORDER BY ranking');
      $req->execute(array(
            'user_id' => $userId
         ));
      return $req->fetchAll();
   } 
}