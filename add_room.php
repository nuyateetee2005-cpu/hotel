<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
<title>เพิ่มห้องพัก</title>
<style>
body{
    background: linear-gradient(to right, #a1c4fd, #c2e9fb);
    font-family: 'Segoe UI';
}

form{
    width: 350px;
    margin: auto;
    margin-top: 80px;
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

h2{
    text-align: center;
}

input{
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 8px;
    border: 1px solid #ccc;
}

button{
    width: 100%;
    padding: 10px;
    background: #007bff;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
}

button:hover{
    background: #0056b3;
}
</style>
</head>
<body>

<form method="POST">
<h2>เพิ่มข้อมูลห้องพัก</h2>

<input type="text" name="room_id" placeholder="รหัสห้อง (เช่น R001)" required>
<input type="text" name="room_type" placeholder="ประเภทห้อง (Standard, Deluxe)" required>
<input type="number" name="room_price" placeholder="ราคา (บาท/คืน)" required>

<button name="save">บันทึก</button>
</form>

<?php
if(isset($_POST['save'])){

    $room_id = $_POST['room_id'] ?? '';
    $room_type = $_POST['room_type'] ?? '';
    $room_price = $_POST['room_price'] ?? '';

    if($room_id && $room_type && $room_price){

        // เช็คว่ารหัสซ้ำไหม
        $check = $conn->query("SELECT * FROM detail_room WHERE room_id='$room_id'");

        if($check->num_rows > 0){
            echo "<script>alert('รหัสห้องนี้มีอยู่แล้ว');</script>";
        } else {

            $sql = "INSERT INTO detail_room (room_id, room_type, room_price)
                    VALUES ('$room_id', '$room_type', '$room_price')";

            if($conn->query($sql)){
                echo "<script>
                        alert('เพิ่มห้องสำเร็จ');
                        window.location='index.php';
                      </script>";
            } else {
                echo "<script>alert('Error: ".$conn->error."');</script>";
            }

        }

    } else {
        echo "<script>alert('กรอกข้อมูลให้ครบ');</script>";
    }
}
?>

</body>
</html>