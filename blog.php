<?php
ini_set('display_errors', "On");
require_once('dbc.php');

class Blog extends Dbc{

    protected $table_name = 'blog';

    public function setCategory($category){
        if($category==='1'){
            return 'ブログ';
        }elseif($category==='2'){
            return '日常';
        }elseif($category==='3'){
            return '雑談';
        }
    }

    public function getById($id){

        if(empty($id)){
            exit('ブログが存在しません');
        }
        $dbh = $this->connectDb();
        $stmt = $dbh->prepare('select * from blog where id = :id');
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        if(!$result){
            exit('ブログが存在しません');
        }
        
        return $result;
    }

    public function validateBlog($blogs){

        if(empty($blogs['title'])){
            exit('タイトルを入力してください！');
        }

        if(mb_strlen($blogs['title']) > 191 ){
            exit('タイトルは191字以下です！');
        }

        if(empty($blogs['content'])){
            exit('本文を入力してください！');
        }
        if(empty($blogs['category'])){
            exit('カテゴリーは必須です！');
        }

        if(empty($blogs['publish_status'])){
            exit('公開状況は必須です！');
        }
    }

    public function blogUpdate($blogs){
        $sql = "UPDATE $this->table_name SET
            title=:title, content=:content, category=:category, publish_status=:publish_status
        WHERE
            id=:id";


        $dbh = $this->connectDb();
        $dbh->beginTransaction();
        try{
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':title',$blogs['title'], PDO::PARAM_STR);

            $stmt->bindValue(':content',$blogs['content'], PDO::PARAM_STR);
            $stmt->bindValue(':category',$blogs['category'], PDO::PARAM_INT);
            $stmt->bindValue(':publish_status',$blogs['publish_status'], PDO::PARAM_INT);
            $stmt->bindValue(':id',$blogs['id'], PDO::PARAM_INT);
            $stmt->execute();
            $dbh->commit();
            echo 'ブログを投稿しました！';
        }catch(PDOException $e){
            $dbh->rollBack();
            exit($e);
        }
    }
}
