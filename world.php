<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);


// get request for search world
if(isset($_GET['country'])){

  $country = trim_input($_GET['country']); //Sanitize the user input

  if (isset($_GET['context'])) {

    $stmt = $conn->query("SELECT i.name, i.population, i.district, c.code
    FROM cities i
    JOIN countries c
    ON c.code = i.country_code WHERE c.name LIKE '%$country%' ");

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    ?>
    <table id="table">
      <thead>
          <th>Name</th>
          <th>District</th>
          <th>Population</th>
      </thead>
      <tbody>
      <?php    
        foreach ($results as $row) { ?>
        <tr>
            <td><?php echo $row['name'] ; ?></td>
            <td><?php echo $row['district'] ; ?></td>
            <td><?php echo $row['population'] ; ?></td>
        </tr>
      <?php
      }
      ?>
      </tbody>
    </table> 
  
  <?php
  }else{
    $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    ?>
    <table id="table">
      <thead>
          <th>Name</th>
          <th>Continent</th>
          <th>Independence</th>
          <th>Head of State</th>
      </thead>
      <tbody>
      <?php    
        foreach ($results as $row) { ?>
        <tr>
            <td><?php echo $row['name'] ; ?></td>
            <td><?php echo $row['continent'] ; ?></td>
            <td><?php echo $row['independence_year'] ; ?></td>
            <td><?php echo $row['head_of_state']; ?></td>
        </tr>
      <?php
      }
      ?>
      </tbody>
    </table> 
  <?php
  }
}

//Sanitize the user input from the search text field
function trim_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
