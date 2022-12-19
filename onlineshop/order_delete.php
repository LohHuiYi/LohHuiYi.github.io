<?php

// include database connection
include 'config/database.php';

try {

    // get record ID
    // isset() is a PHP function used to verify if a value is there or not
    //get user id from url
    $order_id = isset($_GET['order_id']) ? $_GET['order_id'] :
        die('ERROR: Order ID not found.');

    // delete query

    // first delete from details then delete from summary

    $query = "DELETE FROM order_details WHERE order_id = ?";

    $stmt = $con->prepare($query);

    $stmt->bindParam(1, $order_id);

    if ($stmt->execute()) {

        $query = "DELETE FROM order_summary WHERE order_id = ?";

        $stmt = $con->prepare($query);

        $stmt->bindParam(1, $order_id);

        if ($stmt->execute()) {

            // redirect to read records page and
            // tell the user record was deleted
            header('Location:order_read.php?action=deleted');
        } else {
            die('Unable to delete record.');
        }
    } else {
        die('Unable to delete record.');
    }
}

// show error

catch (PDOException $exception) {
    die('ERROR: ' . $exception->getMessage());
}
