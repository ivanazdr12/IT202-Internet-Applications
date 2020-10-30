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
    $client_first = $_POST['client_first'];
    $client_last = $_POST['client_last'];
    $client_type = $_POST['client_type'];
    $street_num = $_POST['street_num'];
    $street_name = $_POST['street_name'];
    $city = $_POST['city'];
    $submit =$_POST['submit'];
    echo '
    <h2>Account for the Client Created:</h2>
    
    <table>
    <tr>
    <th>Client First Name</th>
    <th>Client Last Name</th>
    <th>Client Type</th>
    <th>Street Number</th>
    <th>Street Name</th>
    <th>City</th>
    </tr>
    
    ';
    echo '
        <tr>
        <td>' . $client_first . '</td>
        <td>' . $client_last . '</td>
        <td>' . $client_type . '</td>
        <td>' . $street_num . '</td>
        <td>' . $street_name . '</td>
        <td>' . $city .  '</td>
        </tr>
        ';
}
$conn->close();
?>