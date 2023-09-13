<?php
$city = $_POST["city"];
$host = "localhost";
$dbname = "BDC1";
$user = "postgres";
$password = "richard15";

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM listings WHERE city = :city";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':city', $city, PDO::PARAM_STR);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $avgSql = "SELECT neighbourhood, AVG(price) AS avg_price
           FROM listings
           WHERE city = :city
           GROUP BY neighbourhood
           ORDER BY avg_price DESC";
           
    $avgStmt = $pdo->prepare($avgSql);
    $avgStmt->bindParam(':city', $city, PDO::PARAM_STR);
    $avgStmt->execute();
    $avgResults = $avgStmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Generic - Stellar by HTML5 UP</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
</head>
<body class="is-preload">
    <div id="wrapper">
        <header id="header">
            <h1>Search Results for <?php echo htmlspecialchars($city); ?></h1>
        </header>
        
        <div id="main">

        <!-- Content -->
            <section id="content" class="main">
                <h2>Average Prices by Neighborhood</h2>
                <ul>
                    <?php foreach ($avgResults as $avg): ?>
                        <li>
                            <strong>Neighborhood:</strong> <?php echo htmlspecialchars($avg['neighbourhood']); ?><br>
                            <strong>Average Price:</strong> $<?php echo number_format($avg['avg_price'], 2); ?><br><br>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <footer class="major">
                    <ul class="actions special">
                        <li><a href="search.html" class="button">Back</a></li>
                        <li><a href="index.html" class="button">Home</a></li>
                    </ul>
                </footer>
            </section>

        </div>

        <!-- Footer -->
					<footer id="footer">
						<section>
							<h2>About Us</h2>
							<p>A simple site that displays the average price for each neighbourhood in a chosen city.</p>
							<ul class="actions">
								<li><a href="generic.html" class="button">Learn More</a></li>
							</ul>
						</section>
						<section>
							<h2>compAirbnb</h2>
							<dl class="alt">
								<dt>Address</dt>
								<dd>1234 Somewhere Road &bull; Nashville, TN 00000 &bull; USA</dd>
								<dt>Phone</dt>
								<dd>(000) 000-0000 x 0000</dd>
								<dt>Email</dt>
								<dd><a href="#">information@compairbnb.com</a></dd>
							</dl>
							<ul class="icons">
								<li><a href="#" class="icon brands fa-twitter alt"><span class="label">Twitter</span></a></li>
								<li><a href="#" class="icon brands fa-facebook-f alt"><span class="label">Facebook</span></a></li>
								<li><a href="#" class="icon brands fa-instagram alt"><span class="label">Instagram</span></a></li>
								<li><a href="#" class="icon brands fa-github alt"><span class="label">GitHub</span></a></li>
							</ul>
						</section>
						<p class="copyright">&copy; compAirbnb</p>
					</footer>
    </div>
    <!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
</body>
</html>