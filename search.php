<?php

$id=$_GET['search'];
$servername = "fdb17.runhosting.com";
$username = "2346231_db";
$password = "password1";

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$db  = mysqli_select_db($conn,"2346231_db");


$sql = "SELECT num, nodename, address, architecture, ip6address, macaddress, bios_version, sda_model, sda_size, sr0_model, sr0_size, processor_cores, processor, distro, distro_release, distro_version, date, time FROM JSON WHERE macaddress='$id' ORDER BY num DESC LIMIT 1;";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
        $last = mysqli_fetch_assoc($result);
}
$sql2 = "SELECT num, nodename, address, macaddress, bios_version, sda_model, sda_size, sr0_model, sr0_size, processor_cores, processor, distro, distro_release, distro_version, date, time FROM JSON WHERE macaddress='$id' ORDER BY num LIMIT 1;";
$result2 = mysqli_query($conn, $sql2);

if (mysqli_num_rows($result2) > 0) {
        $first = mysqli_fetch_assoc($result2);
}

?>
<html>
<head>
<link rel="stylesheet" type="text/css" media="all" href="materialize/css/materialize.min.css">
<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="materialize/js/materialize.min.js" type="text/javascript"></script>
<script src="materialize/js/jquery.hottie.js" type="text/javascript"></script>

</head>

<body>

<div class="container" style="width:70%";>
<?php echo "<h2>",$id," </h2>";?>

  <ul class="collapsible" data-collapsible="expandable">
    <li>
      <div class="collapsible-header active"><i class="material-icons">language</i>Network</div>
      <div class="collapsible-body">  <?php echo "<p>IP Address: ". $last["address"]." <br>  MAC Address: " .$last["macaddress"]." <br> IPv6 Address: " .$last["ip6address"]."</p>" ?></div>
    </li>
    <li>
      <div class="collapsible-header active"><i class="material-icons">whatshot</i>MotherBoard</div>
      <div class="collapsible-body">  <?php echo "<p>Architecture: " .$last["architecture"]. "  <br> BIOS Version: " .$last["bios_version"]."</p>" ?></div>
    </li>
    <li>
      <div class="collapsible-header active"><i class="material-icons">settings</i>CPU</div>
      <div class="collapsible-body"><?php echo "<p>Cores: ". $last["processor_cores"]." <br>  Processor: " .$last["processor"]."</p>" ?></div>
    </li>
    <li>
      <div class="collapsible-header active"><i class="material-icons">memory</i>Disk</div>
      <div class="collapsible-body"><?php echo "<p>Model: ". $last["sda_model"]." <br>  Size: " .$last["sda_size"]."</p>" ?></div>
    </li>
    <li>
      <div class="collapsible-header active"><i class="material-icons">dns</i>RAM</div>
      <div class="collapsible-body"><?php echo "<p>Model: ". $last["sr0_model"]." <br>  Size: " .$last["sr0_size"]."</p>" ?></div>
    </li>
    <li>
      <div class="collapsible-header active"><i class="material-icons">build</i>Operating System</div>
      <div class="collapsible-body">  <?php echo "<p>Distribution: ". $last["distro"]." <br>  Release: " .$last["distro_release"]." <br>  Version: " .$last["distro_version"]."</p>" ?></div>
    </li>
    <li>
      <div class="collapsible-header active"><i class="material-icons">timer</i>Timestamps</div>
      <div class="collapsible-body">  <?php echo "<p>First Check: ". $first["date"]." ". $first["time"]." <br>  Last Check: " .$last["date"]." ". $last["time"]." </p>"; 
      
      echo '<div style="overflow-x:auto;">';
      echo '<table id="calor" class="bordered responsive-table" >';
               // Encabezado
                            echo "<tr>";
                            echo "<th> </th>";
                            echo "<th>Monday</th>";
                            echo "<th>Tuesday</th>";
                            echo "<th>Wednesday</th>";
                            echo "<th>Thursday</th>";
                            echo "<th>Friday</th>";
                            echo "<th>Saturday</th>";
                            echo "<th>Sunday</th>";
                            echo "</tr>";            
      
                            echo "<tr>"; 
                            echo "<td><b>Morning</b></td>";
                            $sql="SELECT count(*) as total from JSON WHERE macaddress='$id' AND weekday='Monday' AND hour<15";
                            $result=mysqli_query($conn, $sql);
                            $data=mysqli_fetch_assoc($result);
                            echo "<td>",$data['total'],"</td>";
                            
                            $sql="SELECT count(*) as total from JSON WHERE macaddress='$id' AND weekday='Tuesday' AND hour<15";
                            $result=mysqli_query($conn, $sql);
                            $data=mysqli_fetch_assoc($result);
                            echo "<td>",$data['total'],"</td>";
                            $sql="SELECT count(*) as total from JSON WHERE macaddress='$id' AND weekday='Wednesday' AND hour<15";
                            $result=mysqli_query($conn, $sql);
                            $data=mysqli_fetch_assoc($result);
                            echo "<td>",$data['total'],"</td>";
                            $sql="SELECT count(*) as total from JSON WHERE macaddress='$id' AND weekday='Thursday' AND hour<15";
                            $result=mysqli_query($conn, $sql);
                            $data=mysqli_fetch_assoc($result);
                            echo "<td>",$data['total'],"</td>";
                            $sql="SELECT count(*) as total from JSON WHERE macaddress='$id' AND weekday='Friday' AND hour<15";
                            $result=mysqli_query($conn, $sql);
                            $data=mysqli_fetch_assoc($result);
                            echo "<td>",$data['total'],"</td>";
                            $sql="SELECT count(*) as total from JSON WHERE macaddress='$id' AND weekday='Saturday' AND hour<15";
                            $result=mysqli_query($conn, $sql);
                            $data=mysqli_fetch_assoc($result);
                            echo "<td>",$data['total'],"</td>";
                            $sql="SELECT count(*) as total from JSON WHERE macaddress='$id' AND weekday='Sunday' AND hour<15";
                            $result=mysqli_query($conn, $sql);
                            $data=mysqli_fetch_assoc($result);
                            echo "<td>",$data['total'],"</td>";
                            
                            echo "</tr>"; 
                            
                            
                            echo "<tr>"; 
                            echo "<td><b>Evening</b></td>";
                            $sql="SELECT count(*) as total from JSON WHERE macaddress='$id' AND weekday='Monday' AND hour>=15";
                            $result=mysqli_query($conn, $sql);
                            $data=mysqli_fetch_assoc($result);
                            echo "<td>",$data['total'],"</td>";
                            
                            $sql="SELECT count(*) as total from JSON WHERE macaddress='$id' AND weekday='Tuesday' AND hour>=15";
                            $result=mysqli_query($conn, $sql);
                            $data=mysqli_fetch_assoc($result);
                            echo "<td>",$data['total'],"</td>";
                            $sql="SELECT count(*) as total from JSON WHERE macaddress='$id' AND weekday='Wednesday' AND hour>=15";
                            $result=mysqli_query($conn, $sql);
                            $data=mysqli_fetch_assoc($result);
                            echo "<td>",$data['total'],"</td>";
                            $sql="SELECT count(*) as total from JSON WHERE macaddress='$id' AND weekday='Thursday' AND hour>=15";
                            $result=mysqli_query($conn, $sql);
                            $data=mysqli_fetch_assoc($result);
                            echo "<td>",$data['total'],"</td>";
                            $sql="SELECT count(*) as total from JSON WHERE macaddress='$id' AND weekday='Friday' AND hour>=15";
                            $result=mysqli_query($conn, $sql);
                            $data=mysqli_fetch_assoc($result);
                            echo "<td>",$data['total'],"</td>";
                            $sql="SELECT count(*) as total from JSON WHERE macaddress='$id' AND weekday='Saturday' AND hour>=15";
                            $result=mysqli_query($conn, $sql);
                            $data=mysqli_fetch_assoc($result);
                            echo "<td>",$data['total'],"</td>";
                            $sql="SELECT count(*) as total from JSON WHERE macaddress='$id' AND weekday='Sunday' AND hour>=15";
                            $result=mysqli_query($conn, $sql);
                            $data=mysqli_fetch_assoc($result);
                            echo "<td>",$data['total'],"</td>";
                            echo "</tr>"; 
                            echo "</table></div>";
      
      
      ?>
      
      

    
    
      <script>
                      $("#calor td").hottie({
                    colorArray : [ 
                        "#F8696B", // highest value
                        "#FFFFFF",
                        "#63BE7B"  // lowest value
                        // add as many colors as you like...
                    ]
                });
      </script>
      
      
      


      
      
      </div>
    </li>
    
    
    
    <li>
      <div class="collapsible-header active"><i class="material-icons">history</i>History</div>
      <div class="collapsible-body">  
      
      
      <?php 
       

$sql = "SELECT num, nodename, address, architecture, ip6address, macaddress, bios_version, sda_model, sda_size, sr0_model, sr0_size, processor_cores, processor, distro, distro_release, distro_version, date, time, subnet FROM JSON WHERE macaddress='$id';";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {


        echo '<div style="overflow-x:auto;">';
                      // Tabla
                      echo '<table class="bordered highlight responsive-table" >';
                            // Encabezado
                            echo "<tr>";
                            echo "<th>Checkpoint time</th>";
                            echo "<th>Nodename</th>";
                            echo "<th>IP Address</th>";
                            echo "<th>Mac Address</th>";
                            echo "<th>Bios Version</th>";
                            echo "<th>SDA Model</th>";
                            echo "<th>SDA Size</th>";
                            echo "<th>SR0 Model</th>";
                            echo "<th>SR0 Size</th>";
                            echo "<th>Processor Cores</th>";
                            echo "<th>Processors</th>";
                            echo "<th>Operating System</th>";
                            
                            echo "</tr>";            
        while($last = mysqli_fetch_assoc($result)) {

                            // Columna
                            echo "<tr>";
                            

                            echo '<td><a href="checkpoint.php?id=',$last["num"],'">',$last[date]," ",$last[time],'</a></td>';
                            echo "<td>",$last["nodename"],"</td>";
                            echo "<td>",$last["address"],"</td>";
                            echo "<td>",$last["macaddress"],"</td>";
                            echo "<td>",$last["bios_version"],"</td>";
                            //echo "<td>",$data->ansible_cmdline->root,"</td>";
                            echo "<td>",$last["sda_model"],"</td>";
                            echo "<td>",$last["sda_size"],"</td>";
                            echo "<td>",$last["sr0_model"],"</td>";
                            echo "<td>",$last["sr0_size"],"</td>";
                            echo "<td>",$last["processor_cores"],"</td>";
                            echo "<td>",$last["processor"],"</td>";
                            //Ejemplo de juntar varias informaciones
                            echo "<td>",$last["distro"]," ",$last["distro_release"]," ",$last["distro_version"],"</td>";
                            
                            echo "</tr>";
                      
                
                        // Close the table
                        
}
}                    
             
        echo "</table></div>";   
      ?>
      
      
      
      </div>
    </li>
    
    
    
  </ul>
  
  



</body>
</html>