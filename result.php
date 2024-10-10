<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$input1 = $_POST["input1"];
$operator1 = $_POST['operator1'];
$input2 = $_POST['input2'];
$operator2 = $_POST['operator2'];
$input3 = $_POST['input3'];


if (!is_numeric($input1) || !is_numeric($input2) || !is_numeric($input3) ||
!in_array($operator1, ['+', '-', '*', '/']) || !in_array($operator2, ['+', '-', '*', '/'])) {
echo "ERROR: Invalid input. Please enter numbers and valid operators (+, -, *, /).";
exit;
}


$input1 = floatval($input1);
$input2 = floatval($input2);
$input3 = floatval($input3);
$final_result=0;
$temp_result=0;
    // Handle cases where the first operator is addition or subtraction and the second is multiplication or division
    if (($operator1 == '+' || $operator1 == '-') && ($operator2 == '*' || $operator2 == '/')) {
        // First apply the second operator between num2 and num3
        if ($operator2 == '*') {
            $temp_result = $input2 * $input3;
        } elseif ($operator2 == '/') {
            $temp_result = $input2 / $input3;
        }

        // Then apply the first operator between num1 and the result of num2 op2 num3
        if ($operator1 == '+') {
            $final_result = $input1 + $temp_result;
        } elseif ($operator1 == '-') {
            $final_result = $input1 - $temp_result;
        }
    } else {
        // If the first operator has higher precedence, apply it first
        // First apply the first operator between num1 and num2
        if ($operator1 == '+') {
            $temp_result = $input1 + $input2;
        } elseif ($operator1 == '-') {
            $temp_result = $input1 - $input2;
        } elseif ($operator1 == '*') {
            $temp_result = $input1 * $input2;
        } elseif ($operator1 == '/') {
            $temp_result = $input1 / $input2;
        }

        // Then apply the second operator between the result and num3
        if ($operator2 == '+') {
            $final_result = $temp_result + $input3;
        } elseif ($operator2 == '-') {
            $final_result = $temp_result - $input3;
        } elseif ($operator2 == '*') {
            $final_result = $temp_result * $input3;
        } elseif ($operator2 == '/') {
            $final_result = $temp_result / $input3;
        }
    }


echo "Result: " . number_format($final_result, 10, '.', '');
}
