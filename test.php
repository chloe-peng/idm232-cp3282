<?php
// View details about the server
// print_r($_SERVER);

// Load environment variables
$env_vars = [
    'DB_SERVER'   => $_SERVER['REDIRECT_DB_SERVER']   ?? $_SERVER['DB_SERVER']   ?? null,
    'DB_USERNAME' => $_SERVER['REDIRECT_DB_USERNAME'] ?? $_SERVER['DB_USERNAME'] ?? null,
    'DB_PASSWORD' => $_SERVER['REDIRECT_DB_PASSWORD'] ?? $_SERVER['DB_PASSWORD'] ?? null,
    'DB_NAME'     => $_SERVER['REDIRECT_DB_NAME']     ?? $_SERVER['DB_NAME']     ?? null
];

if (in_array(null, $env_vars, true))
    die('Missing required environment variables');

define('DB_SERVER', $env_vars['DB_SERVER']);
define('DB_USER',   $env_vars['DB_USERNAME']);
define('DB_PASS',   $env_vars['DB_PASSWORD']);
define('DB_NAME',   $env_vars['DB_NAME']);

// Create database connection 
$connection = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

if ($connection->connect_error)
    die("Connection failed: " . $connection->connect_error);

?>

$search_query = 'apple';
// Assume $all_products is an array of arrays/objects fetched from the DB
// $all_products = [ ['name' => 'Red delicious apple'], ['name' => 'Orange Juice'], ... ];

$filtered_results = array_filter($all_products, function ($product) use ($search_query) {
    // Check if the search query is found anywhere in the 'name' column
    // stripos() returns 0 for a match at the start of the string, or other positive integers
    // We use !== false to catch all valid match positions, including 0
    if (stripos($product['name'], $search_query) !== false) {
        return true; // Keep this row
    }
    return false; // Filter this row out
});

// $filtered_results now contains only the rows matching the search query
