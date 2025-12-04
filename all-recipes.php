<?php
    require 'db.php';

    $stmt = $connection->prepare("SELECT * FROM recipes");
$stmt->execute();
$result = $stmt->get_result();
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
                <li><a href="all-recipes.php">All Recipes</a></li>
                <li><a href="help.html">Help</a></li>
            </ul>
        </nav>
    </header>
    <section class="top-container">
        <div class="text-container">
            <h2>Search Results</h2>
            <h4>Showing # of results for your search</h4>
        </div>
    </section>

    <main>
    <section class="side-bar recipes-section">
        <section class="recipes-filter-section">
            <form class="recipe-filter-form" action="/recipes" method="GET">
                <fieldset>
                    <h4>Filter Recipes</h4>

                    <div class="search-bar-container">
                        <input class="search-input" id="search-input" type="search" name="search-bar" placeholder="Search..." aria-label="search">
                    </div>
                    <div class="filter-category">
                        <label>Cuisine:</label>
                                <div class="checkbox-container">
                                <label><input type="checkbox" name="cuisine" value="italian"> Italian</label>
                                <label><input type="checkbox" name="cuisine" value="mexican"> Mexican</label>
                                <label><input type="checkbox" name="cuisine" value="asian"> Asian</label>
                                <label><input type="checkbox" name="cuisine" value="american"> American</label>
                            </div>
                    </div>
                    <div class="filter-category">
                        <label>Dietary Preferences:</label>
                        <div class="checkbox-container">
                            <label><input type="checkbox" name="diet" value="vegan"> Vegan</label>
                            <label><input type="checkbox" name="diet" value="vegetarian"> Vegetarian</label>
                            <label><input type="checkbox" name="diet" value="gluten-free"> Meat</label>
                        </div>
                    </div>
                    <div class="filter-category">
                        <label>Meal Type:</label>
                        <div class="checkbox-container">
                            <label><input type="checkbox" name="meal" value="breakfast"> Breakfast</label>
                            <label><input type="checkbox" name="meal" value="lunch"> Lunch</label>
                            <label><input type="checkbox" name="meal" value="dinner"> Dinner</label>
                            <label><input type="checkbox" name="meal" value="snack"> Snack</label>
                        </div>
                    </div>
                    <!-- <div class="filter-group">
                        <button type="submit">Apply Filters</button>
                        <button type="reset">Reset</button>
                    </div> -->
                </fieldset>
            </form>
        </section>
            <div class="recipe-container">
                <?php
                if ($result->num_rows > 0) {
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
                          echo "<p>No recipes found.</p>";
                      }
                    ?>
            </div>
        </section>
    </main>
</body>
</html>