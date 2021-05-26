<div class="conteneur">
	<header>
		<?php include 'vue/haut.php' ;?>
	</header>
	<main>
		<div class="contentConnexion">
			<div class='connexion'>
				<div class='titre'>Mes informations</div>
				<?php 
                    $formulaireCompte->afficherFormulaire();
				?>				
			</div>
			
		</div>
	</main>
	<footer>
		<?php include 'vue/bas.php' ;?>
	</footer>
</div>
