<?php
$server = 'localhost';
$username = 'root';
$password = '';
$dbname = 'train';


$conn = new mysqli($server, $username, $password, $dbname);


if ($conn->connect_error) {
    die('Connection failed: '. $conn->connect_error);
}

if (isset($_POST['submit'])) {
   
    $firstname =($_POST['first_name']);
    $lastname = ($_POST['last_name']);
    $phonenumber = ($_POST['phone_number']);
    $departure =($_POST['depature']);
    $arrival = ($_POST['arrival']);
    $time = ($_POST['time']);
    $date = ($_POST['date']);
    
   
    $sql = "INSERT INTO `train101`(`firstname`, `lastname`, `phonenumber`, `departure`, `arrival`, `time`, `date`) 
            VALUES ('$firstname','$lastname','$phonenumber','$departure','$arrival','$time','$date')";
    
  
    if ($conn->query($sql)) {
        
        $insert_id = $conn->insert_id;
        
        
        ?>
        <div class='receipt-container'>
        <div class='receipt-heading'>TICKET ID: <?php echo $insert_id;?></div>
        <div class='receipt-detail'>First Name: <?php echo $firstname;?></div>
        <div class='receipt-detail'>Last Name: <?php echo $lastname;?></div>
        <div class='receipt-detail'>Phone Number: <?php echo $phonenumber;?></div>
        <div class='receipt-detail'>Departure: <?php echo $departure;?></div>
        <div class='receipt-detail'>Arrival: <?php echo $arrival;?></div>
        <div class='receipt-detail'>Time: <?php echo $time;?></div>
        <div class='receipt-detail'>Date: <?php echo $date;?></div>
        <div class='receipt-thankyou'>Thank you for choosing us!</div>
    </div>
    <style>
        .receipt-container {
    font-family: Arial, sans-serif;
    border: 1px solid #ccc;
    padding: 20px;
    width: 300px;
    margin: 0 auto;
}

.receipt-heading {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 10px;
}

.receipt-detail {
    margin-bottom: 5px;
}

.receipt-thankyou {
    font-style: italic;
    margin-top: 20px;
}

    </style>
        
       
       
     <?php   
         
    } else {
        
        echo "ode";
    }
}
?>



