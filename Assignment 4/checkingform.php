<?php
echo "<link rel='stylesheet' type='text/css' href='style2.css' />";
$servername = "sql1.njit.edu";
$username = "iz9";
$password = "Passwordhere";
$dbname = "iz9";

$realtor_first = $_POST['realtor_first'];
$realtor_last  = $_POST['realtor_last'];
$realtor_id = $_POST['realtor_id'];
$realtor_password = $_POST['realtor_password'];
$email = $_POST['email'];
$opt = $_POST['opt']; //create, add, remove, view

$conn = mysqli_connect($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//FIX THIS CREATE
if($opt == 'create'){
    echo '<form action="create.php" method="post" style="margin: auto;">
                    <h3>Create an Account for the Client</h3>

                    <label for="client_first">Client First Name:</label>
                    <input name="client_first" type="text"> 
                    
                    <label for="client_last">Client Last Name:</label>
                    <input name="client_last" type="text"> 
                    
                    <label for="client_type">Client Type:</label>
                    <input name="client_type" type="text">              
                    
                    <label for="street_num">Street Number:</label>
                    <input name="street_num" type="number">
                    
                    <label for="street_name">Street Name:</label>
                    <input name="street_name" type="text">
                    
                    <label for="city">City:</label>
                    <input name="city" type="text"><br>
                    
                    <input type="submit" value="Create Client Account">
             </form>';
             echo "<br><a href='https://web.njit.edu/~iz9/realtorshtml.html'>Return to Form</a>";
}else{
    //Verify the user
     $sql = "SELECT * FROM realtors WHERE
     `realtor_id` = " . $realtor_id . "
     AND `realtor_first` = '" . $realtor_first . "'
     AND `realtor_last` = '" . $realtor_last."'
     AND `realtor_password` = '" . $realtor_password . "' 
     ";
     
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '
            <h3>Realtor First Name: '. $row['realtor_first'] . '</h3>
            <h3>Realtor Last Name: '. $row['realtor_last'] . '</h3>
            <h3>Realtor ID: '. $row['realtor_id'] . '</h3>
            ';
        }
        if ($opt == 'view') { //view all the records for the realtor
            //$result2 = $conn->query("SELECT * FROM 'realtors' WHERE realtor_id = " . $realtor_id);
            $result2 = $conn->query("SELECT * FROM realtors WHERE realtor_id = '$realtor_id'");
            
            /* 
            $result2 = $conn->query("SELECT * FROM realtors WHERE realtor_first=$realtor_first
                                    AND realtor_last=$realtor_last AND realtor_id=$realtor_id");
                                    */
            if($result2->num_rows > 0){
                echo '<table class="table" cellspacing = "2" cellpadding = "2"">
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
                
                </tr>';
                while($row2 = $result2->fetch_assoc()){
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
                echo "<br><a href='https://web.njit.edu/~iz9/realtorshtml.html'>Return to Form</a>";
            } else{
                echo "You do not have any clients.";
                echo "<br><a href='https://web.njit.edu/~iz9/realtorshtml.html'>Return to Form</a>";
            }
        } else if ( $opt == 'add' ) {
             echo '<form action="addremove.php" method="post" style="margin: auto;">
                    <h3>Schedule an Appointment</h3>
                    
                    <label for="realtor_first">Realtor ID:</label>
                    <input name="realtor_id" type="number" value="'.$realtor_id.'">
                    
                    <label for="client_first">Client First Name:</label>
                    <input name="client_first" type="text">
                    
                    <label for="client_last">Client Last Name:</label>
                    <input name="client_last" type="text">
                    
                    <label for="client_type">Client Type:</label>
                    <input name="client_type" type="text">
                    
                    <label for="appt_date_time">Appointment:</label>
                    <input name="appt_date_time" type="text">
                    
                    <label for="street_num">Street Number:</label>
                    <input name="street_num" type="number">
                    
                    <label for="street_name">Street Name:</label>
                    <input name="street_name" type="text">
                    
                    <label for="city">City:</label>
                    <input name="city" type="text">
                    
                    <input type="submit" value="Add Client">
             </form>';
             echo "<br><a href='https://web.njit.edu/~iz9/realtorshtml.html'>Return to Form</a>";
        } else if( $opt == 'remove') {
            echo '<form action="addremove.php" method="get" style="margin: auto;">
            
                <h3>Confirm to Remove a Client for the following Realtor ID:</h3>
                
                <label for="realtor_id">Realtor ID:</label>
                <input name="realtor_id" type="number" value="'.$realtor_id.'"><br>
                
                <input type="submit" value="Remove Client">
                </form>';
            echo "<br><a href='https://web.njit.edu/~iz9/realtorshtml.html'>Return to Form</a>";
        }  
    } else {
        echo "Your account does not exist!";
        echo "<br><a href='https://web.njit.edu/~iz9/realtorshtml.html'>Return to Form</a>";
        }
        $conn->close();   
} 
?>