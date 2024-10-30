<?php
$podstrony = [
    1 => [
        'nazwa' => 'Strona główna',
        'tresc' => 'Witamy na naszej stronie głównej! Znajdziesz tutaj najnowsze informacje i aktualności.'
    ],
    2 => [
        'nazwa' => 'O nas',
        'tresc' => 'Jesteśmy firmą zajmującą się tworzeniem innowacyjnych rozwiązań dla biznesu.'
    ],
    3 => [
        'nazwa' => 'Kontakt',
        'tresc' => 'Skontaktuj się z nami przez formularz lub telefonicznie. Czekamy na Twoje wiadomości!'
    ],
    4 => [
        'nazwa' => 'Galeria',
        'tresc' => 'To się nie wyświetli'
    ],
];
// Pobieranie id podstrony z URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 1; // Domyślnie ustawiamy na 1

// Sprawdzanie, czy podstrona o danym ID istnieje
if (!isset($podstrony[$id])) {
    $id = 1; // Ustawienie domyślnej podstrony, jeśli ID jest nieprawidłowe
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Strona 1</title>
	<style type="text/css">
	@media only screen and (min-width: 900px) {
		#kontener { width: 850px; margin: 0 auto 0 auto; }
		main { float: left; width: 70%; }
		aside { float: right; width: 28%; }
		footer { clear: both; }
		}
	</style>
</head>
<body>
	<div id="kontener">
		<header>
			<h1>Witaj na mojej stronie!</h1>
		</header>
		<div>
			<main>
				<article>
					<?php 
                    if ($id!=4){
                        echo '<h2>'.$podstrony[$id]['nazwa'].'</h2>'; 
                        echo '<p>'.$podstrony[$id]['tresc'].'</p>';
                    }
                    else {
                        echo '<h2>'.$podstrony[$id]['nazwa'].'</h2>';
                        include ('gallery.php');  
                    }
                    ?>
					
				</article>
				<article>
					<h2>Stały artykuł</h2>
					<p>Nam id rutrum velit. Ut gravida tristique neque et pretium. Sed eget viverra orci. </p>
                    <p>Praesent vulputate, mi id auctor commodo, sapien augue rhoncus justo, non malesuada nibh diam nec dolor. </p>
				</article>
			
			</main>
			<aside>
				<nav>
					<h3>Menu</h3>
					<ul>
                        <?php foreach ($podstrony as $key => $podstrona): ?>
                            <li><a href="?id=<?php echo $key; ?>"><?php echo $podstrona['nazwa']; ?></a></li>
                        <?php endforeach; ?>
                            <li><a href="http://zszwolsztyn.pl">ZSZ</a></li>
					</ul>
				</nav>
				<section>
					<h3>Reklamy</h3>
					<p>Pozdrowienia dla 4P...</p>
				</section>
				<section>
					<h3>Social media</h3>
					<p>nikodemto</p>
				</section>
			</aside>
		</div>
		<footer>
			<div> pk.sth © 2024</div>
			<div>Strona o niczym by PK przygotowane specjalnie dla 4I. Lorem ipsum dolor sit amet, consectetur adipiscing elit. </div>
		</footer>
	</div>
</body>
</html>