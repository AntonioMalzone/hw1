<?php

if (!empty($_POST["search"])) {
   $ch = curl_init();
   $url = "https://imdb-api.com/en/API/SearchMovie/k_zx6a70e1/" . rawurlencode($_POST["search"]);
   curl_setopt($ch, CURLOPT_URL, $url);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   echo curl_exec($ch);
   curl_close($ch);
}
?>