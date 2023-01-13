<?php

require './database/database.php';
use Catalog\Mysql\Database;




$posts = [];
$postId='';
try {
    $db = new Database();
    $db->connect();
    if (isset($_POST['submit'])) {
      $postId = $_POST['postId'];

      $db->delete("posts", $postId);
    }
    $posts = $db->select("SELECT * FROM posts");
    
} catch (Exception $ex) {
    print_r("Error: {$ex->getMessage()}");
}

$user = False;
if (isset($_COOKIE['remember_id'])) {
    $user = $_COOKIE['remember_id'];
}

$customer_name = "80's Store";
$updates = True;
$store_rating = rand(1, 5);

$search = '';


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
    <script src="static/js/delete.js" defer></script>
    <link rel="stylesheet" href="static/css/style.css" />
    <title>Blog</title>
  </head>
  <body> 
<main class="p-4 bg-dark text-white shadow">
    
    <?php if ($user) : ?>
        <button onclick="window.location.href='add-post.php';" class="pb-3 mb-5 addPost">
           Add Post
        </button>
    <?php endif; ?>

    <h4 class="mb-3">Recent Posts <?= $postId; ?></h4>
    <div class="row mb-5 pb-3">
        <?php
        foreach ($posts as $post) {
          $postId = $post['id'];
          $title = $post['title'];
          $article = $post['article'];
          $date = $post['date'];
          $userId = $post['userId'];
          $name = $db->select("SELECT name FROM users WHERE id='$userId'")[0]['name'];

            $col = <<<COL
                    <div class="col-sm-12 col-md-4 mb-3">
                      <div><span>{$name}</span><br><span>{$date}</span> </div>
                        <div class="card">
                            <div class="card-body text-dark">
                                <h5 class="card-title">{$title}</h5>
                                <p class="card-text">{$article}</p>
                            </div>
                    COL;
            if($user == $userId){
              $col .= <<<COL
                        <button><a class="joinus" href="edit-post.php?postId={$postId}">Edit</a> </button>
                        <form method="post" action="" novalidate="novalidate">
                          <input name="postId" type="text" style="display:none;" value="{$postId}"/>
                          <input class="delete-btn joinus" type="submit" name="submit" value="Delete">

                        </form>
                    COL;
            }


            $col .= <<<COL
                        </div>
                    </div>
                    COL;
                

             echo $col;
        }
        ?>
    </div>

</main>
</body>
</html>