<?php
//Includes
include("_includes/dbconnect.inc");
include "_includes/passwordLib.php";

//Requirements
require_once 'vendor/autoload.php';

//Create Faker
$faker = Faker\Factory::create();

//Create dummy data
for($i = 0; $i < 5; $i++){

  $studentID = $faker->numberBetween(20000001, 99999999);
  $password = password_hash($faker->password, PASSWORD_DEFAULT);
  $dob = $faker->date($format = 'Y-m-d', $max = '-18 years');
  $firstName = $faker->firstName($gender = 'male'|'female');
  $lastName = $faker->lastname;
  $streetAdress = $faker->buildingNumber . " " . $faker->streetName;
  $town = "High Wycombe";
  $county = "Bucks";
  $country = "UK";
  $postCode = "HP1" . $faker->numberBetween(0, 1) . " " . $faker->randomNumber(2, false) . strtoupper($faker->randomLetter) . strtoupper($faker->randomLetter);

  //Adding data to mysql database
  $sql = "INSERT INTO 'student' ('studentid', 'password', 'dob', 'firstname', 'lastname', 'house', 'town', 'county', 'country', 'postcode')
          VALUES ('$studentID', '$password', '$dob', '$firstName', '$lastName', '$streetAdress', '$town', '$county', '$country', '$postCode');";

  $result = mysqli_query($conn, $sql);
}

//Result
if($result){
  echo "Data added!";
}
else{
  echo "An error occured!";
}
?>
