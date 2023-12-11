document.addEventListener('DOMContentLoaded', function () {
    // Exécuter le code JavaScript ici une fois que le DOM est chargé
    const tooltipContainers = document.querySelectorAll('.tooltip-container');

    tooltipContainers.forEach(container => {
        container.addEventListener('mouseover', function () {
            const tooltip = this.querySelector('.tooltip');
            tooltip.style.visibility = 'visible';
        });

        container.addEventListener('mouseout', function () {
            const tooltip = this.querySelector('.tooltip');
            tooltip.style.visibility = 'hidden';
        });



        container.addEventListener('click', function () {
            const confirmation = confirm(`Voulez-vous utiliser la class ${this.id} ?`);

            if (confirmation) {
                // L'utilisateur a confirmé, vous pouvez maintenant utiliser this.id
                var classe = this.id;
            $.ajax({
                type: 'GET',
                url: 'controlleur/newpartie.php',
                data: {
                    classe: classe
                },
                success: function(retour) {
                    $('#resultats').html(retour);
                    window.location.href = 'index.php';
                }
            });
            }
        })
    })
});