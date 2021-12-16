<?php

  //Includes
  include("_includes/config.inc");
  include("_includes/dbconnect.inc");
  include("_includes/functions.inc");

  //Hearder
  echo template("templates/partials/header.php");

  //Failed login
  if (isset($_GET['return'])) {

    $msg = "";
    if ($_GET['return'] == "fail") {$msg = "Login Failed. Please try again.";}
    $data['message'] = "<p><center>$msg<center></p>";

  }

  //Content
  if (isset($_SESSION['id'])) {

    $data['content'] = "<h1>Welcome to your dashboard.";
    echo template("templates/partials/nav.php");
    echo template("templates/default.php", $data);

  } else {

    echo template("templates/login.php", $data);

  }

  //Footer
  echo template("templates/partials/footer.php");

?>
