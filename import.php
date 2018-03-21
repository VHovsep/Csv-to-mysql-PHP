<?php
include_once("db.php");
if(isset($_POST['import_data'])){
$file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$file_mimes)){
if(is_uploaded_file($_FILES['file']['tmp_name'])){
$csv_file = fopen($_FILES['file']['tmp_name'], 'r');
$lines = array();
$count=0;
$arrayLines = array();
while(!feof($csv_file)){
    array_push($lines,fgets($csv_file));
    for($i=0;$i<count($lines);$i++){
      for ($j=0; $j <count($lines); $j++) {
            if ($lines[$i]==$lines[$j]) {
                $count++;
            }
            if ($count>1) {
                    $lines[$j]='';
                $count=$count-1;
            }
        }
        $count=0;
    }
}

    foreach ($lines as $line) {
        # code...
        $data = explode(",", $line);

$sql_query = "SELECT id, name, lastname FROM emp";
$resultset = mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));
if($data[1]!='') {
$mysql_insert = "INSERT INTO emp (name, lastname)VALUES('".$data[1]."', '".$data[2]."')";
mysqli_query($conn, $mysql_insert) or die("database error:". mysqli_error($conn));
 }
}
fclose($csv_file);
$import_status = '?import_status=success';
} else {
$import_status = '?import_status=error';
}
} else {
$import_status = '?import_status=invalid_file';
}
}
header("Location: index.php".$import_status);
?>