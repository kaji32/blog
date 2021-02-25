<?php
ini_set('display_errors', "On");
require_once('blog.php');



$blog = new Blog();


$titles = $blog->getAll('blog');
// var_dump($titles);



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
    <tr>
    <th>No.</th>
    <th>タイトル</th>
    <th>カテゴリー</th>
    </tr>

    

<?php foreach($titles as $result): ?>
    <tr>
    <td><?php echo $result['id']?></td>
    <td><?php echo $result['title']?></td>
    <td><?php echo $result['post_at']?></td>
    <td><?php echo $blog->setCategory($result['category'])?></td>
    <td><a href="detail.php?id=<?php echo $result['id']?>">詳細</a></td>
    <td><a href="update_form.php?id=<?php echo $result['id']?>">編集</a></td>
    <td><a href="delete_form.php?id=<?php echo $result['id']?>">削除</a></td>
    </tr>
<?php endforeach; ?>
    </table>
    
    <p><a href="form.html">新規作成</a></p>
</body>
</html>