<?php
session_start();
require_once "../bdd/Bdd.php";

// Fonction pour changer le palier et récupérer un nouvel événement
function changer_palier() {

    // Créer une instance de la classe Bdd
    $bdd = new Bdd();

    $donneepartie = $bdd->donnéepartieActive($_SESSION["NClient"]); //rajouté car la variable est inconnu sur ce fichier 

    // Chance de changer le biome (1 chance sur 10)
if (rand(1, 1) === 1) {
    $imgBiome = $bdd->changerBiome($donneepartie['ID_partie']); // Fonction pour mettre à jour le biome
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
            var imgBiomeName = <?php echo json_encode($imgBiome); ?>;
            var body = document.body;

            // Mettez à jour l'image de fond du body
            body.style.background = 'url("image/biome/' + imgBiomeName + '.png") center / cover no-repeat';
});
</script>
<?php   
}

// Récupérer un nouvel événement aléatoire depuis la base de données
$nouvelEvenement = $bdd->getEvenementAleatoire($donneepartie['ID_partie']); // Fonction à définir dans votre classe Bdd pour récupérer un événement aléatoire

if ($nouvelEvenement != null){
    return "ok";
}else{
    return "error";
}

}
?>
