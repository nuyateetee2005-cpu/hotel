<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
<title>เพิ่มการจอง</title>
<style>
body{
    background: linear-gradient(to right, #ffecd2, #fcb69f);
    font-family: 'Segoe UI';
}

form{
    width: 380px;
    margin: auto;
    margin-top: 60px;
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

h2{
    text-align: center;
}

input, select{
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 8px;
    border: 1px solid #ccc;
}

button{
    width: 100%;
    padding: 10px;
    background: #28a745;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
}

button:hover{
    background: #218838;
}
</style>
</head>
<body>

<form method="POST">
<h2>เพิ่มการจองห้องพัก</h2>

<input type="text" name="Fname" placeholder="ชื่อ" required>
<input type="text" name="Lname" placeholder="นามสกุล" required>
<input type="text" name="tel" placeholder="เบอร์" required>

<select name="room_id" required>
<option value="">-- เลือกห้อง --</option>

<?php
$sql = "SELECT * FROM detail_room";
$result = $conn->query($sql);

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo "<option value='".$row['room_id']."'>
                ".$row['room_id']." | ".$row['room_type']." | ".$row['room_price']." บาท
              </option>";
    }
}else{
    echo "<option value=''>ไม่มีห้อง (กรุณาเพิ่มห้องก่อน)</option>";
}
?>
</select>

<input type="date" name="checkin" required>
<input type="date" name="checkout" required>

<button name="save">บันทึก</button>
</form>

<?php
if(isset($_POST['save'])){

    $Fname = $_POST['Fname'] ?? '';
    $Lname = $_POST['Lname'] ?? '';
    $tel = $_POST['tel'] ?? '';
    $room_id = $_POST['room_id'] ?? '';
    $checkin = $_POST['checkin'] ?? '';
    $checkout = $_POST['checkout'] ?? '';

    if($Fname && $Lname && $tel && $room_id && $checkin && $checkout){

        $sql = "INSERT INTO booking (Fname,Lname,tel,room_id,checkin,checkout)
        VALUES ('$Fname','$Lname','$tel','$room_id','$checkin','$checkout')";

        if($conn->query($sql)){
            header("Location: index.php");
            exit();
        } else {
            echo "<script>alert('Error: ".$conn->error."');</script>";
        }

    } else {
        echo "<script>alert('กรอกข้อมูลให้ครบ');</script>";
    }
}
?>

</body>
</html>