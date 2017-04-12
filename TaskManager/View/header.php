<header>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="index.php">CIATTI-EUROPE</a>
			</div>
			<?php
			if ($page_title == "Acheteurs") {
				echo '<ul class="nav navbar-nav">
					<li class="active"><a href="index.php?controller=fleche&action=readByType&categorie=acheteurs">Acheteurs</a></li>
					<li><a href="index.php?controller=fleche&action=readByType&categorie=fournisseurs">Fournisseurs</a></li>
				</ul>';
			} else if ($page_title == "Fournisseurs") {
				echo '<ul class="nav navbar-nav">
					<li><a href="index.php?controller=fleche&action=readByType&categorie=acheteurs">Acheteurs</a></li>
					<li class="active"><a href="index.php?controller=fleche&action=readByType&categorie=fournisseurs">Fournisseurs</a></li>
				</ul>';
			} else {
				echo '<ul class="nav navbar-nav">
					<li><a href="index.php?controller=fleche&action=readByType&categorie=acheteurs">Acheteurs</a></li>
					<li><a href="index.php?controller=fleche&action=readByType&categorie=fournisseurs">Fournisseurs</a></li>
				</ul>';
			}
			?>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#">Sign Up</a></li>
				<li><a href="#">Login</a></li>
		    </ul>
		</div>
	</nav>
</header>