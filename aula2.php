<?php

switch($id)
{
        case "stallman":
                $subnet="192.168.11.0";
                break;
        case "ada":
                $subnet="192.168.12.0";
                break;
        case "turing":
                $subnet="192.168.13.0";
                break;
}



echo'<div style="width:90%; margin:auto;">';

echo'<h1  id="',$id,'">',strtoupper($id)," ",$subnet,'</h1>';


echo'<h3 class="center-align">SUMMARY</h2>';


 echo '<div class="container"><table class="bordered highlight responsive-table" >';
                            // Encabezado
                            echo "<tr>";
                            echo "<th>Device</th>";
                            echo "<th>Model</th>";
                            echo "<th>#Units</th>";
                            echo "</tr>";      
                            
                            
$sql = "select distinct processor, count(processor) as CountOf from JSON WHERE subnet='$subnet' group by processor";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>Processor</td> <td>" . $row["processor"]. "</td> <td>" . $row["CountOf"]. "</td>";
    }

$sql = "select distinct sda_model, count(sda_model) as CountOf from JSON WHERE subnet='$subnet' group by sda_model";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>Disk</td> <td> " . $row["sda_model"]. " </td> <td> " . $row["CountOf"]. " </td>";
    }
    
$sql = "select distinct sr0_model, count(sr0_model) as CountOf from JSON WHERE subnet='$subnet' group by sr0_model";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>RAM</td> <td> " . $row["sr0_model"]. " </td> <td> " . $row["CountOf"]. " </td>";
    }    
echo"</table></div><hr>";
$sql = "SELECT num, nodename, address, architecture, ip6address, macaddress, bios_version, sda_model, sda_size, sr0_model, sr0_size, processor_cores, processor, distro, distro_release, distro_version, date, time, subnet FROM JSON WHERE subnet='$subnet';";
$result = mysqli_query($conn, $sql);
echo $last["nodename"];
if (mysqli_num_rows($result) > 0) {



        echo "<div>";
                      // Tabla
                      echo '<table class="bordered highlight responsive-table" >';
                            // Encabezado
                            echo "<tr>";
                            echo "<th>Node Name</th>";
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
                       $ipv4= $last["subnet"];
                       if( strcmp($ipv4,$subnet) == 0 ){
                            // Columna
                            echo "<tr>";
                            $data = $jsoncon->ansible_facts;
                            
                            $nodename=$last["nodename"];
                            echo '<td><a href="equip.php?id=',$nodename,'">',$nodename,'</a></td>';
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
                      }
                
                        // Close the table
                        
}
}                    
             
        echo "</table>";    
        echo "</div>";
        echo "</div>";

?>