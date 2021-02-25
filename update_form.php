<?php
ini_set('display_errors', "On");
require_once('blog.php');

$blog = new Blog();

$result = $blog->getById($_GET['id']);
$id = $result['id'] ;
$title = $result['title'];
$content = $result['content'];
$category = $result['category'];
$publish_status = $result['publish_status'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="blog_update.php" method="POST">
        <input type="hidden" id="<?=$id;?>">
        <p>タイトル</p>
        <input type="text" name="title" value="<?=$title; ?>">
        <p>本文</p>
        <textarea name="content" id="" cols="30" rows="10" value=""><?=$content; ?></textarea>
        <br>
        <p>カテゴリー</p>
        <select name="category" id="">
            <option value="1" <?php if($category===1)echo 'selected' ;?>>ブログ</option>
            <option value="2" <?php if($category===2)echo 'selected' ;?>>日常</option>
            <option value="3" <?php if($category===3)echo 'selected' ;?>>雑談</option>
        </select>
        <br>
        <input type="radio" name="publish_status" value="1" <?php if($publish_status===1)echo 'checked' ;?>>公開
        <input type="radio" name="publish_status" value="2" <?php if($publish_status===1)echo 'checked' ;?>>非公開
        <input type="submit" value="投稿">

    </form>

</body>
</html>