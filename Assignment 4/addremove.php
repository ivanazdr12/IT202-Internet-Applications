<?php
echo "<link rel='stylesheet' type='text/css' href='style2.css' />";
$servername = "sql1.njit.edu";
$username = "iz9";
$password = "Passwordhere";
$dbname = "iz9";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $realtor_id = $_POST['realtor_id'];
    $client_first = $_POST['client_first'];
    $client_last = $_POST['client_last'];
    $client_type = $_POST['client_type'];
    $appt_date_time = $_POST['appt_date_time'];
    $street_num = $_POST['street_num'];
    $street_name = $_POST['street_name'];
    $city = $_POST['city'];
} else {
    $client_first = $_GET['client_first'];
    $client_last = $_GET['client_last'];
    $realtor_id = $_GET['realtor_id'];
}

//display the clients before insert and delete
$result = $conn->query("SELECT * FROM realtors WHERE realtor_id = '$realtor_id'");
if ($result->num_rows > 0) {
    echo '
    <h2>Records Before:</h2>
    
    <table class="table">
    <tr>
    <th>Realtor First Name</th>
    <th>Realtor Last Name</th>
    <th>Realtor ID</th>
    <th>Client First Name</th>
    <th>Client Last Name</th>
    <th>Client Type</th>
    <th>Appointment</th>
    <th>Street Number</th>
    <th>Street Name</th>
    <th>City</th>
    </tr>
    
    ';
    while ($row = $result->fetch_assoc()) {
        echo '
        <tr>
        <td>' . $row['realtor_first'] . '</td>
        <td>' . $row['realtor_last'] . '</td>
        <td>' . $row['realtor_id'] . '</td>
        <td>' . $row['client_first'] . '</td>
        <td>' . $row['client_last'] . '</td>
        <td>' . $row['client_type'] . '</td>
        <td>' . $row['appt_date_time'] . '</td>
        <td>' . $row['street_num'] . '</td>
        <td>' . $row['street_name'] . '</td>
        <td>' . $row['city'] . '</td>
        </tr>
        ';
    }
    echo '</table><br><br><br>';
} else {
    echo 'This Account does not have any clients! <br><br>';
}
/*
if($conn->query("INSERT INTO realtors (realtor_first, realtor_last, realtor_id, client_first, client_last, client_type,
                    appt_date_time, street_num, street_name, city)
                    VALUES('$realtor_first', '$realtor_last', '$realtor_id', '$client_first', '$client_last', '$client_type',
                    '$appt_date_time', '$street_num', '$street_name', '$city')") === TRUE) {

*/
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if($conn->query("UPDATE realtors SET client_first='$client_first', client_last='$client_last', client_type='$client_type',
    appt_date_time='$appt_date_time', street_num='$street_num', street_name='$street_name', city='$city'
    WHERE realtor_id='$realtor_id'") === TRUE ){
    
                    echo "New client is successfully scheduled! <br><br>";
                    } else{
                        echo "Error: " . $sql . "<br>" . $conn->error . "<br><br>";
                    }
    } else{
        if($conn->query("DELETE FROM realtors WHERE realtor_id ='$realtor_id'") === TRUE) {
            echo "New client successfully deleted!<br><br>";
        } else{
            echo "Error: " . $sql . "<br>" . $conn->error . "<br><br>";
        }
    }
    
//After insert and delete
$result2 = $conn->query("SELECT * FROM realtors WHERE realtor_id = '$realtor_id'");
if ($result2->num_rows > 0) {
     echo '
     <h2>Records After:</h2>
     <table class="table">
     <tr>
     <th>Realtor First Name</th>
     <th>Realtor Last Name</th>
     <th>Realtor ID</th>
     <th>Client First Name</th>
     <th>Client Last Name</th>
     <th>Client Type</th>
     <th>Appointment</th>
     <th>Street Number</th>
     <th>Street Name</th>
     <th>City</th>
     </tr>
     ';
     while($row2 = $result2->fetch_assoc()) {
        echo '
        <tr>
        <td>' . $row2['realtor_first'] . '</td>
        <td>' . $row2['realtor_last'] . '</td>
        <td>' . $row2['realtor_id'] . '</td>
        <td>' . $row2['client_first'] . '</td>
        <td>' . $row2['client_last'] . '</td>
        <td>' . $row2['client_type'] . '</td>
        <td>' . $row2['appt_date_time'] . '</td>
        <td>' . $row2['street_num'] . '</td>
        <td>' . $row2['street_name'] . '</td>
        <td>' . $row2['city'] . '</td>
        </tr>
        ';
     }
     echo '</table>';
     echo "<br><a href='https://web.njit.edu/~iz9/realtorshtml.html'>Return to Form</a> <br><br>";
} else{
    echo "There are currently no clients scheduled!";
    echo '
     <h2>Records After:</h2>
     <table class="table">
     <tr>
     <th>Realtor First Name</th>
     <th>Realtor Last Name</th>
     <th>Realtor ID</th>
     <th>Client First Name</th>
     <th>Client Last Name</th>
     <th>Client Type</th>
     <th>Appointment</th>
     <th>Street Number</th>
     <th>Street Name</th>
     <th>City</th>
     </tr>
     ';
    echo "<br><a href='https://web.njit.edu/~iz9/realtorshtml.html'>Return to Form</a>";
}

$conn->close();
?>