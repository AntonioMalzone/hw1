<?php
require_once 'auth.php';
if (!$userid = checkAuth())
    exit;
header('Content-Type: application/json');
$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
$userid = mysqli_real_escape_string($conn, $userid);
$query = "SELECT user AS userid, id AS id, content AS content from movies where user = $userid";
$res = mysqli_query($conn, $query) or die(mysqli_error($conn));
$movieArray = array();
while ($entry = mysqli_fetch_assoc($res)) {
    $movieArray[] = array(
        'userid' => $entry['userid'],
        'id' => $entry['id'],
        'content' => json_decode($entry['content'])
    );
}
echo json_encode($movieArray);
mysqli_close($conn);
exit;
?>