<?php 
$date = date('d');
if ($date > 1) {
    $action = "SELECT * FROM personal_information";
    $results = mysqli_query($con, $action);
    $row_count = mysqli_num_rows($results);
    $row_users = mysqli_fetch_array($results, MYSQL_NUM);

    for ($i = 1; $i < $row_count; $i++) {
        $row_users = mysqli_fetch_array($results);
        $recipientEmail = $row_users['email'];
        $emailSubject = "Budget not started";
        $emailContent = "Budget is not started, please start budget";


        $fromAddress = "-fpostmaster@localhost";
        $emailStatus = mail($recipientEmail, $emailSubject, $emailContent);
        if ($emailStatus) {
            echo "Email Sent Successfully!";
        } else {
            echo "No Email is sent";
        }
    }
}


?>
