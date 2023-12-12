document.addEventListener('DOMContentLoaded', function() {
    var infosPersoDiv = document.getElementById('infos-perso');
    var info = document.getElementById('info');
    var timeoutId;

    info.addEventListener('click', function() {
        infosPersoDiv.style.display = 'block';
        
    });

    info.addEventListener('mouseleave', function() { 
        // repasse en none aprés 5 seconde
        timeoutId = setTimeout(function() {
            infosPersoDiv.style.display = 'none';
        }, 5000);
    });

    // attente
    infosPersoDiv.addEventListener('mouseenter', function() {
        clearTimeout(timeoutId);
    });

    infosPersoDiv.addEventListener('mouseleave', function() { 
        infosPersoDiv.style.display = 'none';
    });
});


function openinventaireC() {
    document.getElementById("inventairecarte").style.width = "100%";
}

function closeinventaireC() {
    document.getElementById("inventairecarte").style.width = "0";
}

function openinventaireI() {
    document.getElementById("inventaireitem").style.width = "100%";
}

function closeinventaireI() {
    document.getElementById("inventaireitem").style.width = "0";
}