<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>Hotel Booking</title>
<style>
body{
    font-family: 'Segoe UI';
    background: linear-gradient(to right, #74ebd5, #ACB6E5);
}

.container{
    width: 90%;
    margin: auto;
    margin-top: 40px;
}

.btn{
    padding: 10px 15px;
    border-radius: 8px;
    color: white;
    text-decoration: none;
    font-weight: bold;
}

.yellow{ background: #ff9800; }
.green{ background: #28a745; }
.red{ background: #dc3545; }

.card{
    background: white;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

table{
    width: 100%;
    border-collapse: collapse;
}

th{
    background: #343a40;
    color: white;
}

th,td{
    padding: 12px;
    text-align: center;
}

tr:nth-child(even){
    background: #f2f2f2;
}

tr:hover{
    background: #d1ecf1;
}
</style>
</head>
<body>

<div class="container">

<a href="add_booking.php" class="btn yellow">+ เพิ่มการจอง</a>
<a href="add_room.php" class="btn green">+ เพิ่มห้องพัก</a>

<br><br>

<div class="card">
<table>
<tr>
<th>ชื่อ</th>
<th>นามสกุล</th>
<th>เบอร์</th>
<th>ห้อง</th>
<th>Checkin</th>
<th>Checkout</th>
<th>แก้ไข</th>
<th>ลบ</th>
</tr>

<?php
$sql = "SELECT * FROM booking";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()){
?>
<tr>
<td><?= $row['Fname'] ?? '-' ?></td>
<td><?= $row['Lname'] ?? '-' ?></td>
<td><?= $row['tel'] ?? '-' ?></td>
<td><?= $row['room_id'] ?? '-' ?></td>
<td><?= $row['checkin'] ?? '-' ?></td>
<td><?= $row['checkout'] ?? '-' ?></td>

<td><a class="btn green" href="edit.php?id=<?= $row['id_booking'] ?>">แก้ไข</a></td>
<td><a class="btn red" href="delete.php?id=<?= $row['id_booking'] ?>" onclick="return confirm('ลบ?')">ลบ</a></td>
</tr>
<?php } ?>

</table>
</div>

</div>
</body>
</html>
