<?php
require_once "bdd/Bdd.php";
$bdd = new Bdd();

$dataclass = $bdd->data_sup_partie($donneepartie['ID_partie']);
$imgBiome = $dataclass['img_biome'];
?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
            var imgBiomeName = <?php echo json_encode($imgBiome); ?>;
            var body = document.body;

            // Mettez à jour l'image de fond du body
            body.style.background = 'url("image/biome/' + imgBiomeName + '.png") center / cover no-repeat';
});
</script>

