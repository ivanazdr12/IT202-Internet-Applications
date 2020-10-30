    <!DOCTYPE html>
    <html>
    <head>
    <title>Database Records</title>
    
    
    <style>
    table {
    border: 1px solid black;
    width: 100%;
    color: #7e588c;
    font-family: monospace;
    font-size: 14px;
    text-align: left;
    }
    th {
    background-color: #7e588c;
    border: 1px solid black;
    color: white;
    }
    tr:nth-child(even) {background-color: #f2f2f2}
    body{
        margin: 4%;
    }
    </style>
    </head>
    
    
    <body>
    <table cellspacing="10">
    <tr>
    <th>Realtor First Name</th>
    <th>Realtor Last Name</th>
    <th>Realtor Password</th>
    <th>Realtor ID</th>    
    <th>Realtor Email</th>    
    <th>Client First Name</th>    
    <th>Client Last Name</th>    
    <th>Client Type</th>    
    <th>Appointment Schedule Date & Time</th>    
    <th>Street Number</td>    
    <th>Street Name</td>    
    <th>City</td>  
    </tr>
    
    
    <?php
    $conn = mysqli_connect("sql1.njit.edu", "iz9", "Passwordhere", "iz9");
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "SELECT realtor_first, realtor_last, realtor_password, realtor_id, realtor_email, client_first, client_last, client_type, appt_date_time, street_num, street_name, city FROM realtors";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["realtor_first"]. "</td><td>" . $row["realtor_last"] . "</td><td>" . $row["realtor_password"]. "</td><td>" . $row["realtor_id"]. "</td><td>" . $row["realtor_email"]. "</td><td>"
    . $row["client_first"]. "</td><td>" . $row["client_last"]. "</td><td>" . $row["client_type"]. "</td><td>" . $row["appt_date_time"]. "</td><td>" . $row["street_num"]. "</td><td>" . $row["street_name"]. "</td><td>" . $row["city"]. "</td></tr>";
    } 
    echo "</table>";
    } else { echo "0 results"; }
    $conn->close();
    ?>
    </table>
    </body>
    </html>