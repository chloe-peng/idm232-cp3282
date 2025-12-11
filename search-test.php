<?php
    require 'db.php';

  // processing data from search
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $search = '%'. $_POST['search-bar'] . '%' ?? '';
    $sql = "SELECT * FROM recipes WHERE ";

    $param = [];
    $type = '';

    if ($search !== '') {
      $sql .= "
          title LIKE ?
          OR subheading LIKE ?
          OR filters LIKE ?
          OR tags LIKE ?
          OR description LIKE ?
          OR ingredients LIKE ?
          OR recipe LIKE ?";
      for ($i = 0; $i < 7; $i++) {
          $params[] = $search;
          $type .= "s";
      }
    }

    $filter = '%' . $_GET['filters'] . '%' ?? '';
    if (!empty($filters)) {
      
    }

    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sssssss", $search, $search, $search, $search, $search, $search, $search);
    $stmt->execute();
    $result = $stmt->get_result();
    $result_count = $result->num_rows;
  }

?>