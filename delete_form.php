<?php
ini_set('display_errors', "On");
require_once('blog.php');

$id = $_GET['id'];

$blog = new Blog();

$blog->blogDelete($id);

?>