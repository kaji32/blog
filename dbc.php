<?php 
ini_set('display_errors', "On");

class Dbc{

    protected $table_name;
    
  

    protected function connectDb(){

        $dsn = 'mysql:host=localhost;dbname=blog_app;charset=utf8';
        $username = 'root';
        $pass = '';

        try{
            $dbh = new \PDO($dsn, $username, $pass,[
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
            ]);
            // echo 'SUCCESS!';
        
        }catch(PDOException $e){
            echo 'FALSE!'.$e->getMessage();
            exit();

    }
        return $dbh;
    }

   

    
    public function getAll(){
        $db = $this->connectDb();
        $sql = "select * from $this->table_name" ;
        $stmt = $db->query($sql);
        $results = $stmt->fetchAll();
        $dbh = null;
        return $results;
    }

    

    public function blogCreate($blogs){
        $sql = "INSERT INTO 
            $this->table_name(title, content, category, publish_status)
        VALUES
            (:title, :content, :category, :publish_status)";


        $dbh = $this->connectDb();
        $dbh->beginTransaction();
        try{
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':title',$blogs['title'], PDO::PARAM_STR);

            $stmt->bindValue(':content',$blogs['content'], PDO::PARAM_STR);
            $stmt->bindValue(':category',$blogs['category'], PDO::PARAM_INT);
            $stmt->bindValue(':publish_status',$blogs['publish_status'], PDO::PARAM_INT);
            $stmt->execute();
            $dbh->commit();
            echo 'ブログを投稿しました！';
        }catch(PDOException $e){
            $dbh->rollBack();
            exit($e);
        }

    }

    public function blogDelete($id){
        
        if(empty($id)){
            exit('ブログが存在しません');
        }
        $dbh = $this->connectDb();
        $stmt = $dbh->prepare("DELETE from $this->table_name where id = :id");
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        echo 'ブログを削除しました！';
    }
}
?>
