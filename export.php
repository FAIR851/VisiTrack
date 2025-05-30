<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "login"; 

$conn = new mysqli($host, $user, $pass, $db);

if (isset($_POST['export'])) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="visitors.csv"');

    $output = fopen("php://output", "w");

    // CSV column headers
    fputcsv($output, [
        'ID', 'Lastname', 'Firstname', 'Middle Initial', 'Suffix', 'Email',
        'Purpose', 'Visitor Type', 'ZIP Code', 'Municipality',
        'Barangay/Village', 'Visit Date', 'Visit Time'
    ]);

    $sql = "SELECT 
                id, Lastname, Firstname, Middle_Initial, Suffix, Email, purpose, 
                visitor_type, ZIP_Code, Municipality, Barangay_Village,
                DATE_FORMAT(visit_date, '%Y-%m-%d') AS formatted_date,
                DATE_FORMAT(visit_time, '%l:%i %p') AS formatted_time
            FROM visitors";

    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        fputcsv($output, [
            $row['id'],
            $row['Lastname'],
            $row['Firstname'],
            $row['Middle_Initial'],
            $row['Suffix'],
            $row['Email'],
            $row['purpose'],
            $row['visitor_type'],
            $row['ZIP_Code'],
            $row['Municipality'],
            $row['Barangay_Village'],
            $row['formatted_date'],
            $row['formatted_time']
        ]);
    }

    fclose($output);
    exit;
}
?>
