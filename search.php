<?php
    require 'db.php';

  // Processing data from a login form
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $search = '%'. $_POST['search-bar'] .'%' ?? '';



    $stmt = $connection->prepare("SELECT * FROM recipes
        WHERE title LIKE ?
        OR subheading LIKE ?
        OR filters LIKE ?
        OR tags LIKE ?
        OR description LIKE ?
        OR ingredients LIKE ?
        OR recipe LIKE ?");

    $stmt->bind_param("sssssss", $search, $search, $search, $search, $search, $search, $search);
    $stmt->execute();
    $result = $stmt->get_result();
  }

?>