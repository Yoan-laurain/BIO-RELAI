<div class="conteneur">
	<header>
		<?php include 'haut.php' ;?>
	</header>
	<main>
		<div class="contentConnexion">
			<div class='connexion'>
				<div class='titre'>Je me connecte</div>
				<?php 
					$formulaireConnexion->afficherFormulaire();
					$formulaireConnexion2->afficherFormulaire();
				?>				
			</div>
			
		</div>
	</main>
	<footer>
		<?php include 'bas.php' ;?>
	</footer>
</div>
