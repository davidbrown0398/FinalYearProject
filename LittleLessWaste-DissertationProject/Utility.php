<?php

// ****FILE NO LONGER IN USE/NOT NEEDED*****

include('conn.php');

class Utility
{
    function sanitizeData($data)
    {
        // global used to import the $conn variable
        global $conn;
        $data = $conn->real_escape_string($data); // prevent SQL Injection
        $data = htmlentities($data);   // prevent XSS

        return $data;
    }
}
