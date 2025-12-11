<?php
require 'db.php';

// Get the search term
$search_term = $_GET['q'] ?? '';
$search_like = '%' . $search_term . '%';

// Arrays to hold conditions and parameters
$conditions = [];
$params = [];
$types = '';

if (!empty($search_term)) {
    $conditions[] = "(title LIKE ? OR subheading LIKE ? OR filters LIKE ? OR tags LIKE ? OR description LIKE ? OR ingredients LIKE ? OR recipe LIKE ?)";
    // Add 7 copies of the search term for the placeholders
    for ($i = 0; $i < 7; $i++) {
        $params[] = $search_like;
        $types .= 's';
    }
}

// Cuisine filters
if (!empty($_GET['cuisine']) && is_array($_GET['cuisine'])) {
    $cuisine_conditions = [];
    foreach ($_GET['cuisine'] as $cuisine) {
        $cuisine_conditions[] = "filters LIKE ?";
        $params[] = '%' . $cuisine . '%';
        $types .= 's';
    }
    if (!empty($cuisine_conditions)) {
        $conditions[] = "(" . implode(" OR ", $cuisine_conditions) . ")";
    }
}

// Diet filters
if (!empty($_GET['diet']) && is_array($_GET['diet'])) {
    $diet_conditions = [];
    foreach ($_GET['diet'] as $diet) {
        $diet_conditions[] = "filters LIKE ?";
        $params[] = '%' . $diet . '%';
        $types .= 's';
    }
    if (!empty($diet_conditions)) {
        $conditions[] = "(" . implode(" OR ", $diet_conditions) . ")";
    }
}

$sql = "SELECT * FROM recipes";
if (!empty($conditions)) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}

$stmt = $connection->prepare($sql);
if (!empty($params)) {
    // Convert $params array to references for bind_param
    $refs = [];
    foreach ($params as $key => $value) {
        $refs[$key] = &$params[$key];
    }
    array_unshift($refs, $types); // add types at the start
    call_user_func_array([$stmt, 'bind_param'], $refs);
}

$stmt->execute();
$result = $stmt->get_result();
$result_count = $result->num_rows;

?>