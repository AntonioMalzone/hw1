<?php
require_once 'auth.php';
if (!$userid = checkAuth())
    exit;
$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
$userid = mysqli_real_escape_string($conn, $userid);
$movieid = mysqli_real_escape_string($conn, $_POST['movieid']);
$title = mysqli_real_escape_string($conn, $_POST['title']);
$image = mysqli_real_escape_string($conn, $_POST['image']);
$query = "SELECT * FROM movies WHERE user = '$userid' AND JSON_CONTAINS(content, '{\"id\":\"" . $movieid . "\"}')";
$res = mysqli_query($conn, $query) or die(mysqli_error($conn));
if (mysqli_num_rows($res) > 0) {
    echo json_encode(array('ok' => true));
    mysqli_close($conn);
    exit;
}
$query = "INSERT INTO movies(user, content) VALUES('$userid', JSON_OBJECT('id', '$movieid', 'title', '$title','image', '$image'))";
error_log($query);
if (mysqli_query($conn, $query) or die(mysqli_error($conn))) {
    echo json_encode(array('ok' => true));
    mysqli_close($conn);
    exit;
}
mysqli_close($conn);
echo json_encode(array('ok' => false));
exit;