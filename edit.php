<?php include 'db.php';

$id = $_GET['id'] ?? '';

$data = $conn->query("SELECT * FROM booking WHERE id_booking='$id'")->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<title>แก้ไขข้อมูล</title>
<style>
body{
    background: linear-gradient(to right, #fddb92, #d1fdff);
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
    background: orange;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
}

button:hover{
    background: darkorange;
}
</style>
</head>
<body>

<form method="POST">
<h2>แก้ไขข้อมูลการจอง</h2>

<input type="text" name="Fname" value="<?= $data['Fname'] ?? '' ?>" required>
<input type="text" name="Lname" value="<?= $data['Lname'] ?? '' ?>" required>
<input type="text" name="tel" value="<?= $data['tel'] ?? '' ?>" required>

<select name="room_id" required>
<?php
$sql = "SELECT * FROM detail_room";
$result = $conn->query($sql);

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $selected = ($row['room_id'] == $data['room_id']) ? 'selected' : '';
        echo "<option value='".$row['room_id']."' $selected>
                ".$row['room_id']." | ".$row['room_type']." | ".$row['room_price']." บาท
              </option>";
    }
}else{
    echo "<option value=''>ไม่มีห้อง</option>";
}
?>
</select>

<input type="date" name="checkin" value="<?= $data['checkin'] ?? '' ?>" required>
<input type="date" name="checkout" value="<?= $data['checkout'] ?? '' ?>" required>

<button name="update">อัปเดต</button>
</form>

<?php
if(isset($_POST['update'])){

    $Fname = $_POST['Fname'] ?? '';
    $Lname = $_POST['Lname'] ?? '';
    $tel = $_POST['tel'] ?? '';
    $room_id = $_POST['room_id'] ?? '';
    $checkin = $_POST['checkin'] ?? '';
    $checkout = $_POST['checkout'] ?? '';

    if($Fname && $Lname && $tel && $room_id && $checkin && $checkout){

        $sql = "UPDATE booking SET
        Fname='$Fname',
        Lname='$Lname',
        tel='$tel',
        room_id='$room_id',
        checkin='$checkin',
        checkout='$checkout'
        WHERE id_booking='$id'";

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