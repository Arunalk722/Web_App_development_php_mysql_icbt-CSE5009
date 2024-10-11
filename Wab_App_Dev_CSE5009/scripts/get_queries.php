<?php
require_once 'config.php';

try {
    $userID = $_COOKIE['UserId'];
    $locationName = $_COOKIE['Locations'];
    $conn = dbConfig::initDb();
   // $sqlQuery = "SELECT us.full_name, us.email_address, us.phone_no, us.farmer_address, fq.location, fq.services, fq.farmer_query,fq.log_time,fq.idtbl_farmar_query  FROM tbl_users AS us JOIN tbl_farmar_query AS fq ON us.idtbl_users = fq.farmer_id ";
   // $sqlQuery = "SELECT us.full_name, us.email_address, us.phone_no, us.farmer_address, fq.locations, fq.services, fq.farmer_query,fq.log_time,fq.idtbl_farmar_query FROM tbl_users AS us JOIN tbl_farmar_query AS fq ON us.idtbl_users = fq.farmer_id join tbl_location_list as ll on us.idtbl_users=us.idtbl_users where ll.field_officer_id=2;";
    $sqlQuery="SELECT us.full_name, us.email_address, us.phone_no, us.farmer_address, fq.locations,fq.office_time,fq.officer_solution, fq.services, fq.farmer_query,fq.log_time,fq.idtbl_farmar_query FROM tbl_users AS us JOIN tbl_farmar_query AS fq ON us.idtbl_users = fq.farmer_id join tbl_location_list as ll on us.idtbl_users=us.idtbl_users where fq.locations = '$locationName' AND ll.field_officer_id = $userID";
    
    $result = $conn->query($sqlQuery);
    $data = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    $conn->close();
    header('Content-Type: application/json');
    echo json_encode($data);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
