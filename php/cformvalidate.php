<?php

//The below portion takes the input from the user and sends as email//
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  /* ini_set( 'display_errors', 1 );
  ini_set('display_startup_errors', 1);
  error_reporting( E_ALL ); */ //This is to find any error with mail
  $from = "support@tesmachino.com";
  $to = "tesmachino@gmail.com";
  $fname = test_input($_POST["first_name"]);
  $query = test_input($_POST["comment"]);
  $pno = test_input($_POST["phone_no"]);
  $email = test_input($_POST["email"]);
  $subject = "A user recently submitted the contact Contact form $fname. \n".
  $headers = "From:" . $from;
  $ip = isset($_SERVER['HTTP_CLIENT_IP'])?$_SERVER['HTTP_CLIENT_IP']:isset($_SERVER['HTTP_X_FORWARDED_FOR'])?$_SERVER['HTTP_X_FORWARDED_FOR']:$_SERVER['REMOTE_ADDR'];
  $message = "Message was sent by the user \n --> $fname \n";
  $message .= " Message from the user \n <--> \n $query \n <--> \n";
  $message .= " Phone no of the user \n --> $pno \n";
  $message .= " User Email \n --> $email \n";
  $message .= "Ip address of the user \n -- > $ip \n";
 if (mail($to,$subject,$message, $headers)) {
  echo "The email message was sent.";
}
else{
  echo "The email message was not sent.";
}
}
//end of email //

//Validation of data starts//
if (get_magic_quotes_gpc())
{
  function stripslashes_deep($value)
  {
    $value = is_array($value) ?
        array_map('stripslashes_deep', $value) :
        stripslashes($value);
    return $value;
  }
  $_POST = array_map('stripslashes_deep', $_POST);
$_GET = array_map('stripslashes_deep', $_GET);
$_COOKIE = array_map('stripslashes_deep', $_COOKIE);
$_REQUEST = array_map('stripslashes_deep', $_REQUEST);
}

require('conn.php');
//require('findip.php');
// define variables and set to empty values
if(isset($_POST['checkBox'])) {
  $privateKey = "6Lcf_U4UAAAAAEKEzwM3_3B8FOQ0rGWwEmItkmmF";
  $response = $_POST['g-recaptcha-response'];
  $remoteip = $_SERVER['REMOTE_ADDR'];
  $url = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$privateKey&response=$response&remoteip=$remoteip");

  $result = json_decode($url, true);

  if($result->success == true) {
$fname = $mname = $lname = $email = $pno = $addr1 =$addr2 = $city = $state = $pincode = $query = $ip= "";
  $fname = test_input($_POST["first_name"]);
  $mname = test_input($_POST["middle_name"]);
   $lname = test_input($_POST["last_name"]);
   $email = test_input($_POST["email"]);
   $pno = test_input($_POST["phone_no"]);
   $addr1 = test_input($_POST["address1"]);
   $addr2 = test_input($_POST["address2"]);
   $city = test_input($_POST["city"]);
   $state = test_input($_POST["f_state"]);
    $pincode = test_input($_POST["pincode"]);
    $query = test_input($_POST["comment"]);
        } else {
      echo "reCaptcha failed, please try again...";
    }
  }
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
  $ip = isset($_SERVER['HTTP_CLIENT_IP'])?$_SERVER['HTTP_CLIENT_IP']:isset($_SERVER['HTTP_X_FORWARDED_FOR'])?$_SERVER['HTTP_X_FORWARDED_FOR']:$_SERVER['REMOTE_ADDR'];
extract($_POST);
$sql = "INSERT into tes_contact_form
(first_name,middle_name,last_name,email,phone_no,address1,address2,city,state,pincode,comment,date,ipaddress) VALUES
('" . $fname . "','" . $mname . "','" . $lname . "','" . $email . "','" . $pno . "','" . $addr1 . "','" . $addr2 . "','" . $city . "','" . $state . "','" . $pincode . "','" . $query . "','" . date('Y-m-d H:i:s') . "','" . $ip . "')";
$result = mysqli_query($conn,$sql);
//if value inserted successyully disply success message
if (!$result)
{
echo "Error: " . $sql . "<br>" . mysqli_error($conn);}
 else {
         echo "Thank you for submitting the form. We will contact you shortly. Please wait while we redirect you to the home page:";
  echo "<script>setTimeout(\"location.href = '../home.html';\",3500);</script>";
}

?>
