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
    });
});
