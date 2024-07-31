<?php
include '../../../php-config/connection.php';

$date = isset($_GET['date']) ? $_GET['date'] : '';

$stats = [];
$chartData = [
    'bloodGroups' => ['labels' => [], 'values' => []],
    'trends' => ['dates' => [], 'values' => []],
    'centers' => ['labels' => [], 'values' => []]
];

// Get total statistics
$stats_query = "SELECT 
                    SUM(CASE WHEN BLOOD_GROUP = 'O+' THEN 1 ELSE 0 END) as O_positive,
                    SUM(CASE WHEN BLOOD_GROUP = 'O-' THEN 1 ELSE 0 END) as O_negative,
                    SUM(CASE WHEN BLOOD_GROUP = 'A+' THEN 1 ELSE 0 END) as A_positive,
                    SUM(CASE WHEN BLOOD_GROUP = 'A-' THEN 1 ELSE 0 END) as A_negative,
                    SUM(CASE WHEN BLOOD_GROUP = 'AB+' THEN 1 ELSE 0 END) as AB_positive,
                    SUM(CASE WHEN BLOOD_GROUP = 'AB-' THEN 1 ELSE 0 END) as AB_negative,
                    COUNT(*) as total
                FROM donation";

if ($date) {
    $stats_query .= " WHERE DATE(DONATION_DATE) = '$date'";
}

$result = $conn->query($stats_query);

if ($row = $result->fetch_assoc()) {
    $stats = [
        'total' => $row['total'],
        'O_positive' => $row['O_positive'],
        'O_negative' => $row['O_negative'],
        'A_positive' => $row['A_positive'],
        'A_negative' => $row['A_negative'],
        'AB_positive' => $row['AB_positive'],
        'AB_negative' => $row['AB_negative']
    ];
}

// Prepare data for the Blood Group chart
$bloodGroups_query = "SELECT BLOOD_GROUP, COUNT(*) as count FROM donation";
if ($date) {
    $bloodGroups_query .= " WHERE DATE(DONATION_DATE) = '$date'";
}
$bloodGroups_query .= " GROUP BY BLOOD_GROUP";

$bloodGroups_result = $conn->query($bloodGroups_query);

while ($row = $bloodGroups_result->fetch_assoc()) {
    $chartData['bloodGroups']['labels'][] = $row['BLOOD_GROUP'];
    $chartData['bloodGroups']['values'][] = (int)$row['count'];
}

// Prepare data for Donation Trends chart
$trends_query = "SELECT DATE(DONATION_DATE) as date, COUNT(*) as count FROM donation";
if ($date) {
    $trends_query .= " WHERE DATE(DONATION_DATE) = '$date'";
}
$trends_query .= " GROUP BY DATE(DONATION_DATE) ORDER BY DATE(DONATION_DATE)";

$trends_result = $conn->query($trends_query);

while ($row = $trends_result->fetch_assoc()) {
    $chartData['trends']['dates'][] = $row['date'];
    $chartData['trends']['values'][] = (int)$row['count'];
}

// Prepare data for Donation By Center chart with center names
$centers_query = "SELECT dc.D_NAME AS Donation_Center, COUNT(*) as count 
                  FROM donation d
                  INNER JOIN donationcenter dc ON d.DONATION_CENTER = dc.D_ID";
if ($date) {
    $centers_query .= " WHERE DATE(d.DONATION_DATE) = '$date'";
}
$centers_query .= " GROUP BY dc.D_NAME";

$centers_result = $conn->query($centers_query);

while ($row = $centers_result->fetch_assoc()) {
    $chartData['centers']['labels'][] = $row['Donation_Center'];
    $chartData['centers']['values'][] = (int)$row['count'];
}

$data = [
    'stats' => $stats,
    'chartData' => $chartData
];

header('Content-Type: application/json');
echo json_encode($data);
?>
