<?php
ini_set('display_errors', "On");
require_once('blog.php');

$blog = new Blog();

$result = $blog->getById($_GET['id']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>ブログ詳細</h2>
    <h3>タイトル:<?php echo $result['title']?></h3>
    <p>投稿日時:<?php echo $result['post_at']?></p>
    <p>カテゴリー:<?php echo $blog->setCategory($result['category'])?></p>
    <hr>
    <p><?php echo $result['content']?></p>
</body>
</html>