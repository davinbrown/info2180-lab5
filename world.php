<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$stmt = $conn->query("SELECT * FROM countries");

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);


// get request 
if(isset($_GET['country'])){
  $country = trim_input($_GET['country']); //Sanitize the user input
  $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<ul>
<?php foreach ($results as $row): ?>
  <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
<?php endforeach; ?>
</ul>

<?php
//Sanitize the user input from the search text field
function trim_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
