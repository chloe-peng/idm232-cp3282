<?php
require 'db.php';
include 'filters.php';

if (!isset($result)) {
    $stmt = $connection->prepare("SELECT * FROM recipes");
    $stmt->execute();
    $result = $stmt->get_result();
    $result_count = $result->num_rows;
}

$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
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

    <main class="home-main">
        <section class="home-hero">
            <div class="large-logo-img">
                <img src="./media/large-logo.png" alt="Large logo for Re-Freshed">
            </div>

            <!-- <div class="home-hero-descrip">
                <h4>What's on the menu today? Find your next recipe with items in your fridge!</h4>
            </div> -->
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

        <section id="all-recipes">
            <h2>All Recipes</h2>
                <?php if (isset($_GET['filter']) && $_GET['filter'] !== 'all'): ?>
                    <div>
                        <h4>
                            Showing <b><?php echo htmlspecialchars($result_count); ?></b> results for 
                            <em>"<?php echo htmlspecialchars($_GET['filter']); ?>"</em>
                        </h4>
                    </div>
                <?php endif; ?>

            <form class="recipe-filters" action="index.php#all-recipes" method="GET">
                <button type="submit" name="filter" value="all">All</button>
                <button type="submit" name="filter" value="meat">Meat</button>
                <button type="submit" name="filter" value="vegetables">Vegetables</button>
                <button type="submit" name="filter" value="vegetarian">Vegetarian</button>
                <button type="submit" name="filter" value="chicken">Chicken</button>
                <button type="submit" name="filter" value="seafood">Seafood</button>
                <button type="submit" name="filter" value="beef">Beef</button>
                <button type="submit" name="filter" value="pork">Pork</button>

                <button type="submit" name="filter" value="american">American</button>
                <button type="submit" name="filter" value="mexican">Mexican</button>
                <button type="submit" name="filter" value="mexican">Italian</button>
                <button type="submit" name="filter" value="asian">Asian</button>
                <button type="submit" name="filter" value="french">French</button>
                <button type="submit" name="filter" value="mediterranean">Mediterranean</button>
            </form>
        </section>

        <section class="recipes-section remove-border">
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
                                <div class="recipe-subheading">
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

    <footer>
        <img src="./media/large-logo-v2.png" alt="Large logo for Re-Freshed">
        <a href="help.html">Guide</a>
    </footer>
</body>

</html>