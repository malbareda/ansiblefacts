<?php
$servername = "fdb17.runhosting.com";
$username = "2346231_db";
$password = "password1";

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";

$db  = mysqli_select_db($conn,"2346231_db");


$files = glob('jsons/*.{json}', GLOB_BRACE);
            foreach($files as $file) {
                    $json = file_get_contents($file);
                    $jsoncon =  json_decode($json);
                    if (count($jsoncon)) {
                       $ipv4=$jsoncon->ansible_facts->ansible_default_ipv4->network;

                            $data = $jsoncon->ansible_facts;
                            
                            $nodename=$data->ansible_nodename;
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
                            VALUES ('$nodename', '$architecture', '$subnet', '$address', '$macaddress', '$ip6address', '$bios_version', '$sda_model', '$sda_size', '$sr0_model', '$sr0_size', '$processor_cores', '$processor', '$distro', '$distro_release', '$distro_version', '$date', '$time', '$hour', '$weekday')";
                            if (mysqli_query($conn, $sql)) {
                                    echo "New record created successfully";
                                } else {
                                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                }
                        
                    }
             }
             
             
             
             

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);



?>