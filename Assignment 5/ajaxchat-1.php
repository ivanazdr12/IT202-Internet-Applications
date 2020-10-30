<?php
$servername = "sql1.njit.edu";
$username = "iz9";
$dbpassword = "Password";
$dbname = "iz9";

$type = $_GET['type'];
$nameinput = $_GET['name'];
$password = $_GET['password'];
$content = $_GET['content'];
$result2 = '';

$conn = mysqli_connect($servername, $username, $dbpassword, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($type == 'write') {
    $sql1 = "SELECT * FROM chats WHERE `name`='" . $nameinput . "'";
    $result = $conn->query($sql1);
    if ($result->num_rows > 0) {
        $sql = "UPDATE chats SET `chat_content` = '". $content ."' WHERE
                `name`='" . $nameinput . "' AND
                `password`='" . $password . "'";
        if($conn->query($sql)) {
            $result2 = 'Success';
        } else {
            $result2 = 'Error: ' . $sql . ' ' . $conn->error;
        }
    } else {
        $sql = "INSERT INTO chats (`name`, `password`, `chat_content`) VALUES
                ('".$nameinput."','".$password."','".$content."')";
        if($conn->query($sql)) {
            $result2 = 'Success';
        } else {
            $result2 = 'Error: ' . $sql . ' ' . $conn->error;
        }
    }
} else if ($type == 'read'){
    $result = $conn->prepare("SELECT chat_content FROM chats WHERE `name` = ?");
    $result->bind_param("s", $nameinput);
    $result->execute();
    $result->store_result();
    $result->bind_result($cont);
    $result->fetch();
    $result->close();
    $result2 = $cont;
} else if ($type == 'name') {
    $result = $conn->query("SELECT `name` FROM chats");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $result2 .= (" " . $row['name']);
        }
    }
}

echo $result2;

$conn->close();