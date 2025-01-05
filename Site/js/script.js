document.addEventListener("DOMContentLoaded", function () {
    var popup = document.getElementById("popup");

    function shakeImage() {
        var img = document.querySelector('.destaque-bilhetes img');
        img.style.animation = 'shake 0.5s';
        setTimeout(function() {
            img.style.animation = 'none'; 
        }, 500);
    }

    setInterval(shakeImage, 2500);

    document.getElementById('btn_loc').addEventListener('click', function() {
        // Abre o link da localização no browser ao clicar no botão
        window.open('https://www.google.com/maps/place/Est%C3%A1dio+Municipal+de+Aveiro/@40.6478131,-8.5962702,17z/data=!3m1!4b1!4m6!3m5!1s0xd23980413660da5:0xadfdc0fa47f08bd3!8m2!3d40.6478091!4d-8.5936953!16zL20vMDhxMm1o?entry=ttu');
    });
});
