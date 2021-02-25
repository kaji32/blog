<?php
require_once('blog.php');

$blog = new Blog();

$blogs = $_POST;

// var_dump($blogs);

$blog->validateBlog($blogs);

$blog->blogCreate($blogs);


?>