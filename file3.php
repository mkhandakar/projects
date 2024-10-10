<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Button Click with Table</title>
</head>
<body>

<?php
session_start();


if (!isset($_SESSION["board"])) {
$_SESSION["board"] = [
"1-1" => "-",
"1-2" => "-",
"1-3" => "-",
"2-1" => "-",
"2-2" => "-",
"2-3" => "-",
"3-1" => "-",
"3-2" => "-",
"3-3" => "-"
];
$_SESSION["turn"] = 0; // Track turns
$_SESSION["winner"] = null;
}

$winner = null;


if (isset($_POST['button_id']) && $_SESSION["winner"] === null) {
$buttonId = $_POST['button_id'];


if ($_SESSION["board"][$buttonId] === "-") {
$_SESSION["turn"] += 1;


if ($_SESSION["turn"] % 2 == 1) {
$_SESSION["board"][$buttonId] = "X";
} else {
$_SESSION["board"][$buttonId] = "O";
}


$winner = whoIsWinner();
if ($winner !== null) {
$_SESSION["winner"] = $winner;
echo "<p>Player $winner wins!</p>";
}
}
}


function checkWhoHasTheSeries($list) {
$XCount = 0;
$OCount = 0;
foreach ($list as $value) {
if ($_SESSION["board"][$value] == 'X') {
$XCount++;
} elseif ($_SESSION["board"][$value] == 'O') {
$OCount++;
}
}
if ($XCount == 3)
return 'X';
elseif ($OCount == 3)
return 'O';
else
return null;
}

function whoIsWinner() {
// 1 of 8: top row
$winner = checkWhoHasTheSeries(['1-1', '2-1', '3-1']);
if ($winner != null) return $winner;
// 2 of 8: middle row
$winner = checkWhoHasTheSeries(['1-2', '2-2', '3-2']);
if ($winner != null) return $winner;
// 3 of 8: bottom row
$winner = checkWhoHasTheSeries(['1-3', '2-3', '3-3']);
if ($winner != null) return $winner;
// 4 of 8: left column
$winner = checkWhoHasTheSeries(['1-1', '1-2', '1-3']);
if ($winner != null) return $winner;
// 5 of 8: middle column
$winner = checkWhoHasTheSeries(['2-1', '2-2', '2-3']);
if ($winner != null) return $winner;
// 6 of 8: right column
$winner = checkWhoHasTheSeries(['3-1', '3-2', '3-3']);
if ($winner != null) return $winner;
// 7 of 8: diagonal left to right
$winner = checkWhoHasTheSeries(['1-1', '2-2', '3-3']);
if ($winner != null) return $winner;
// 8 of 8: diagonal right to left
$winner = checkWhoHasTheSeries(['3-1', '2-2', '1-3']);
if ($winner != null) return $winner;
return null; // It's a draw
}
?>


<table>
<tr>
<td>
<form method="POST">
<button type="submit" name="button_id" value="1-1"><?php echo $_SESSION["board"]["1-1"]; ?></button>
</form>
</td>
<td>
<form method="POST">
<button type="submit" name="button_id" value="1-2"><?php echo $_SESSION["board"]["1-2"]; ?></button>
</form>
</td>
<td>
<form method="POST">
<button type="submit" name="button_id" value="1-3"><?php echo $_SESSION["board"]["1-3"]; ?></button>
</form>
</td>
</tr>
<tr>
<td>
<form method="POST">
<button type="submit" name="button_id" value="2-1"><?php echo $_SESSION["board"]["2-1"]; ?></button>
</form>
</td>
<td>
<form method="POST">
<button type="submit" name="button_id" value="2-2"><?php echo $_SESSION["board"]["2-2"]; ?></button>
</form>
</td>
<td>
<form method="POST">
<button type="submit" name="button_id" value="2-3"><?php echo $_SESSION["board"]["2-3"]; ?></button>
</form>
</td>
</tr>
<tr>
<td>
<form method="POST">
<button type="submit" name="button_id" value="3-1"><?php echo $_SESSION["board"]["3-1"]; ?></button>
</form>
</td>
<td>
<form method="POST">
<button type="submit" name="button_id" value="3-2"><?php echo $_SESSION["board"]["3-2"]; ?></button>
</form>
</td>
<td>
<form method="POST">
<button type="submit" name="button_id" value="3-3"><?php echo $_SESSION["board"]["3-3"]; ?></button>
</form>
</td>
</tr>
</table>

<!-- Reset the game after a winner is declared -->
<?php
if ($_SESSION["winner"] !== null) {
echo '<form method="POST">
<button type="submit" name="reset" value="1">Restart Game</button>
</form>';
}


if (isset($_POST['reset'])) {
session_destroy();
header("Location: " . $_SERVER['PHP_SELF']); // Refresh page
exit();
}
?>

</body>
</html>