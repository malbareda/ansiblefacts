<?php

//AQUI TIRARIAMOS EL SCRIPT PARA COGER LOS ANSIBLE FACTS
//$output = shell_exec('ls jsons -la');
//echo "<pre>$output</pre>";
//$id=$_GET['id'];

$servername = "fdb17.runhosting.com";
$username = "2346231_db";
$password = "password1";


// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
 //echo "Connected successfully";

$db  = mysqli_select_db($conn,"2346231_db");

?>





<html>
<head>
<link rel="stylesheet" type="text/css" media="all" href="materialize/css/materialize.min.css">
<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="materialize/js/materialize.min.js" type="text/javascript"></script>

<style>

        .tabs .tab a{
            color:#eee;
        }

        .tabs .tab a:hover {
            background-color:#eee;
            color:#000;
        } /*Text color on hover*/

        .tabs .tab a.active {
            background-color:#4db6ac ;
            color:#eee;
        } /*Background and text color when a tab is active*/

        .tabs .indicator {
            background-color:#64ffda;
        } /*Color of underline*/
        
        </style>
</head>
<body>
      <nav class="top-nav teal">
        <div class="container">
          <div class="nav-wrapper"><a class="page-title">ElPuig Glaze</a></div>
        </div>
      </nav>
        <div class="row">
    <div class="col s12 teal white-text">
    <div class="indicator white" style="z-index:1">
      <ul class="tabs teal">
        <li class="tab col s3 white-text"><a href="#test1">Stallman</a></li>
        <li class="tab col s3 white-text"><a class="active" href="#test2">Ada</a></li>
        <li class="tab col s3 white-text"><a href="#test3">Torvalds</a></li>
        <li class="tab col s3 white-text"><a href="#test4">Turing</a></li>
      </ul>
      </div>
    </div>
    <div id="test1" class="col s12"><?php $id="stallman"; include 'aula2.php';?></div>
    <div id="test2" class="col s12"><?php $id="ada"; include 'aula2.php';?></div>
    <div id="test3" class="col s12"><?php $id="torvalds"; include 'aula2.php';?></div>
    <div id="test4" class="col s12"><?php $id="turing"; include 'aula2.php';?></div>
  </div>



</body>
</html>