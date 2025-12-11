<?php 
    if ((isset($_GET['filter'])) && ($_GET['filter'] === 'all')) {
        $stmt = $connection->prepare("SELECT * FROM recipes");
        $stmt->execute();
        $result = $stmt->get_result();

        $result_count = $result->num_rows;
    }
    
    else if ((isset($_GET['filter'])) && ($_GET['filter'] !== 'all')) {
        $filter_term = $_GET['filter'];
        $filter = '%' . $filter_term . '%';

        $stmt = $connection->prepare("SELECT * FROM recipes
            WHERE title LIKE ?
            OR subheading LIKE ?
            OR filters LIKE ?
            OR tags LIKE ?
            OR description LIKE ?
            OR ingredients LIKE ?
            OR recipe LIKE ?");
        
        $stmt->bind_param("sssssss", $filter, $filter, $filter, $filter, $filter, $filter, $filter);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $result_count = $result->num_rows;
    }
?>