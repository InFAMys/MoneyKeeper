<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap"
      rel="stylesheet"
    />
    <title>Login</title>
  </head>
  <body>
    <div class="navbar">
      <ul>
        <li><a href="../index.php">Home</a></li>
        <li><a href="./input.php">Input Jurnal</a></li>
        <li><a href="./jurnal.php">Jurnal</a></li>
        <a class="btn-nav right-link" href="#">Login</a>
      </ul>
    </div>
    <div class="main">
      <div class="back">
        <a href="../index.php">< Go Back</a>
      </div>
      <h1 class="top-h1">Login</h1>
      <form action="">
        <input
          type="text"
          name="username"
          id="username"
          placeholder="Username"
          required
        />
        <br />
        <input
          type="password"
          name="password"
          id="password"
          placeholder="Password"
          required
        />
        <br />
        <button type="reset" class="btn-login-own">Login</button>
      </form>
    </div>
  </body>
</html>
