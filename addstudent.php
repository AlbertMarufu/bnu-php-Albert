<?php

//Includes
include("_includes/config.inc");
include("_includes/functions.inc");
include('_includes/dbconnect.inc');
include "_includes/passwordLib.php";

//Login validation
if (isset($_SESSION['id'])) {

  //Header and Nav Bar
  echo template("templates/partials/header.php");
  echo template("templates/partials/nav.php");


  //Content
  $data['content'] = "
  <h2>Add Student</h2>
  <form action='addstudent.php' method='post' enctype='multipart/form-data'>
    <table class='inputTable'>
      <tr>
        <td>
          Student ID:
        </td>
        <td>
          <input type='text' name='studentid' placeholder='20000000' required>
        </td>
      </tr>
      <tr>
        <td>
          Password (Min. 6 characters):
        </td>
        <td>
          <input type='password' name='password' required>
        </td>
      </tr>
      <tr>
        <td>
          Confirm Password:
        </td>
        <td>
          <input type='password' name='passwordConfirm' required>
        </td>
      </tr>
      <tr>
        <td>
          DoB(YYYY-MM-DD):
        </td>
        <td>
          <input type='text' name='dob' placeholder='1990-01-01' required>
        </td>
      </tr>
      <tr>
        <td>
          First Name:
        </td>
        <td>
          <input type='text' name='firstName' placeholder='Josh' required>
        </td>
      </tr>
      <tr>
        <td>
          Last Name:
        </td>
        <td>
          <input type='text' name='lastName' placeholder='Walker' required>
        </td>
      </tr>
      <tr>
        <td>
          House:
        </td>
        <td>
          <input type='text' name='house' placeholder='High Wycombe Campus, Queen Alexandra Road' required>
        </td>
      </tr>
      <tr>
        <td>
          Town:
        </td>
        <td>
          <input type='text' name='town' placeholder='High Wycombe' required>
        </td>
      </tr>
      <tr>
        <td>
          County:
        </td>
        <td>
          <input type='text' name='county' placeholder='Buckinghamshire' required>
        </td>
      </tr>
      <tr>
        <td>
          Country:
        </td>
        <td>
          <input type='text' name='country' placeholder='UK' required>
        </td>
      </tr>
      <tr>
        <td>
          Postcode:
        </td>
        <td>
          <input type='text' name='postcode' placeholder='HP11 2JZ' required>
        </td>
      </tr>
      <tr>
        <td>
          Picture:
        </td>
        <td>
          <input type='file' name='image' accept='image/jpeg' class='form-control' required/>
        </td>
      </tr>
    </table>
    <input type='submit' name='submit' value='Submit' class='submitButton'/>
  </form>";

  //Display content
  echo template("templates/default.php", $data);

  //Form submitted
  if(isset($_POST['submit'])){

    //Saving POSTed data
    $id = $_POST['studentid'];
    $password = $_POST['password'];
    $passwordConf = $_POST['passwordConfirm'];
    $dob = $_POST['dob'];
    $fName = $_POST['firstName'];
    $lName = $_POST['lastName'];
    $house = $_POST['house'];
    $town = $_POST['town'];
    $county = $_POST['county'];
    $country = $_POST['country'];
    $postcode = $_POST['postcode'];
    $image = $_FILES['image']['tmp_name'];
    $imagedata = addslashes(fread(fopen($image, "r"), filesize($image)));

    //Data validation
    if(strlen($id) == 8 && strlen($password) >= 6 && $password == $passwordConf){

      //Saving data on mysql database
      $password = password_hash($password, PASSWORD_DEFAULT);

      $sql = "INSERT INTO 'student' ('studentid', 'password', 'dob', 'firstname', 'lastname', 'house', 'town', 'county', 'country', 'postcode', 'picture')
                VALUES ('$id', '$password', '$dob', '$fName', '$lName', '$house', '$town', '$county', '$country', '$postcode', '$imagedata');";

      $result = mysqli_query($conn, $sql);

      if($result){

        echo "Student added!";

      } else {

        echo "An error occured!";

      }
    }
    //Error messages
    else {

      if(strlen($id) != 8){

        echo "<div class='submitAlert'>Invalid ID</div>";

      }
      if(strlen($password) < 6){

        echo "<div class='submitAlert'>Password must be at least 6 characters long</div>";

      }
      if($password != $passwordConf){

        echo "<div class='submitAlert'>Password confirmation differ from password field!</div>";

      }
    }
  }

} else {

  header("Location: index.php");

}

//Footer
echo template("templates/partials/footer.php");

?>
