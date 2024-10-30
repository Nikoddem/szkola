<?php
// Tablica zdjęć
$photos = [
    ['img_id'=>1, 'img'=>'img/img1.jpg', 'opis'=>'A beautiful sunset.', 'category_id'=>1],
    ['img_id'=>2, 'img'=>'img/img2.jpg', 'opis'=>'A serene beach.', 'category_id' => 2],
    ['img_id'=>3, 'img'=>'img/img3.jpg', 'opis'=>'A blooming flower.', 'category_id' => 3],
    ['img_id'=>4, 'img'=>'img/img4.jpg', 'opis'=>'Snow-covered mountains.', 'category_id' => 1],
    ['img_id'=>5, 'img'=>'img/img5.jpg', 'opis'=>'A forest in autumn.', 'category_id' => 3],
    ['img_id'=>6, 'img'=>'img/img6.jpg', 'opis'=>'City skyline at night.', 'category_id' => 2],
    ['img_id'=>7, 'img'=>'img/img7.jpg', 'opis'=>'A waterfall flowing.', 'category_id' => 3],
    ['img_id'=>8, 'img'=>'img/img8.jpg', 'opis'=>'A boat on a calm lake.', 'category_id' => 1],
    ['img_id'=>9, 'img'=>'img/img9.jpg', 'opis'=>'A field of lavender.', 'category_id' => 2],
    ['img_id'=>10, 'img'=>'img/img10.jpg', 'opis'=>'A snowy forest.', 'category_id'=>1],
    ['img_id'=>11, 'img'=>'img/img11.jpg', 'opis'=>'Aerial view of coral.', 'category_id'=>3],
    ['img_id'=>12, 'img'=>'img/img12.jpg', 'opis'=>'Market square.', 'category_id' => 3],
];

// Tablica kategorii
$categories = [
    ['category_id'=>1, 'name'=>'Nature'],
    ['category_id'=>2, 'name'=>'Cityscapes'],
    ['category_id'=>3, 'name'=>'Wildlife'],
    ['category_id'=>4, 'name'=>'New']
];

// Funkcja zwracająca nazwę kategorii na podstawie jej ID
function getCategoryName($category_id, $categories) {
    foreach ($categories as $category) {
        if ($category['category_id'] == $category_id) {
            return $category['name'];
        }
    }
    return 'Unknown';
}

// Sprawdzenie, czy przekazano identyfikator zdjęcia w zmiennej GET
if (isset($_GET['img_id'])) {
    $img_id = (int)$_GET['img_id'];

    // Wyszukaj zdjęcie o podanym ID
    foreach ($photos as $photo) {
        if ($photo['img_id'] == $img_id) {
            // Wyświetl powiększone zdjęcie
            $category_name = getCategoryName($photo['category_id'], $categories);
            echo '<h2>' . $photo['opis'] . '</h2>';
            echo '<img src="' . $photo['img'] . '" style="width:500px;"><br>';
            echo '<p>Kategoria: <a href="?id=4&category_id='.$photo['category_id'].'">'.getCategoryName($photo['category_id'], $categories).'</a></p>';
            echo '<a href="?id=4">Back to gallery</a>';
        }
    }
} else {
    // Sprawdzenie, czy przekazano identyfikator kategorii w zmiennej GET
    if (isset($_GET['category_id'])) {
        $category_id = (int)$_GET['category_id'];

        // Wyświetl miniatury tylko z wybranej kategorii
        echo '<h2>Photos in ' . getCategoryName($category_id, $categories) . '</h2>';
        echo '<div style="display: flex; flex-wrap: wrap;">';

        $counter = 0;
        foreach ($photos as $photo) {
            if ($photo['category_id'] == $category_id) {
                if ($counter % 3 == 0 && $counter > 0) {
                    echo '<div style="flex-basis: 100%; height: 0;"></div>'; // Nowy wiersz po 3 miniaturach
                }
                echo '<div style="margin: 5px; text-align: center; flex-basis: 30%;">';
                echo '<a href="?id=4&img_id=' . $photo['img_id'] . '">';
                echo '<img src="' . $photo['img'] . '" style="width:150px; height:auto;"><br>';
                echo '</a>';
                echo '<p>' . $photo['opis'] . '</p>';
                echo '<p>Category: <a href="?id=4&category_id='.$photo['category_id'].'">'.getCategoryName($photo['category_id'], $categories).'</a></p>';
                echo '</div>';
                $counter++;
            }
        }

        echo '</div>';
    } else {
        // Wyświetlanie galerii wszystkich zdjęć, jeśli nie wybrano kategorii
        echo '<h2>All Photos</h2>';
        echo '<div style="display: flex; flex-wrap: wrap;">';

        $counter = 0;
        foreach ($photos as $photo) {
            if ($counter % 3 == 0 && $counter > 0) {
                echo '<div style="flex-basis: 100%; height: 0;"></div>'; // Nowy wiersz po 3 miniaturach
            }
            echo '<div style="margin: 5px; text-align: center; flex-basis: 30%;">';
            echo '<a href="?id=4&img_id=' . $photo['img_id'] . '">';
            echo '<img src="' . $photo['img'] . '" style="width:150px; height:auto;"><br>';
            echo '</a>';
            echo '<p>' . $photo['opis'] . '</p>';
            echo '<p>Category: <a href="?id=4&category_id='.$photo['category_id'].'">'.getCategoryName($photo['category_id'], $categories).'</a></p>';
            echo '</div>';
            $counter++;
        }

        echo '</div>';
    }
}
?>