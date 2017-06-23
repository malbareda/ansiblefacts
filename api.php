<?php
 
// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
//$input = file_get_contents('php://input');
$jsoncon = json_decode(file_get_contents('php://input'));
 
// connect to the mysql database
$servername = "fdb17.runhosting.com";
$username = "2346231_db";
$password = "password1";


$link = mysqli_connect($servername, $username, $password);
mysqli_set_charset($link,'utf8');
$db  = mysqli_select_db($link,"2346231_db"); 
 
// retrieve the table and key from the path
$table = preg_replace('/[^a-z0-9_]+/i','',array_shift($request));
$key = array_shift($request)+0;

/*
// escape the columns and values from the input object
$columns = preg_replace('/[^a-z0-9_]+/i','',array_keys($input));
$values = array_map(function ($value) use ($link) {
  if ($value===null) return null;
  return mysqli_real_escape_string($link,(string)$value);
},array_values($input));
*/
 
// build the SET part of the SQL command
$set = '';
for ($i=0;$i<count($columns);$i++) {
  $set.=($i>0?',':'').'`'.$columns[$i].'`=';
  $set.=($values[$i]===null?'NULL':'"'.$values[$i].'"');
}
 
// create SQL based on HTTP method
switch ($method) {
  case 'GET':
    echo $table;
    echo $key;
    //$sql = "select * from `$table`".($key?" WHERE id=$key":''); break;
  case 'PUT':
    $sql = "update `$table` set $set where id=$key"; break;
  case 'POST':
  
/*
        $fp = fopen('lidn.txt', 'w');
        fwrite($fp, $jsoncon);
        fclose($fp);

*/
                                    if (count($jsoncon)) {
                       $ipv4=$jsoncon->ansible_facts->ansible_default_ipv4->network;

                            $data = $jsoncon->ansible_facts;
                            
                            $nodename=$data->ansible_nodename;
                            
                            echo "el nodename es";
                            echo $nodename;
                            
                            $architecture=$data->ansible_architecture;
                            $address=$data->ansible_default_ipv4->address;
                            $macaddress=$data->ansible_default_ipv4->macaddress;
                            $ip6address=$data->ansible_all_ipv6_addresses[0];
                            $subnet=$data->ansible_default_ipv4->network;
                            $bios_version=$data->ansible_bios_version;
                            //$data->ansible_cmdline->root
                            $sda_model=$data->ansible_devices->sda->model;
                            $sda_size=$data->ansible_devices->sda->size;
                            $sr0_model=$data->ansible_devices->sr0->model;
                            $sr0_size=$data->ansible_devices->sr0->size;
                            $processor_cores=$data->ansible_processor_cores;
                            $processor=$data->ansible_processor[0].$data->ansible_processor[1];
                            $distro=$data->ansible_distribution;
                            $distro_release=$data->ansible_distribution_release;
                            $distro_version=$data->ansible_distribution_version;
                            $date=$data->ansible_date_time->date;
                            $time=$data->ansible_date_time->time;
                            $hour=$data->ansible_date_time->hour;
                            $weekday=$data->ansible_date_time->weekday;
                            
                            $sql = "INSERT INTO JSON (nodename, architecture, subnet, address, ip6address, macaddress, bios_version, sda_model, sda_size, sr0_model, sr0_size, processor_cores, processor, distro, distro_release, distro_version, date, time, hour, weekday)
                            VALUES ('$nodename', '$architecture', '$subnet', '$address', '$ip6address', '$macaddress', '$bios_version', '$sda_model', '$sda_size', '$sr0_model', '$sr0_size', '$processor_cores', '$processor', '$distro', '$distro_release', '$distro_version', '$date', '$time', '$hour', '$weekday')";
                            if (mysqli_query($link, $sql)) {
                                    echo "New record created successfully";
                                } else {
                                    echo "Error: " . $sql . "<br>" . mysqli_error($link);
                                }
                        
                    }
             
             
             
             
             
                
                if (mysqli_query($link, $sql)) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($link);
                }
                
                mysqli_close($link);

  case 'DELETE':
    $sql = "delete `$table` where id=$key"; break;
}

/*
// excecute SQL statement
$result = mysqli_query($link,$sql);
 
// die if SQL statement failed
if (!$result) {
  http_response_code(404);
  die(mysqli_error());
}
 
// print results, insert id or affected row count
if ($method == 'GET') {
  if (!$key) echo '[';
  for ($i=0;$i<mysqli_num_rows($result);$i++) {
    echo ($i>0?',':'').json_encode(mysqli_fetch_object($result));
  }
  if (!$key) echo ']';
} elseif ($method == 'POST') {
  echo mysqli_insert_id($link);
} else {
  echo mysqli_affected_rows($link);
}
 
// close mysql connection
mysqli_close($link);*/