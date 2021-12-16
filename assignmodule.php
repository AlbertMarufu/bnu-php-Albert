<?php
//Includes
include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");


//Login validation
if (isset($_SESSION['id'])) {

  //Header and Nav Bar
  echo template("templates/partials/header.php");
  echo template("templates/partials/nav.php");

  // Module selected
  if (isset($_POST['selmodule'])) {
    $sql = "insert into studentmodules values ('" .  $_SESSION['id'] . "','" . $_POST['selmodule'] . "');";
    $result = mysqli_query($conn, $sql);
    $data['content'] .= "<p>The module " . $_POST['selmodule'] . " has been assigned to you</p>";
  }
  else  // No module selected
  {

   // Getting all modules
   $sql = "select * from module";
   $result = mysqli_query($conn, $sql);

   //Content
   $data['content'] .= "<div class='selectModuleDiv'><form name='frmassignmodule' action='' method='post' >";
   $data['content'] .= "<h3><center>Select a module to assign</center></h3>";
   $data['content'] .= "<center><select name='selmodule' class='selectModule'></center>";

   // Displaying all modules
   while($row = mysqli_fetch_array($result)) {
     $data['content'] .= "<option value='$row[modulecode]'>$row[name]</option>";
   }
   $data['content'] .= "</select><br/>";
   $data['content'] .= "<center><input type='submit' name='confirm' value='Save' class='submitButton'/></center>";
   $data['content'] .= "</form></div>";
  }

  //Display content
  echo template("templates/default.php", $data);

} else {

  header("Location: index.php");

}

//Footer
echo template("templates/partials/footer.php");

?>
