if ($stmt->execute()) {

for ($x = 0; $x < count($product); $x++) { $query="SELECT price, promotion_price FROM products WHERE id=:id" ; $stmt=$con->prepare($query);
    $stmt->bindParam(':id', $product[$x]);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $num = $stmt->rowCount();

    if ($num > 0) {
    if ($row['promotion_price'] == 0) {
    $price = $row['price'];
    } else {
    $price = $row['promotion_price'];
    }
    }

    $price_each = ((float)$price * (int)$quantity[$x]);

    $query = "UPDATE order_detail SET product_id=:product_id, quantity=:quantity, price_each=:price_each
    WHERE order_detail_id=:order_detail_id";

    $stmt = $con->prepare($query);
    $stmt->bindParam(':product_id', $product[$x]);
    $stmt->bindParam(':quantity', $quantity[$x]);
    $stmt->bindParam(':order_detail_id', $order_detail_id[$x]);
    $stmt->bindParam(':price_each', $price_each);
    $stmt->execute();
    }
    echo "<div class='alert alert-success'>Record was updated.</div>";
    } else {
    echo "<div class='alert alert-danger'>Unable to update total_amount.</div>";
    }