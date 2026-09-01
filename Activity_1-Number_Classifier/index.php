<?php
$num = $_GET['num'];

if ($num > 0) {
    echo "Positive and " . ($num % 2 == 0 ? "Even" : "Odd");
} else if ($num < 0) {
    echo "Negative";
} else {
    echo "Zero";
}
