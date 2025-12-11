<?php
    require 'search.php';

    $connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <header>
        <div class="logo-button">
            <a href="index.php"><img class="logo-img" src="./media/mini-logo.png" alt="logo"></a>
        </div>

        <input type="checkbox" id="nav-toggle" class="nav-toggle" hidden />
        <label for="nav-toggle" class="nav-toggle-label">
            <span></span>
            <span></span>
            <span></span>
        </label>

        <nav>
            <ul class="nav-links">
                <li><a href="help.html">Help</a></li>
            </ul>
        </nav>
    </header>
    <main class="search-results-main">
        <section class="top-container">
            <div class="large-logo-img">
                <img src="./media/large-logo.png" alt="Large logo for Re-Freshed">
            </div>

            <div class="text-container">
                <h2>Recipe Results</h2>
                <h4>Showing <b><?php echo htmlspecialchars($result_count)?></b> results for your search of <em>"<?php echo htmlspecialchars($_POST['search-bar'])?>"</em></h4>
            </div>
        </section>

        <section class="search-bar-container">
            <div class="search-text">
                <h2>
                    Search
                </h2>
            </div>
            <div>
                <form class="search-bar" action="search-results.php" method="POST">
                    <input class="search-input" id="search-input" type="search" name="search-bar" placeholder="Search..." aria-label="search-bar">
                      <button type="submit" class="search-submit-button">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                            </svg>
                      </button>
                </form>
            </div>
        </section>

        <section class="recipes-results-section">
            <!-- <article class="recipes-filter-section">
                <form class="recipe-filter-form" action="search-results.php" method="GET">
                    <input type="hidden" name="filters-form">
                    <fieldset>
                        <h4>Filter</h4>
                        <div class="filter-category">
                            <label>Cuisine:</label>
                                    <div class="checkbox-container">
                                    <label><input type="checkbox" name="cuisine" value="italian"> American</label>
                                    <label><input type="checkbox" name="cuisine" value="mexican"> Mexican</label>
                                    <label><input type="checkbox" name="cuisine" value="asian"> Asian</label>
                                    <label><input type="checkbox" name="cuisine" value="american">Italian</label>
                                    <label><input type="checkbox" name="cuisine" value="french">French</label>
                                    <label><input type="checkbox" name="cuisine" value="mediterranean">Mediterranean</label>
                                </div>
                        </div>
                        <div class="filter-category">
                            <label>Dietary Preferences:</label>
                            <div class="checkbox-container">
                                <label><input type="checkbox" name="diet" value="vegetarian"> Vegetarian</label>
                                <label><input type="checkbox" name="diet" value="meat">Meat</label>
                                <label><input type="checkbox" name="diet" value="seafood">Seafood</label>
                                <label><input type="checkbox" name="diet" value="vegetables">Vegetables</label>
                            </div>
                        </div>
                        <div class="filter-group">
                            <label><input type="submit"></label>
                        </div>
                    </fieldset>
                </form>
            </article> -->
            
            <div class="recipe-container">
                <?php
                if (isset($result) && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    $recipe_link = "recipe.php?id=" . $row['id'];
                    $image_folder = "./media/recipe-images/Recipe_" . $row['img_1'] . "_with_" . $row['img_2'];
                    $image_path = $image_folder . "/cover-photo.jpeg";
                ?>
                        
                    <div class="recipe-card">
                        <a href="<?php echo $recipe_link; ?>">
                            <div class="recipe-img">
                                <img src="<?php echo $image_path; ?>" alt="<?php echo $row['title'] . " cover image"; ?>">
                            </div>
                            <div class="recipe-name">
                                <h4><?php echo htmlspecialchars($row['title']); ?></h4>
                            </div>
                            <div class="recipe-description">
                                <p><?php echo "w/ " . htmlspecialchars($row['subheading']); ?></p>
                            </div>
                        </a>
                    </div>

                    <?php
                        }
                    } else {
                    ?> <div>
                            <h1>No recipes found.</h1>
                            <h4>Try searching for a different phrase</h4>
                        </div>
                    <?php
                        }
                        ?>
            </div>
        </section>
    </main>

    <footer>
        <img src="./media/large-logo-v2.png" alt="Large logo for Re-Freshed">
        <a href="help.html">Guide</a>
    </footer>
</body>
</html>