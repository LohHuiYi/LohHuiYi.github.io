<?php if (htmlspecialchars($promotion_price, ENT_QUOTES) == NULL ) {
    echo "-";
} else {
    echo number_format((float)htmlspecialchars($promotion_price, ENT_QUOTES), 2, '.', '');
}
