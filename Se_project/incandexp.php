<?php
include("function/alert.php");
include("db/dbconnect.php");
?>

<?php
//index.php

$message = '';

if(isset($_POST["upload"]))
{
 if($_FILES['product_file']['name'])
 {
  $filename = explode(".", $_FILES['product_file']['name']);
  if(end($filename) == "csv")
  {
   $handle = fopen($_FILES['product_file']['tmp_name'], "r");
   while(($data = fgetcsv($handle)) !== FALSE)
   {
    //$id = $data[0];
    $income = $data[0];
    $expnses = $data[1];
    $month = $data[2];
    $name = $data[3];
    $house_number = $data[4];
    
    $prevQuery = "SELECT id FROM incomeandexpenses WHERE name = '".$data[3]."'";
    $prevResult = $connect->query($prevQuery);
    
    if($prevResult->num_rows > 0){
                    // Update member data in the database
     $connect->query("UPDATE incomeandexpenses SET "
             . "income = '".$income."', "
             . "expnses = '".$expnses."', "
             . "month = '".$month."', "
             . "timestamp = CURRENT_TIMESTAMP "
             . "WHERE name = '".$name."'");
                }else{
                    // Insert member data in the database
      $connect->query("INSERT INTO incomeandexpenses (income, expnses, month, , timestamp) "
              . "VALUES ('".$income."', '".$expnses."', '".$month."', CURRENT_TIMESTAMP)");
                }
    }
    
   fclose($handle);
   header("location: incandexp.php?updation=1");
  }
  else
  {
   $message = '<label class="text-danger">Please Select CSV File only</label>';
  }
 }
 else
 {
  $message = '<label class="text-danger">Please Select File</label>';
 }
}

if(isset($_GET["updation"]))
{
 $message = '<label class="text-success">Product Updation Done</label>';
   echo '      <script>
       setTimeout(function() {
        swal({
            title: "เสร็จสิ้น",
            text: "เข้าสู่ระบบเรียบร้อยแล้ว",
            type: "success"
        }, function() {
            window.location = "/Se_project/incandexp.php"; //หน้าที่ต้องการให้กระโดดไป
        });
    }, 1000);
</script>';
}

$query = "SELECT * FROM incomeandexpenses";
$result = mysqli_query($connect, $query);
?>
<!DOCTYPE html>
<html>
 <head>
  <title>รายรับ - รายจ่าย</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  
           <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  
  
  

  
  
 </head>
 <body>
  <br />
  <div class="container">
   <h2 align="center">บันทึก & อัพเดท รายรับ-รายจ่าย </a></h2>
   <br />
   <form method="post" enctype='multipart/form-data'>
    <p><label>ใส่ไฟล์ Csv เพื่อเพิ่มข้อมูลเข้าฐานข้อมูล)</label>
    <input type="file" name="product_file" /></p>
    <br />
    <input type="submit" name="upload" class="btn btn-info" value="Upload" />
   </form>
   
   
   <br />
   <?php echo $message; ?>
   <h3 align="center">ฐานข้อมูล รายรับ-รายจ่าย</h3>
   <br />
   
   
   
       
                  
                <div class="col-md-3">  
                     <input type="text" name="from_date" id="from_date" class="form-control" placeholder="ก่อนวันที่" />  
                </div>  
                <div class="col-md-3">  
                     <input type="text" name="to_date" id="to_date" class="form-control" placeholder="ถึงวันที่" />  
                </div>  
                <div class="col-md-3">  
                     <input type="button" name="filterdate" id="filterdate" value="ค้นหา" class="btn btn-success" />  
                </div>  
   
                 <label  class="input-group-prepend" style="padding:5px; float:right;"><span class="input-group-text">ค้นหา</span>
                  <input type="text" name="filter" placeholder="ค้นหาข้อมูล....." id="filter"></label>
              
                  
                  <br>
                  <br>
                  <br>
             

                            
                            
                            <!--Nav Button  -->
                            <nav>                                                                                                
                                <ul class="nav nav-tabs" id="nav-tab" role="tablist">
  <li class="nav-item">
    <a class="nav-item nav-link active" id="cid001-tab" data-toggle="tab" href="#alldata" role="tab" aria-controls="cid001" aria-selected="true">ข้อมูลทั้งหมด</a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">เดือน</a>
    <ul class="dropdown-menu">
      <li><a class="nav-item nav-link" id="cid001-tab" data-toggle="tab" href="#month_1" role="tab" aria-controls="cid001" aria-selected="true">มกราคม</a></li>
      <li><a class="nav-item nav-link" id="cid001-tab" data-toggle="tab" href="#month_2" role="tab" aria-controls="cid001" aria-selected="true">กุมภาพันธ์</a></li>
  <li><a class="nav-item nav-link" id="cid001-tab" data-toggle="tab" href="#month_3" role="tab" aria-controls="cid001" aria-selected="true">มีนาคม</a></li>
   <li><a class="nav-item nav-link" id="cid001-tab" data-toggle="tab" href="#month_4" role="tab" aria-controls="cid001" aria-selected="true">เมษายน</a> </li>
   <li><a class="nav-item nav-link" id="cid001-tab" data-toggle="tab" href="#month_5" role="tab" aria-controls="cid001" aria-selected="true">พฤษภาคม</a></li>
   <li><a class="nav-item nav-link" id="cid001-tab" data-toggle="tab" href="#month_6" role="tab" aria-controls="cid001" aria-selected="true">มิถุนายน</a></li>
   <li><a class="nav-item nav-link" id="cid001-tab" data-toggle="tab" href="#month_7" role="tab" aria-controls="cid001" aria-selected="true">กรกฎาคม</a></li>
   <li><a class="nav-item nav-link" id="cid001-tab" data-toggle="tab" href="#month_8" role="tab" aria-controls="cid001" aria-selected="true">สิงหาคม</a></li>
   <li><a class="nav-item nav-link" id="cid001-tab" data-toggle="tab" href="#month_9" role="tab" aria-controls="cid001" aria-selected="true">กันยายน</a></li>
   <li><a class="nav-item nav-link" id="cid001-tab" data-toggle="tab" href="#month_10" role="tab" aria-controls="cid001" aria-selected="true">ตุลาคม</a></li>
   <li><a class="nav-item nav-link" id="cid001-tab" data-toggle="tab" href="#month_11" role="tab" aria-controls="cid001" aria-selected="true">พฤศจิกายน</a></li>
   <li><a class="nav-item nav-link" id="cid001-tab" data-toggle="tab" href="#month_12" role="tab" aria-controls="cid001" aria-selected="true">ธันวาคม</a></li>
    </ul>
  </li>
  
   <li class="nav-item">
    <a class="nav-item nav-link" id="cid001-tab" data-toggle="tab" href="#status_1" role="tab" aria-controls="cid001" aria-selected="true">ชำระแล้ว</a>
  </li>
   <li class="nav-item">
    <a class="nav-item nav-link" id="cid001-tab" data-toggle="tab" href="#status_2" role="tab" aria-controls="cid001" aria-selected="true">ค้างชำระ</a>
  </li>
   <li class="nav-item">
    <a class="nav-item nav-link" id="cid001-tab" data-toggle="tab" href="#status_0" role="tab" aria-controls="cid001" aria-selected="true">รอการชำระ</a>
  </li>
     <a href="#add" role="button" class="btn btn-info" data-toggle="modal" style="padding:5px; float:right;"> เพิ่มข้อมูลเข้าสู่ระบบ </a>
</ul>
                          
                            </nav>
                            <!--End Nav Button  -->
                      
                      <!--  <div class="select-this d-flex">
                            <div class="featured">
                                <span>Short by: </span>
                            </div>
                            <form action="#">
                                <div class="select-itms">
                                    <select name="select" id="select1">
                                        <option value="">Featured</option>
                                        <option value="">Featured A</option>
                                        <option value="">Featured B</option>
                                        <option value="">Featured C</option>
                                    </select>
                                </div>
                            </form>
                        </div>  -->
              
                
      
                
 <div class="tab-content" id="order_table">
                    <!-- card one -->
                    
                      
                    
 <div class="tab-pane fade" id="alldata" role="tabpanel" aria-labelledby="alldata-tab">
               
               
               <br>
               <br>
 
    <table class="table table-bordered table-striped">
        
     
     <tr>
      <th>ไอดี</th>
      <th>รายรับ</th>
      <th>รายจ่าย</th>
      <th>เดือน</th>
      <th>เวลา</th>
      <th>สถานะ</th>
      <th>ปรับสถานะ</th>
      <th>การจัดการ</th>
     </tr>
     <?php
     
  
     while($row = mysqli_fetch_array($result))
     {
      $status = $row['status'];
      $id = $row['id'];
      
      echo '
      <tr>
      <td>'.$row["id"].'</td>
      <td>'.$row["income"].'</td>
       <td>'.$row["expenses"].'</td>
       <td>'.$row["month"].'</td>
       <td>'.$row["timestamp"].'</td>
      ';
       if($status == "1"){
           
          echo '<td><a href="#" class="btn btn-success" rel="facebox">ชำระแล้ว</a></td>';
          echo '<td><a href="status_incandexp.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
                                               
       }if($status == "2"){
           
          echo '<td><a href="#" class="btn btn-danger" rel="facebox">ค้างชำระ</a></td>';
          echo '<td><a href="status_incandexp.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
                                               
       }if($status == "0"){
          echo '<td><a href="#" class="btn btn-warning" rel="facebox">รอการชำระ</a></td>';
          echo '<td><a href="status_incandexp.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
          
         //  echo "?id='.$id.'";
          // widget/modelstatus.php?id='.$id.'
                                               
       }
        echo '<td>'
       . '<a href="edit_incandexp.php?id='.$id.'" class="btn btn-success" rel="facebox"><i class="glyphicon glyphicon-pencil"></i></a>'
               . ' <a href="bill_incandexp.php?id='.$id.'" class="btn btn-info" rel="facebox"><i class="glyphicon glyphicon-zoom-in"></i></a>'
               . ' <a href="function/delete_incandexp.php?id='.$id.'" class="btn btn-danger" rel="facebox"><i class="glyphicon glyphicon-trash"></i></a>'
               . '</td>';
       echo '</tr>';
                                        
     } // whil
     ?>

    </table>
       
  

            
               
           </div>
                    
 <div class="tab-pane fade" id="month_1" role="tabpanel" aria-labelledby="month_1-tab">
               
              
         <br>
         <br>
               
        
    <table class="table table-bordered table-striped">
        
       
     <tr>
      <th>ไอดี</th>
      <th>รายรับ</th>
      <th>รายจ่าย</th>
      <th>เดือน</th>
      <th>เวลา</th>
      <th>สถานะ</th>
      <th>ปรับสถานะ</th>
      <th>การจัดการ</th>
     </tr>
     <?php
     $query = mysqli_query($connect, "SELECT *FROM incomeandexpenses WHERE month='มกราคม' ORDER BY id DESC") or die(mysqli_error());
  
     while($row = mysqli_fetch_array($query))
     {
      $status = $row['status'];
      $id = $row['id'];
      
      echo '
      <tr>
      <td>'.$row["id"].'</td>
      <td>'.$row["income"].'</td>
       <td>'.$row["expenses"].'</td>
       <td>'.$row["month"].'</td>
       <td>'.$row["timestamp"].'</td>
      ';
       if($status == "1"){
           
          echo '<td><a href="#" class="btn btn-success" rel="facebox">ชำระแล้ว</a></td>';
          echo '<td><a href="status_incandexp.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
                                               
       }if($status == "2"){
           
          echo '<td><a href="#" class="btn btn-danger" rel="facebox">ค้างชำระ</a></td>';
          echo '<td><a href="status_incandexp.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
                                               
       }if($status == "0"){
          echo '<td><a href="#" class="btn btn-warning" rel="facebox">รอการชำระ</a></td>';
          echo '<td><a href="status_incandexp.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
          
         //  echo "?id='.$id.'";
          // widget/modelstatus.php?id='.$id.'
                                               
       }
        echo '<td>'
       . '<a href="edit_incandexp.php?id='.$id.'" class="btn btn-success" rel="facebox"><i class="glyphicon glyphicon-pencil"></i></a>'
               . ' <a href="bill_incandexp.php?id='.$id.'" class="btn btn-info" rel="facebox"><i class="glyphicon glyphicon-zoom-in"></i></a>'
               . ' <a href="function/delete_incandexp.php?id='.$id.'" class="btn btn-danger" rel="facebox"><i class="glyphicon glyphicon-trash"></i></a>'
               . '</td>';
       echo '</tr>';
                                        
     } // whil
     ?>

    </table>
       
  
            
               
           </div>
                
 <div class="tab-pane fade" id="month_2" role="tabpanel" aria-labelledby="month_1-tab">
    
         <br>
         <br>
         
        
    <table class="table table-bordered table-striped">
        
       
     <tr>
      <th>ไอดี</th>
      <th>รายรับ</th>
      <th>รายจ่าย</th>
      <th>เดือน</th>
      <th>เวลา</th>
      <th>สถานะ</th>
      <th>ปรับสถานะ</th>
      <th>การจัดการ</th>
     </tr>
     <?php
     $query = mysqli_query($connect, "SELECT *FROM incomeandexpenses WHERE month='กุมภาพันธ์' ORDER BY id DESC") or die(mysqli_error());
  
     while($row = mysqli_fetch_array($query))
     {
      $status = $row['status'];
      $id = $row['id'];
      
      echo '
      <tr>
      <td>'.$row["id"].'</td>
      <td>'.$row["income"].'</td>
       <td>'.$row["expenses"].'</td>
       <td>'.$row["month"].'</td>
       <td>'.$row["timestamp"].'</td>
      ';
       if($status == "1"){
           
          echo '<td><a href="#" class="btn btn-success" rel="facebox">ชำระแล้ว</a></td>';
          echo '<td><a href="status_incandexp.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
                                               
       }if($status == "2"){
           
          echo '<td><a href="#" class="btn btn-danger" rel="facebox">ค้างชำระ</a></td>';
          echo '<td><a href="status_incandexp.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
                                               
       }if($status == "0"){
          echo '<td><a href="#" class="btn btn-warning" rel="facebox">รอการชำระ</a></td>';
          echo '<td><a href="status_incandexp.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
          
         //  echo "?id='.$id.'";
          // widget/modelstatus.php?id='.$id.'
                                               
       }
        echo '<td>'
       . '<a href="edit_incandexp.php?id='.$id.'" class="btn btn-success" rel="facebox"><i class="glyphicon glyphicon-pencil"></i></a>'
               . ' <a href="bill_incandexp.php?id='.$id.'" class="btn btn-info" rel="facebox"><i class="glyphicon glyphicon-zoom-in"></i></a>'
               . ' <a href="function/delete_incandexp.php?id='.$id.'" class="btn btn-danger" rel="facebox"><i class="glyphicon glyphicon-trash"></i></a>'
               . '</td>';
       echo '</tr>';
                                        
     } // whil
     ?>

    </table>
       

               
           </div>
                    
 <div class="tab-pane fade" id="month_3" role="tabpanel" aria-labelledby="month_1-tab">
    
         <br>
         <br>
        
    <table class="table table-bordered table-striped">
        
       
     <tr>
      <th>ไอดี</th>
      <th>รายรับ</th>
      <th>รายจ่าย</th>
      <th>เดือน</th>
      <th>เวลา</th>
      <th>สถานะ</th>
      <th>ปรับสถานะ</th>
      <th>การจัดการ</th>
     </tr>
     <?php
     $query = mysqli_query($connect, "SELECT *FROM incomeandexpenses WHERE month='มีนาคม' ORDER BY id DESC") or die(mysqli_error());
  
     while($row = mysqli_fetch_array($query))
     {
      $status = $row['status'];
      $id = $row['id'];
      
      echo '
      <tr>
      <td>'.$row["id"].'</td>
      <td>'.$row["income"].'</td>
       <td>'.$row["expenses"].'</td>
       <td>'.$row["month"].'</td>
       <td>'.$row["timestamp"].'</td>
      ';
       if($status == "1"){
           
          echo '<td><a href="#" class="btn btn-success" rel="facebox">ชำระแล้ว</a></td>';
          echo '<td><a href="status_incandexp.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
                                               
       }if($status == "2"){
           
          echo '<td><a href="#" class="btn btn-danger" rel="facebox">ค้างชำระ</a></td>';
          echo '<td><a href="status_incandexp.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
                                               
       }if($status == "0"){
          echo '<td><a href="#" class="btn btn-warning" rel="facebox">รอการชำระ</a></td>';
          echo '<td><a href="status_incandexp.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
          
         //  echo "?id='.$id.'";
          // widget/modelstatus.php?id='.$id.'
                                               
       }
        echo '<td>'
       . '<a href="edit_incandexp.php?id='.$id.'" class="btn btn-success" rel="facebox"><i class="glyphicon glyphicon-pencil"></i></a>'
               . ' <a href="bill_incandexp.php?id='.$id.'" class="btn btn-info" rel="facebox"><i class="glyphicon glyphicon-zoom-in"></i></a>'
               . ' <a href="function/delete_incandexp.php?id='.$id.'" class="btn btn-danger" rel="facebox"><i class="glyphicon glyphicon-trash"></i></a>'
               . '</td>';
       echo '</tr>';
                                        
     } // whil
     ?>

    </table>
       

               
           </div>
                    
 <div class="tab-pane fade" id="month_4" role="tabpanel" aria-labelledby="month_1-tab">
    
         <br>
         <br>
        
    <table class="table table-bordered table-striped">
        
       
     <tr>
      <th>ไอดี</th>
      <th>รายรับ</th>
      <th>รายจ่าย</th>
      <th>เดือน</th>
      <th>เวลา</th>
      <th>สถานะ</th>
      <th>ปรับสถานะ</th>
      <th>การจัดการ</th>
     </tr>
     <?php
     $query = mysqli_query($connect, "SELECT *FROM incomeandexpenses WHERE month='เมษายน' ORDER BY id DESC") or die(mysqli_error());
  
     while($row = mysqli_fetch_array($query))
     {
      $status = $row['status'];
      $id = $row['id'];
      
      echo '
      <tr>
      <td>'.$row["id"].'</td>
      <td>'.$row["income"].'</td>
       <td>'.$row["expenses"].'</td>
       <td>'.$row["month"].'</td>
       <td>'.$row["timestamp"].'</td>
      ';
       if($status == "1"){
           
          echo '<td><a href="#" class="btn btn-success" rel="facebox">ชำระแล้ว</a></td>';
          echo '<td><a href="status_incandexp.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
                                               
       }if($status == "2"){
           
          echo '<td><a href="#" class="btn btn-danger" rel="facebox">ค้างชำระ</a></td>';
          echo '<td><a href="status_incandexp.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
                                               
       }if($status == "0"){
          echo '<td><a href="#" class="btn btn-warning" rel="facebox">รอการชำระ</a></td>';
          echo '<td><a href="status_incandexp.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
          
         //  echo "?id='.$id.'";
          // widget/modelstatus.php?id='.$id.'
                                               
       }
        echo '<td>'
       . '<a href="edit_incandexp.php?id='.$id.'" class="btn btn-success" rel="facebox"><i class="glyphicon glyphicon-pencil"></i></a>'
               . ' <a href="bill_incandexp.php?id='.$id.'" class="btn btn-info" rel="facebox"><i class="glyphicon glyphicon-zoom-in"></i></a>'
               . ' <a href="function/delete_incandexp.php?id='.$id.'" class="btn btn-danger" rel="facebox"><i class="glyphicon glyphicon-trash"></i></a>'
               . '</td>';
       echo '</tr>';
                                        
     } // whil
     ?>

    </table>
       

               
           </div>
                    
 <div class="tab-pane fade" id="month_5" role="tabpanel" aria-labelledby="month_1-tab">
    
         <br>
         <br>
        
    <table class="table table-bordered table-striped">
        
       
     <tr>
      <th>ไอดี</th>
      <th>รายรับ</th>
      <th>รายจ่าย</th>
      <th>เดือน</th>
      <th>เวลา</th>
      <th>สถานะ</th>
      <th>ปรับสถานะ</th>
      <th>การจัดการ</th>
     </tr>
     <?php
     $query = mysqli_query($connect, "SELECT *FROM incomeandexpenses WHERE month='พฤษภาคม' ORDER BY id DESC") or die(mysqli_error());
  
     while($row = mysqli_fetch_array($query))
     {
      $status = $row['status'];
      $id = $row['id'];
      
      echo '
      <tr>
      <td>'.$row["id"].'</td>
      <td>'.$row["income"].'</td>
       <td>'.$row["expenses"].'</td>
       <td>'.$row["month"].'</td>
       <td>'.$row["timestamp"].'</td>
      ';
       if($status == "1"){
           
          echo '<td><a href="#" class="btn btn-success" rel="facebox">ชำระแล้ว</a></td>';
          echo '<td><a href="status_incandexp.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
                                               
       }if($status == "2"){
           
          echo '<td><a href="#" class="btn btn-danger" rel="facebox">ค้างชำระ</a></td>';
          echo '<td><a href="status_incandexp.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
                                               
       }if($status == "0"){
          echo '<td><a href="#" class="btn btn-warning" rel="facebox">รอการชำระ</a></td>';
          echo '<td><a href="status_incandexp.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
          
         //  echo "?id='.$id.'";
          // widget/modelstatus.php?id='.$id.'
                                               
       }
        echo '<td>'
       . '<a href="edit_incandexp.php?id='.$id.'" class="btn btn-success" rel="facebox"><i class="glyphicon glyphicon-pencil"></i></a>'
               . ' <a href="bill_incandexp.php?id='.$id.'" class="btn btn-info" rel="facebox"><i class="glyphicon glyphicon-zoom-in"></i></a>'
               . ' <a href="function/delete_incandexp.php?id='.$id.'" class="btn btn-danger" rel="facebox"><i class="glyphicon glyphicon-trash"></i></a>'
               . '</td>';
       echo '</tr>';
                                        
     } // whil
     ?>

    </table>
       

               
           </div>
                    
 <div class="tab-pane fade" id="month_6" role="tabpanel" aria-labelledby="month_1-tab">
    
         <br>
         <br>
        
    <table class="table table-bordered table-striped">
        
       
     <tr>
      <th>ไอดี</th>
      <th>รายรับ</th>
      <th>รายจ่าย</th>
      <th>เดือน</th>
      <th>เวลา</th>
      <th>สถานะ</th>
      <th>ปรับสถานะ</th>
      <th>การจัดการ</th>
     </tr>
     <?php
     $query = mysqli_query($connect, "SELECT *FROM incomeandexpenses WHERE month='มิถุนายน' ORDER BY id DESC") or die(mysqli_error());
  
     while($row = mysqli_fetch_array($query))
     {
      $status = $row['status'];
      $id = $row['id'];
      
      echo '
      <tr>
      <td>'.$row["id"].'</td>
      <td>'.$row["income"].'</td>
       <td>'.$row["expenses"].'</td>
       <td>'.$row["month"].'</td>
       <td>'.$row["timestamp"].'</td>
      ';
       if($status == "1"){
           
          echo '<td><a href="#" class="btn btn-success" rel="facebox">ชำระแล้ว</a></td>';
          echo '<td><a href="status_incandexp.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
                                               
       }if($status == "2"){
           
          echo '<td><a href="#" class="btn btn-danger" rel="facebox">ค้างชำระ</a></td>';
          echo '<td><a href="status_incandexp.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
                                               
       }if($status == "0"){
          echo '<td><a href="#" class="btn btn-warning" rel="facebox">รอการชำระ</a></td>';
          echo '<td><a href="status_incandexp.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
          
         //  echo "?id='.$id.'";
          // widget/modelstatus.php?id='.$id.'
                                               
       }
        echo '<td>'
       . '<a href="edit_incandexp.php?id='.$id.'" class="btn btn-success" rel="facebox"><i class="glyphicon glyphicon-pencil"></i></a>'
               . ' <a href="bill_incandexp.php?id='.$id.'" class="btn btn-info" rel="facebox"><i class="glyphicon glyphicon-zoom-in"></i></a>'
               . ' <a href="function/delete_incandexp.php?id='.$id.'" class="btn btn-danger" rel="facebox"><i class="glyphicon glyphicon-trash"></i></a>'
               . '</td>';
       echo '</tr>';
                                        
     } // whil
     ?>

    </table>
       

               
           </div>
                    
 <div class="tab-pane fade" id="month_7" role="tabpanel" aria-labelledby="month_1-tab">
    
         <br>
         <br>
        
    <table class="table table-bordered table-striped">
        
       
     <tr>
      <th>ไอดี</th>
      <th>รายรับ</th>
      <th>รายจ่าย</th>
      <th>เดือน</th>
      <th>เวลา</th>
      <th>สถานะ</th>
      <th>ปรับสถานะ</th>
      <th>การจัดการ</th>
     </tr>
     <?php
     $query = mysqli_query($connect, "SELECT *FROM incomeandexpenses WHERE month='กรกฎาคม' ORDER BY id DESC") or die(mysqli_error());
  
     while($row = mysqli_fetch_array($query))
     {
      $status = $row['status'];
      $id = $row['id'];
      
      echo '
      <tr>
      <td>'.$row["id"].'</td>
      <td>'.$row["income"].'</td>
       <td>'.$row["expenses"].'</td>
       <td>'.$row["month"].'</td>
       <td>'.$row["timestamp"].'</td>
      ';
       if($status == "1"){
           
          echo '<td><a href="#" class="btn btn-success" rel="facebox">ชำระแล้ว</a></td>';
          echo '<td><a href="status_incandexp.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
                                               
       }if($status == "2"){
           
          echo '<td><a href="#" class="btn btn-danger" rel="facebox">ค้างชำระ</a></td>';
          echo '<td><a href="status_incandexp.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
                                               
       }if($status == "0"){
          echo '<td><a href="#" class="btn btn-warning" rel="facebox">รอการชำระ</a></td>';
          echo '<td><a href="status_incandexp.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
          
         //  echo "?id='.$id.'";
          // widget/modelstatus.php?id='.$id.'
                                               
       }
        echo '<td>'
       . '<a href="edit_incandexp.php?id='.$id.'" class="btn btn-success" rel="facebox"><i class="glyphicon glyphicon-pencil"></i></a>'
               . ' <a href="bill_incandexp.php?id='.$id.'" class="btn btn-info" rel="facebox"><i class="glyphicon glyphicon-zoom-in"></i></a>'
               . ' <a href="function/delete_incandexp.php?id='.$id.'" class="btn btn-danger" rel="facebox"><i class="glyphicon glyphicon-trash"></i></a>'
               . '</td>';
       echo '</tr>';
                                        
     } // whil
     ?>

    </table>
       

               
           </div>
                    
 <div class="tab-pane fade" id="month_8" role="tabpanel" aria-labelledby="month_1-tab">
    
         <br>
         <br>
        
    <table class="table table-bordered table-striped">
        
       
     <tr>
      <th>ไอดี</th>
      <th>รายรับ</th>
      <th>รายจ่าย</th>
      <th>เดือน</th>
      <th>เวลา</th>
      <th>สถานะ</th>
      <th>ปรับสถานะ</th>
      <th>การจัดการ</th>
     </tr>
     <?php
     $query = mysqli_query($connect, "SELECT *FROM incomeandexpenses WHERE month='สิงหาคม' ORDER BY id DESC") or die(mysqli_error());
  
     while($row = mysqli_fetch_array($query))
     {
      $status = $row['status'];
      $id = $row['id'];
      
      echo '
      <tr>
      <td>'.$row["id"].'</td>
      <td>'.$row["income"].'</td>
       <td>'.$row["expenses"].'</td>
       <td>'.$row["month"].'</td>
       <td>'.$row["timestamp"].'</td>
      ';
       if($status == "1"){
           
          echo '<td><a href="#" class="btn btn-success" rel="facebox">ชำระแล้ว</a></td>';
          echo '<td><a href="status_incandexp.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
                                               
       }if($status == "2"){
           
          echo '<td><a href="#" class="btn btn-danger" rel="facebox">ค้างชำระ</a></td>';
          echo '<td><a href="status_incandexp.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
                                               
       }if($status == "0"){
          echo '<td><a href="#" class="btn btn-warning" rel="facebox">รอการชำระ</a></td>';
          echo '<td><a href="status_incandexp.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
          
         //  echo "?id='.$id.'";
          // widget/modelstatus.php?id='.$id.'
                                               
       }
        echo '<td>'
       . '<a href="edit_incandexp.php?id='.$id.'" class="btn btn-success" rel="facebox"><i class="glyphicon glyphicon-pencil"></i></a>'
               . ' <a href="bill_incandexp.php?id='.$id.'" class="btn btn-info" rel="facebox"><i class="glyphicon glyphicon-zoom-in"></i></a>'
               . ' <a href="function/delete_incandexp.php?id='.$id.'" class="btn btn-danger" rel="facebox"><i class="glyphicon glyphicon-trash"></i></a>'
               . '</td>';
       echo '</tr>';
                                        
     } // whil
     ?>

    </table>
       

               
           </div>
                    
 <div class="tab-pane fade" id="month_9" role="tabpanel" aria-labelledby="month_1-tab">
    
         <br>
         <br>
        
    <table class="table table-bordered table-striped">
        
       
     <tr>
      <th>ไอดี</th>
      <th>รายรับ</th>
      <th>รายจ่าย</th>
      <th>เดือน</th>
      <th>เวลา</th>
      <th>สถานะ</th>
      <th>ปรับสถานะ</th>
      <th>การจัดการ</th>
     </tr>
     <?php
     $query = mysqli_query($connect, "SELECT *FROM incomeandexpenses WHERE month='กันยายน' ORDER BY id DESC") or die(mysqli_error());
  
     while($row = mysqli_fetch_array($query))
     {
      $status = $row['status'];
      $id = $row['id'];
      
      echo '
      <tr>
      <td>'.$row["id"].'</td>
      <td>'.$row["income"].'</td>
       <td>'.$row["expenses"].'</td>
       <td>'.$row["month"].'</td>
       <td>'.$row["timestamp"].'</td>
      ';
       if($status == "1"){
           
          echo '<td><a href="#" class="btn btn-success" rel="facebox">ชำระแล้ว</a></td>';
          echo '<td><a href="status_incandexp.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
                                               
       }if($status == "2"){
           
          echo '<td><a href="#" class="btn btn-danger" rel="facebox">ค้างชำระ</a></td>';
          echo '<td><a href="status_incandexp.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
                                               
       }if($status == "0"){
          echo '<td><a href="#" class="btn btn-warning" rel="facebox">รอการชำระ</a></td>';
          echo '<td><a href="status_incandexp.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
          
         //  echo "?id='.$id.'";
          // widget/modelstatus.php?id='.$id.'
                                               
       }
        echo '<td>'
       . '<a href="edit_incandexp.php?id='.$id.'" class="btn btn-success" rel="facebox"><i class="glyphicon glyphicon-pencil"></i></a>'
               . ' <a href="bill_incandexp.php?id='.$id.'" class="btn btn-info" rel="facebox"><i class="glyphicon glyphicon-zoom-in"></i></a>'
               . ' <a href="function/delete_incandexp.php?id='.$id.'" class="btn btn-danger" rel="facebox"><i class="glyphicon glyphicon-trash"></i></a>'
               . '</td>';
       echo '</tr>';
                                        
     } // whil
     ?>

    </table>
       

               
           </div>
                    
 <div class="tab-pane fade" id="month_10" role="tabpanel" aria-labelledby="month_1-tab">
    
         <br>
         <br>
        
    <table class="table table-bordered table-striped">
        
       
     <tr>
      <th>ไอดี</th>
      <th>รายรับ</th>
      <th>รายจ่าย</th>
      <th>เดือน</th>
      <th>เวลา</th>
      <th>สถานะ</th>
      <th>ปรับสถานะ</th>
      <th>การจัดการ</th>
     </tr>
     <?php
     $query = mysqli_query($connect, "SELECT *FROM incomeandexpenses WHERE month='ตุลาคม' ORDER BY id DESC") or die(mysqli_error());
  
     while($row = mysqli_fetch_array($query))
     {
      $status = $row['status'];
      $id = $row['id'];
      
      echo '
      <tr>
      <td>'.$row["id"].'</td>
      <td>'.$row["income"].'</td>
       <td>'.$row["expenses"].'</td>
       <td>'.$row["month"].'</td>
       <td>'.$row["timestamp"].'</td>
      ';
       if($status == "1"){
           
          echo '<td><a href="#" class="btn btn-success" rel="facebox">ชำระแล้ว</a></td>';
          echo '<td><a href="status_incandexp.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
                                               
       }if($status == "2"){
           
          echo '<td><a href="#" class="btn btn-danger" rel="facebox">ค้างชำระ</a></td>';
          echo '<td><a href="status_incandexp.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
                                               
       }if($status == "0"){
          echo '<td><a href="#" class="btn btn-warning" rel="facebox">รอการชำระ</a></td>';
          echo '<td><a href="status_incandexp.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
          
         //  echo "?id='.$id.'";
          // widget/modelstatus.php?id='.$id.'
                                               
       }
        echo '<td>'
       . '<a href="edit_incandexp.php?id='.$id.'" class="btn btn-success" rel="facebox"><i class="glyphicon glyphicon-pencil"></i></a>'
               . ' <a href="bill_incandexp.php?id='.$id.'" class="btn btn-info" rel="facebox"><i class="glyphicon glyphicon-zoom-in"></i></a>'
               . ' <a href="function/delete_incandexp.php?id='.$id.'" class="btn btn-danger" rel="facebox"><i class="glyphicon glyphicon-trash"></i></a>'
               . '</td>';
       echo '</tr>';
                                        
     } // whil
     ?>

    </table>
       

               
           </div>
                    
 <div class="tab-pane fade" id="month_11" role="tabpanel" aria-labelledby="month_1-tab">
    
         <br>
         <br>
        
    <table class="table table-bordered table-striped">
        
       
     <tr>
      <th>ไอดี</th>
      <th>รายรับ</th>
      <th>รายจ่าย</th>
      <th>เดือน</th>
      <th>เวลา</th>
      <th>สถานะ</th>
      <th>ปรับสถานะ</th>
      <th>การจัดการ</th>
     </tr>
     <?php
     $query = mysqli_query($connect, "SELECT *FROM incomeandexpenses WHERE month='พฤศจิกายน' ORDER BY id DESC") or die(mysqli_error());
  
     while($row = mysqli_fetch_array($query))
     {
      $status = $row['status'];
      $id = $row['id'];
      
      echo '
      <tr>
      <td>'.$row["id"].'</td>
      <td>'.$row["income"].'</td>
       <td>'.$row["expenses"].'</td>
       <td>'.$row["month"].'</td>
       <td>'.$row["timestamp"].'</td>
      ';
       if($status == "1"){
           
          echo '<td><a href="#" class="btn btn-success" rel="facebox">ชำระแล้ว</a></td>';
          echo '<td><a href="status_incandexp.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
                                               
       }if($status == "2"){
           
          echo '<td><a href="#" class="btn btn-danger" rel="facebox">ค้างชำระ</a></td>';
          echo '<td><a href="status_incandexp.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
                                               
       }if($status == "0"){
          echo '<td><a href="#" class="btn btn-warning" rel="facebox">รอการชำระ</a></td>';
          echo '<td><a href="status_incandexp.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
          
         //  echo "?id='.$id.'";
          // widget/modelstatus.php?id='.$id.'
                                               
       }
        echo '<td>'
       . '<a href="edit_incandexp.php?id='.$id.'" class="btn btn-success" rel="facebox"><i class="glyphicon glyphicon-pencil"></i></a>'
               . ' <a href="bill_incandexp.php?id='.$id.'" class="btn btn-info" rel="facebox"><i class="glyphicon glyphicon-zoom-in"></i></a>'
               . ' <a href="function/delete_incandexp.php?id='.$id.'" class="btn btn-danger" rel="facebox"><i class="glyphicon glyphicon-trash"></i></a>'
               . '</td>';
       echo '</tr>';
                                        
     } // whil
     ?>

    </table>
       

               
           </div>
                    
 <div class="tab-pane fade" id="month_12" role="tabpanel" aria-labelledby="month_1-tab">
    
         <br>
         <br>
        
    <table class="table table-bordered table-striped">
        
       
     <tr>
      <th>ไอดี</th>
      <th>รายรับ</th>
      <th>รายจ่าย</th>
      <th>เดือน</th>
      <th>เวลา</th>
      <th>สถานะ</th>
      <th>ปรับสถานะ</th>
      <th>การจัดการ</th>
     </tr>
     <?php
     $query = mysqli_query($connect, "SELECT *FROM incomeandexpenses WHERE month='ธันวาคม' ORDER BY id DESC") or die(mysqli_error());
  
     while($row = mysqli_fetch_array($query))
     {
      $status = $row['status'];
      $id = $row['id'];
      
      echo '
      <tr>
      <td>'.$row["id"].'</td>
      <td>'.$row["income"].'</td>
       <td>'.$row["expenses"].'</td>
       <td>'.$row["month"].'</td>
       <td>'.$row["timestamp"].'</td>
      ';
       if($status == "1"){
           
          echo '<td><a href="#" class="btn btn-success" rel="facebox">ชำระแล้ว</a></td>';
          echo '<td><a href="status_incandexp.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
                                               
       }if($status == "2"){
           
          echo '<td><a href="#" class="btn btn-danger" rel="facebox">ค้างชำระ</a></td>';
          echo '<td><a href="status_incandexp.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
                                               
       }if($status == "0"){
          echo '<td><a href="#" class="btn btn-warning" rel="facebox">รอการชำระ</a></td>';
          echo '<td><a href="status_incandexp.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
          
         //  echo "?id='.$id.'";
          // widget/modelstatus.php?id='.$id.'
                                               
       }
        echo '<td>'
       . '<a href="edit_incandexp.php?id='.$id.'" class="btn btn-success" rel="facebox"><i class="glyphicon glyphicon-pencil"></i></a>'
               . ' <a href="bill_incandexp.php?id='.$id.'" class="btn btn-info" rel="facebox"><i class="glyphicon glyphicon-zoom-in"></i></a>'
               . ' <a href="function/delete_incandexp.php?id='.$id.'" class="btn btn-danger" rel="facebox"><i class="glyphicon glyphicon-trash"></i></a>'
               . '</td>';
       echo '</tr>';
                                        
     } // whil
     ?>

    </table>
       

               
           </div>
           
 <div class="tab-pane fade" id="status_1" role="tabpanel" aria-labelledby="alldata-tab">
               
               
               <br>
               <br>
 
    <table class="table table-bordered table-striped">
        
     
     <tr>
      <th>ไอดี</th>
      <th>รายรับ</th>
      <th>รายจ่าย</th>
      <th>เดือน</th>
      <th>เวลา</th>
      <th>สถานะ</th>
      <th>ปรับสถานะ</th>
      <th>การจัดการ</th>
     </tr>
     <?php
      $query = mysqli_query($connect, "SELECT *FROM incomeandexpenses WHERE status='1' ORDER BY id DESC") or die(mysqli_error());
 
  
     while($row = mysqli_fetch_array($query))
     {
      $status = $row['status'];
      $id = $row['id'];
      
      echo '
      <tr>
      <td>'.$row["id"].'</td>
      <td>'.$row["income"].'</td>
       <td>'.$row["expenses"].'</td>
       <td>'.$row["month"].'</td>
       <td>'.$row["timestamp"].'</td>
      ';
       if($status == "1"){
           
          echo '<td><a href="#" class="btn btn-success" rel="facebox">ชำระแล้ว</a></td>';
          echo '<td><a href="status_incandexp.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
                                               
       }if($status == "2"){
           
          echo '<td><a href="#" class="btn btn-danger" rel="facebox">ค้างชำระ</a></td>';
          echo '<td><a href="status_incandexp.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
                                               
       }if($status == "0"){
          echo '<td><a href="#" class="btn btn-warning" rel="facebox">รอการชำระ</a></td>';
          echo '<td><a href="status_incandexp.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
          
         //  echo "?id='.$id.'";
          // widget/modelstatus.php?id='.$id.'
                                               
       }
        echo '<td>'
       . '<a href="edit_incandexp.php?id='.$id.'" class="btn btn-success" rel="facebox"><i class="glyphicon glyphicon-pencil"></i></a>'
               . ' <a href="bill_incandexp.php?id='.$id.'" class="btn btn-info" rel="facebox"><i class="glyphicon glyphicon-zoom-in"></i></a>'
               . ' <a href="function/delete_incandexp.php?id='.$id.'" class="btn btn-danger" rel="facebox"><i class="glyphicon glyphicon-trash"></i></a>'
               . '</td>';
       echo '</tr>';
                                        
     } // whil
     ?>

    </table>
       
  

            
               
           </div>    
                    
 <div class="tab-pane fade" id="status_2" role="tabpanel" aria-labelledby="alldata-tab">
               
               
               <br>
               <br>
 
    <table class="table table-bordered table-striped">
        
     
     <tr>
      <th>ไอดี</th>
      <th>รายรับ</th>
      <th>รายจ่าย</th>
      <th>เดือน</th>
      <th>เวลา</th>
      <th>สถานะ</th>
      <th>ปรับสถานะ</th>
      <th>การจัดการ</th>
     </tr>
     <?php
      $query = mysqli_query($connect, "SELECT *FROM incomeandexpenses WHERE status='2' ORDER BY id DESC") or die(mysqli_error());
 
  
     while($row = mysqli_fetch_array($query))
     {
      $status = $row['status'];
      $id = $row['id'];
      
      echo '
      <tr>
      <td>'.$row["id"].'</td>
      <td>'.$row["income"].'</td>
       <td>'.$row["expenses"].'</td>
       <td>'.$row["month"].'</td>
       <td>'.$row["timestamp"].'</td>
      ';
       if($status == "1"){
           
          echo '<td><a href="#" class="btn btn-success" rel="facebox">ชำระแล้ว</a></td>';
          echo '<td><a href="status_incandexp.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
                                               
       }if($status == "2"){
           
          echo '<td><a href="#" class="btn btn-danger" rel="facebox">ค้างชำระ</a></td>';
          echo '<td><a href="status_incandexp.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
                                               
       }if($status == "0"){
          echo '<td><a href="#" class="btn btn-warning" rel="facebox">รอการชำระ</a></td>';
          echo '<td><a href="status_incandexp.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
          
         //  echo "?id='.$id.'";
          // widget/modelstatus.php?id='.$id.'
                                               
       }
        echo '<td>'
       . '<a href="edit_incandexp.php?id='.$id.'" class="btn btn-success" rel="facebox"><i class="glyphicon glyphicon-pencil"></i></a>'
               . ' <a href="bill_incandexp.php?id='.$id.'" class="btn btn-info" rel="facebox"><i class="glyphicon glyphicon-zoom-in"></i></a>'
               . ' <a href="function/delete_incandexp.php?id='.$id.'" class="btn btn-danger" rel="facebox"><i class="glyphicon glyphicon-trash"></i></a>'
               . '</td>';
       echo '</tr>';
                                        
     } // whil
     ?>

    </table>
       
  

            
               
           </div> 
                    
 <div class="tab-pane fade" id="status_0" role="tabpanel" aria-labelledby="alldata-tab">
               
               
               <br>
               <br>
 
    <table class="table table-bordered table-striped">
        
     
     <tr>
      <th>ไอดี</th>
      <th>รายรับ</th>
      <th>รายจ่าย</th>
      <th>เดือน</th>
      <th>เวลา</th>
      <th>สถานะ</th>
      <th>ปรับสถานะ</th>
      <th>การจัดการ</th>
     </tr>
     <?php
      $query = mysqli_query($connect, "SELECT *FROM incomeandexpenses WHERE status='0' ORDER BY id DESC") or die(mysqli_error());
 
  
     while($row = mysqli_fetch_array($query))
     {
      $status = $row['status'];
      $id = $row['id'];
      
      echo '
      <tr>
      <td>'.$row["id"].'</td>
      <td>'.$row["income"].'</td>
       <td>'.$row["expenses"].'</td>
       <td>'.$row["month"].'</td>
       <td>'.$row["timestamp"].'</td>
      ';
       if($status == "1"){
           
          echo '<td><a href="#" class="btn btn-success" rel="facebox">ชำระแล้ว</a></td>';
          echo '<td><a href="status_incandexp.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
                                               
       }if($status == "2"){
           
          echo '<td><a href="#" class="btn btn-danger" rel="facebox">ค้างชำระ</a></td>';
          echo '<td><a href="status_incandexp.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
                                               
       }if($status == "0"){
          echo '<td><a href="#" class="btn btn-warning" rel="facebox">รอการชำระ</a></td>';
          echo '<td><a href="status_incandexp.php?id='.$id.'" class="btn btn-primary" rel="facebox">ปรับสถานะ</a></td>';
          
         //  echo "?id='.$id.'";
          // widget/modelstatus.php?id='.$id.'
                                               
       }
        echo '<td>'
       . '<a href="edit_incandexp.php?id='.$id.'" class="btn btn-success" rel="facebox"><i class="glyphicon glyphicon-pencil"></i></a>'
               . ' <a href="bill_incandexp.php?id='.$id.'" class="btn btn-info" rel="facebox"><i class="glyphicon glyphicon-zoom-in"></i></a>'
               . ' <a href="function/delete_incandexp.php?id='.$id.'" class="btn btn-danger" rel="facebox"><i class="glyphicon glyphicon-trash"></i></a>'
               . '</td>';
       echo '</tr>';
                                        
     } // whil
     ?>

    </table>
       
  

            
               
           </div>                     
                    
     
                    
                        </div> 
          
       

   
       <div id="add" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <center>
                                                    <h5 class="modal-title" id="add">เพิ่มข้อมูลรายรับ - รายจ่าย</h5>
                                                    </center>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                
                                                <div class="modal-body">
					<form method="post" enctype="multipart/form-data">
					<center>
						<table>
					
						
							<tr>
								<td><label  class="col-form-label">รายรับ:</label>
                                                                    <input  class="form-control" type="number" name="income" placeholder="ใส่รายรับ..." style="width:250px;" required></td>
							<tr/>
							<tr>
								<td><label  class="col-form-label">รายจ่าย:</label>
                                                                    <input class="form-control" type="number" name="expenses" placeholder="ใส่รายจ่าย..." style="width:250px;" required></td>
							</tr>
							
							<tr>
								<td><label  class="col-form-label">เดือน:</label>
                                                                    <br>
                                                                    <select name="month" style="width:250px;" required>
                                                                    <option value="มกราคม">มกราคม</option>
                                                                    <option value="กุมภาพันธ์">กุมภาพันธ์</option>
                                                                    <option value="มีนาคม">มีนาคม</option>
                                                                    <option value="เมษายน">เมษายน</option>
                                                                    <option value="พฤษภาคม">พฤษภาคม</option>
                                                                    <option value="มิถุนายน">มิถุนายน</option>
                                                                    <option value="กรกฎาคม">กรกฎาคม</option>
                                                                    <option value="สิงหาคม">สิงหาคม</option>
                                                                    <option value="กันยายน">กันยายน</option>
                                                                    <option value="ตุลาคม">ตุลาคม</option>
                                                                    <option value="พฤศจิกายน">พฤศจิกายน</option>
                                                                    <option value="ธันวาคม">ธันวาคม</option>
                                                                    </select></td>
							</tr>

						
						</table>
					</center>
				</div>
                                                
                                                
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                                    <input class="btn btn-primary" type="submit" name="add" value="เพิ่มข้อมูล" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
       
       <?php
			if (isset($_POST['add']))
				{
                            $mysqli = new mysqli("localhost", "root", "", "se_project");
                            
                                $income = $_POST['income'];
                                $expenses = $_POST['expenses'];
                                $month = $_POST['month'];
                     
                             
				$check = mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM `incomeandexpenses` WHERE `month` = '$month'"));
                
                                                  
                              if($check == 1){
                                  
                                                   echo '      <script>
       setTimeout(function() {
        swal({
            title: "ผิดพลาด",
            text: "ชื่อนี้มีอยู่ในระบบอยู่แล้ว",
            type: "error"
        }, function() {
            window.location = "/Se_project/incandexp.php"; //หน้าที่ต้องการให้กระโดดไป
        });
    }, 1000);
</script>';
               
                                   
                                }else{
                                        $t_sql = "INSERT INTO incomeandexpenses (income, expenses, month, timestamp) "
                                 . "VALUES ('".$income."', '".$expenses."', '".$month."', CURRENT_TIMESTAMP)";
                                
                                $t_result = mysqli_query($mysqli,$t_sql); 
                                
                                echo '      <script>
       setTimeout(function() {
        swal({
            title: "เสร็จสิ้น",
            text: "ข้อมูลเข้าสู่ฐานข้อมูลแล้ว",
            type: "success"
        }, function() {
            window.location = "/Se_project/incandexp.php"; //หน้าที่ต้องการให้กระโดดไป
        });
    }, 1000);
</script>';
                                    
                                }
          
                                }

				?>
       
   
  </div>
  
  <script>  
      $(document).ready(function(){  
           $.datepicker.setDefaults({  
                dateFormat: 'yy-mm-dd'   
           });  
           $(function(){  
                $("#from_date").datepicker();  
                $("#to_date").datepicker();  
           });  
           $('#filterdate').click(function(){  
                var from_date = $('#from_date').val();  
                var to_date = $('#to_date').val();  
                if(from_date != '' && to_date != '')  
                {  
                     $.ajax({  
                          url:"function/filter_incandexp.php",  
                          method:"POST",  
                          data:{from_date:from_date, to_date:to_date},  
                          success:function(data)  
                          {  
                               $('#order_table').html(data);  
                          }  
                     });  
                }  
                else  
                {  
                     alert("Please Select Date");  
                }  
           });  
      });  
 </script>
 
   <script>
  $(document).ready(function(){
    $('.btn-primary').click(function(){
        $('#xx').text($(this).data('id'));
    });
  })
</script>  
<script src="/Se_project/javascripts/filter.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
	$(document).ready( function() {
		
		$('.remove').click( function() {
		
		var id = $(this).attr("id");

		
		if(confirm("Are you sure you want to delete this product?")){
			
		
			$.ajax({
			type: "POST",
			url: "",
			data: ({id: id}),
			cache: false,
			success: function(html){
			$(".del"+id).fadeOut(2000, function(){ $(this).remove();}); 
			}
			}); 
			}else{
			return false;}
		});				
	});

</script>
  
 </body>
</html>


