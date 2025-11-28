<?php
include 'db.php';

$id = $_GET['id'];

$stmt = $connection->prepare("SELECT * FROM recipes WHERE id = ?");
    $stmt->bind_param("i", $id); 
    $stmt->execute();
    $result = $stmt->get_result();

$recipe = $result->fetch_assoc();

$recipe_title = $recipe['title'];
$recipe_subheading = $recipe['subheading'];
$recipe_time = $recipe['time'];
$recipe_serving = $recipe['serving'];
$recipe_filters = $recipe['filters'];
$recipe_tags = $recipe['tags'];
$recipe_description = $recipe['description'];
$recipe_ingredients = $recipe['ingredients'];
$recipe_tool = $recipe['tool'];
$recipe_recipe = $recipe['recipe'];
$recipe_tip = $recipe['tip'];
$image_folder_link = "./media/recipe-images/Recipe_" . $recipe['img_1'] . "_with_" . $recipe['img_2'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe</title>
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
                <li><a href="all-recipes.html">All Recipes</a></li>
                <li><a href="help.html">Help</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="recipe-hero">
            <div class="recipe-hero-left">
                <div class="recipe-title">
                    <h1><?php echo htmlspecialchars($recipe_title)?></h1>
                </div>
                <div class="recipe-subtitle">
                    <h3><?php echo "w/ " . htmlspecialchars($recipe_subheading)?></h3>
                </div>
                <div class="recipe-description">
                    <p><?php echo htmlspecialchars($recipe_description)?></p>
                </div>
            </div>
            <div class="recipe-hero-right">
                <div class="recipe-cover-img">
                    <img src="<?php echo $image_folder_link . "/cover-photo.jpeg";?>" alt="<?php echo $recipe_title . " cover image"?>">
                </div>
            </div>
        </section>

        <section class="recipe-containers">
            <div class="recipe-information-left">
                <div class="recipe-heading">
                    <h2>Ingredients</h2>
                </div>
                <div class="recipe-ingredients-list">
                    <ul>
                    <?php 
                        $ingredients = explode("\n", $recipe_ingredients);
                        foreach ($ingredients as $item) {
                            echo "<li>$item</li>";
                        }
                    ?>
                    </ul>
                </div>
            </div>
            <div class="recipe-information-right">
                <div class="recipe-img">
                    <img src="<?php $image_link = $image_folder_link . "/ingredients.png"; echo $image_link;?>" alt="<?php echo "Ingredients for " . $recipe_title;?>">
                </div>
            </div>
        </section>    
        <section>
            <h1>Steps</h1>
        </section>       
        <section class="recipe-containers">
                <?php 
                    $step_number = 1;
                    $recipe_steps = explode("*", $recipe_recipe);
                    foreach ($recipe_steps as $step) {
                ?>
                <div class="recipe-information-left">
                    <div class="recipe-heading">
                        <h3><?php echo htmlspecialchars($step_number)?> </h3>
                    </div>
                    <div class="recipe-steps">
                        <p><?php echo htmlspecialchars($step) ?></p>
                    </div>
                </div>
                <div class="recipe-information-right">
                    <div class="recipe-img">
                        <img src="<?php $image_link = $image_folder_link . "/step-" . $step_number . ".jpeg"; echo $image_link; ?>" alt="<?php "Image of step " . $step_number . " of recipe" ?>">
                    </div>
                </div>
                <?php
                    $step_number += 1;
                    }
                ?>
        </section>
        <section class="recipe-conclusion">
            <h1>And you're done!</h1>
        </section>
    </main>
</body>
</html>