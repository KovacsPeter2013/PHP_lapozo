<?php
$connect = mysqli_connect("localhost", "root", "", "testingketto");
$record_per_page = 5;
$page = '';
if(isset($_GET["page"]))
{
 $page = $_GET["page"];
}
else
{
 $page = 1;
}

$start_from = ($page-1)*$record_per_page;

$query = "SELECT * FROM tbl_student order by student_id DESC LIMIT $start_from, $record_per_page";
$result = mysqli_query($connect, $query);

?>

<!DOCTYPE html>
<html>
 <head>
  <title>PHP lapozó</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <style>
  a {
   padding:8px 16px;
   border:1px solid #ccc;
   color:#333;
   font-weight:bold;
  }
  </style>
 </head>
 <body>
  <br /><br />
  <div class="container">
   <h3 align="center">PHP Lapozó</h3><br />
   <div class="table-responsive">
    <table class="table table-bordered">
     <tr>
      <td>Név</td>
      <td>Telefon</td>
     </tr>
     <?php
     while($row = mysqli_fetch_array($result))
     {
     ?>
     <tr>
      <td><a href="adatlap.php?nev=<?php echo $row["student_name"]; ?>"><?php echo $row["student_name"]; ?></a></td>
      <td><?php echo $row["student_phone"]; ?></td>
     </tr>
     <?php
     }
     ?>
    </table>
    <div align="center">
    <br />
    <?php
    $page_query = "SELECT * FROM tbl_student ORDER BY student_id DESC";
    $page_result = mysqli_query($connect, $page_query);
    $total_records = mysqli_num_rows($page_result);
    $total_pages = ceil($total_records/$record_per_page);
    $start_loop = $page;
    $difference = $total_pages - $page;
    if($difference <= 5)
    {
     $start_loop = $total_pages - 5;
    }
    $end_loop = $start_loop + 4;
    if($page > 1)
    {
     echo "<a href='index.php?page=1'>Első</a>";
     echo "<a href='index.php?page=".($page - 1)."'><<</a>";
    }
    for($i=$start_loop; $i<=$end_loop; $i++)
    {     
     echo "<a href='index.php?page=".$i."'>".$i."</a>";
    }
    if($page <= $end_loop)
    {
     echo "<a href='index.php?page=".($page + 1)."'>>></a>";
     echo "<a href='index.php?page=".$total_pages."'>Utolsó</a>";
    }
    
    
    ?>
    </div>
    <br /><br />
   </div>
  </div>
 </body>
</html>