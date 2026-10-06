<?php
include 'db.php';

$id = $_GET['id'] ?? '';

if($id){

    $sql = "DELETE FROM booking WHERE id_booking = '$id'";

    if($conn->query($sql)){
        echo "<script>
                alert('ลบข้อมูลสำเร็จ');
                window.location='index.php';
              </script>";
    } else {
        echo "<script>alert('Error: ".$conn->error."');</script>";
    }

} else {
    echo "<script>
            alert('ไม่พบข้อมูล');
            window.location='index.php';
          </script>";
}
?>