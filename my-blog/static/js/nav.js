function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(";");
  for (let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == " ") {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

const username = getCookie("remember_name");

const navHtml = `<nav class="navbar navbar-expand-lg bg-light">
<div class="container-fluid">
  <a class="navbar-brand" href="index.html"><img
  class="logo" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQnnUsFT6Xfzq4-7Wq7pSlyjIkEQEwiJx3rhN2PnWECVvn7omxez0QUhnA0xQtt6KdGrOM&usqp=CAU"
  alt="home"
/></a>
  <button
    class="navbar-toggler"
    type="button"
    data-bs-toggle="collapse"
    data-bs-target="#navbarNav"
    aria-controls="navbarNav"
    aria-expanded="false"
    aria-label="Toggle navigation"
  >
    <span class="navbar-toggler-icon"></span>
  </button>
  <div
    class="collapse navbar-collapse justify-content-between"
    id="navbarNav"
  >
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="about.html">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="blog.php">Blog</a>
      </li>
    </ul>
    <ul class="navbar-nav">
      ${
        username
          ? `Hey ${username}`
          : `<li class="nav-item">
        <a class="nav-link active" aria-current="page" href="login.php"
          >Sign in</a
        >
      </li>
      <li class="nav-item">
        <a class="nav-link" href="register.php">Signup</a>
      </li>`
      }
    </ul>
  </div>
</div>
</nav>`;

document.body.insertAdjacentHTML("afterbegin", navHtml);
