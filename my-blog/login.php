<?php
require './database/database.php';
use Catalog\Mysql\Database;

session_start();

if (isset($_SESSION['uid']) && isset($_COOKIE['remember_id'])) {
    header('location: blog.php');
}


$error = '';

if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
    if (
        empty($email) ||
        !filter_var($email, FILTER_VALIDATE_EMAIL)
    ) {

        $error = ' * A valid email is required';
        return;
    }
    if (empty($password)) {
        $error = ' * Password field is required';
        return;
    } 

    $database = new Database();
    $database->connect();

    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";

    $result = $database->select($query);

    if(count($result) > 0 ){
      $for_time = time() + 60 * 60 * 24 * 365;
      setcookie('remember_id', $result[0]['id'], $for_time);
      setcookie('remember_name', $result[0]['name'], $for_time);

      $_SESSION['uid'] = $result[0]['id'];
      $_SESSION['uname'] = $result[0]['name'];
      header('location: blog.php');
    } else {
      $error = ' * Wrong email/password combination';
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
    <title>Home</title>
  </head>
  <body id="about">
    <div class="container">
      <header>
        <h1>Login</h1>
        <h5>Lorem ipsum dolor sit amet.</h5>
      </header>

      <main class="py-4">
        <form method="post" action="" novalidate="novalidate">
            <div>
        <label for="email">* Email</label>
        <input type="email" name="email" id="email" />
        </div>
        <div>
        <label for="password">* Password</label>
        <input type="password" name="password" id="password" />
        </div>
        <div class="text-danger"><?= $error; ?></div>
        <input type="submit" name="submit" value="Login">
        </form>
      </main>
    </div>
  </body>
</html>
