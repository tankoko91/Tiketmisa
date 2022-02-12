<?php
function getTimestamp(){
    $date = date_create(date('Y-m-d H:i:s'), timezone_open('Asia/Karachi'));
    date_timezone_set($date, timezone_open('Asia/Jakarta'));
    
    return date_format($date, 'Y-m-d H:i:s');
}
?>