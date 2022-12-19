<?php

// include database connection
include 'config/database.php';

try {

    // get record ID
    // isset() is a PHP function used to verify if a value is there or not
    //get user id from url
    $customer_id = isset($_GET['customer_id']) ? $_GET['customer_id'] :
        die('ERROR: Record Customer ID not found.');

    // delete query
    // add where to check whether the customer id exist in order summary 
    $query = "SELECT o.customer_id, c.customer_id FROM order_summary o INNER JOIN customers c ON c.customer_id = o.customer_id WHERE c.customer_id = ? LIMIT 0,1";
    $stmt = $con->prepare($query);
    $stmt->bindParam(1, $customer_id);
    $stmt->execute();
    $num = $stmt->rowCount();

    //if num > 0 means it found related info in database
    if ($num > 0) {
        header('Location:customers_read.php?action=failed');
    } else {
        $query = "DELETE FROM customers WHERE customer_id = ?";
        $stmt = $con->prepare($query);
        $stmt->bindParam(1, $customer_id);

        if ($stmt->execute()) {
            header('Location:customers_read.php?action=deleted');
        } else {
            die('Unable to delete record.');
        }
    }
}

// show error

catch (PDOException $exception) {
    die('ERROR: ' . $exception->getMessage());
}
