<?php
require './database/database.php';
use Catalog\Mysql\Database;

session_start();

$userId = $_COOKIE['remember_id'];
if (!isset($_SESSION['uid']) || !isset($userId)) {
    header('location: blog.php');
}


$error = '';

if (isset($_POST['submit'])) {
  $title = $_POST['title'];
  $article = $_POST['article'];
    if (empty($title)) {
        $error = ' * A title is required';
    } else if (empty($article)) {
        $error = ' * article field is required';
    } else {
      $database = new Database();
      $database->connect();
      
      $data = array('title' => $title, 'article' => $article, 'userId' => $userId);
      $newPost = $database->insert('posts',$data);
      header('location: blog.php');
    }
}

?>


</html>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
      crossorigin="anonymous"
    ></script>
    <script src="static/js/nav.js" defer></script>
    <script src="static/js/footer.js" defer></script>
    <link rel="stylesheet" href="static/css/style.css" />
    <title>Add Post</title>
  </head>
  <body id="about">
    <div class="container">
      <header>
        <h1>Add Post</h1>
        <h5>Lorem ipsum dolor sit amet.</h5>
      </header>

      <main class="py-4">
        <form method="post" action="" novalidate="novalidate">
          <div>
            <label for="title">* Title</label>
            <input type="text" name="title" id="title" />
          </div>
          <div>
            <label for="article">* Article</label>
            <textarea name="article" id="article"></textarea>
          </div>
          <div class="text-danger"><?= $error; ?></div>
          <input type="submit" name="submit" value="Save">
        </form>
      </main>
    </div>
  </body>
</html>
