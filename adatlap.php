<?php

$connect = mysqli_connect("localhost", "root", "", "testingketto");

//echo "<pre>";
//var_dump($_GET);

$nev = filter_input(INPUT_GET, "nev");


$sql = "SELECT * FROM tbl_student WHERE student_name = ?";

$stmt = mysqli_stmt_init($connect);

   if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "Valami nem stimmel még"; 

    }else{
    mysqli_stmt_bind_param($stmt, "s", $nev);
    mysqli_stmt_execute($stmt);
    $eredmeny = mysqli_stmt_get_result($stmt); 


    while ($sor = mysqli_fetch_assoc($eredmeny)) { 
          echo "Név: " . $sor['student_name'];
          echo "<br>";
          echo  "Telefon: " .$sor['student_phone'];
      }
      }

?>