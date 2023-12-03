<?php
require("Controlleur/infoclassC.php");

echo "<div class='center'>";
if (!empty($donneeclass)) {
    echo "<table class='table-class'>";
    
    // nombre de colonnes
    $elementsParLigne = 3;
    $count = count($donneeclass);

    // Calcule le nombre de lignes
    $nombreLignes = ceil($count / $elementsParLigne);

    for ($i = 0; $i < $nombreLignes; $i++) {
        echo "<tr>";

        // Calcule le nombre d'éléments à afficher sur cette ligne
        $elementsSurCetteLigne = min($elementsParLigne, $count - $i * $elementsParLigne);

        // Calcule le nombre de cellules vides nécessaires à gauche pour centrer les éléments
        $decalageGauche = max(0, floor(($elementsParLigne - $elementsSurCetteLigne) / 2));
        // Affiche les cellules vides à gauche
        for ($k = 0; $k < $decalageGauche; $k++) {
            echo "<td></td>";
        }

        // Affiche les éléments pour cette ligne
        for ($j = 0; $j < $elementsSurCetteLigne; $j++) {


            echo "<td class='tooltip-container'>";
            echo "{$donneeclass[$j]['name_class']}<br>";
            echo "<img src='image/class/{$donneeclass[$j]['img_class']}.png' alt='{$donneeclass[$j]['name_class']}'>";
            echo "<div class='tooltip'>";
            echo "Attaque: {$donneeclass[$j]['attaqueBase']}<br>";
            echo "Vitesse: {$donneeclass[$j]['vitesseBase']}<br>";
            echo "Vie: {$donneeclass[$j]['vieBase']}<br>";
            echo "Défense: {$donneeclass[$j]['deffenceBase']}<br>";
            echo "info: {$donneeclass[$j]['libelle_class']}<br>";
            echo "</div>";
            echo "</td>";
        }

        // Calcule le nombre de cellules vides nécessaires à droite pour centrer les éléments
        $decalageDroite = $elementsParLigne - $decalageGauche - $elementsSurCetteLigne;
        // Affiche les cellules vides à droite
        for ($k = 0; $k < $decalageDroite; $k++) {
            echo "<td></td>";
        }

        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Une erreur s'est produite. Les données sont introuvables. Veuillez patienter et attendre que le problème soit résolu.";
}
echo "</div>";

?>

<script src="javascript/infoclass.js" defer></script>

