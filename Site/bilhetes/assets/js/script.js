document.addEventListener("DOMContentLoaded", function () {
    var popup = document.getElementById("popup");

    setTimeout(function () {
        popup.style.display = "block";
    }, 500);

    setTimeout(function () {
        popup.style.animation = "slideOutToRight 0.5s ease forwards";
        setTimeout(function () {
            popup.style.display = "none"; 
        }, 500); 
    }, 5500); 

    function shakeImage() {
        var img = document.querySelector('.destaque-bilhetes img');
        img.style.animation = 'shake 0.5s';
        setTimeout(function() {
            img.style.animation = 'none'; 
        }, 500);
    }

    setInterval(shakeImage, 2500);

    document.getElementById('btn_loc').addEventListener('click', function() {
        // Abre o link da localização no navegador ao clicar no botão
        window.open('https://www.google.com/maps/place/Escola+Superior+de+Tecnologia+e+Gest%C3%A3o+de+%C3%81gueda/@40.5744858,-8.4460047,17z/data=!3m1!4b1!4m6!3m5!1s0xd230982ea9570a1:0x15e2e89202d3bff4!8m2!3d40.5744818!4d-8.4434298!16s%2Fg%2F1226snv6?entry=ttu');
    });
});



document.getElementById("btnFecharEditar").addEventListener("click", function() {
    document.getElementById("modalEditar").style.display = "none";
    document.getElementById("overlay").style.display = "none";
});


function apagarFeedback(idFeedback) {
    if (confirm("Tem certeza que deseja apagar este feedback?")) {
        // Redireciona para o ficheiro PHP que irá lidar com a exclusão do feedback
        window.location.href = '../feedbacks/apagarFeedback.php?id_feedback=' + idFeedback;
    }
}
