<!-- header -->
<?php include('header.php') ?>


<?php

$sql = "SELECT * FROM forms";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "نام فرم: " . $row["title"]."<br/>";
  }
} else {
  echo "0 results";
}
$conn->close();

?>


<!-- footer -->
<?php include('footer.php') ?>
