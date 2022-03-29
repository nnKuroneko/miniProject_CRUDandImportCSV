<?php
include("alert.php");
?>

<?php

$mysqli = new mysqli("localhost", "root", "", "se_project");

    $id= $_GET['id'];

        $sql = "Delete from payment_reminder where id=".$id;

        $result = $mysqli->query($sql);
        
        echo '      <script>
       setTimeout(function() {
        swal({
            title: "เสร็จสิ้น",
            text: "ข้อมูลถูกลบออกจากฐานข้อมูลแล้ว",
            type: "success"
        }, function() {
            window.location = "/Se_project/index.php"; //หน้าที่ต้องการให้กระโดดไป
        });
    }, 1000);
</script>';
    

    $mysqli->close();
?>