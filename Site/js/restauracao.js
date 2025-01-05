$(document).ready(function() {

    // Função para carregar as imagens do botão "Mostrar Tudo"
    function carregarMostrarTudo() {
        $.ajax({
            url: "./restauracao/mostrarTudo.php",
            type: "GET",
            dataType: "json",
            success: function(response) {
                $("#menu-content").empty();
                $.each(response, function(index, item) {
                    $("#menu-content").append(
                        '<div class="col-md-4 d-flex flex-column align-items-center">' +
                        '<a class="image-link" href="' + item.imagem + '">' +
                        '<img src="' + item.imagem + '" alt="" width="350px" height="350px">' +
                        '</a>' +
                        '<div style="text-align: center; width: 100%;">' +
                        '<h5>' + item.nome + '</h5>' +
                        '<p>Preço: ' + item.preco + ' €</p>' +
                        '</div>' +
                        '</div>'
                    );
                });
                
                // Inicializar o Magnific Popup após adicionar as imagens
                $('.image-link').magnificPopup({type:'image'});

                
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                $("#menu-content").html("<p>Ocorreu um erro ao carregar o menu.</p>");
            }
            
        });
       
       $("#btn-tudo").addClass("active");
    }

    // Chama a função para carregar o conteúdo
    carregarMostrarTudo();

    $("#btn-tudo").addClass("active");


    $("#btn-restaurante-wave").click(function() {
        $.ajax({
            url: "./restauracao/mostrarWave.php",
            type: "GET",
            dataType: "json",
            success: function(response) {
                $("#menu-content").empty();
                $.each(response, function(index, item) {
                    $("#menu-content").append(
                        '<div class="col-md-4">' +
                        '<a class="image-link" href="' + item.imagem + '">' +
                        '<img src="' + item.imagem + '" alt="" width="350px" height="350px">' +
                        '</a>' +
                        '<h5>' + item.nome + '</h5>' +
                        '<p>Preço: ' + item.preco + ' €</p>' +
                        '</div>'
                    );
                });
                
                // Inicializa o Magnific Popup após adicionar as imagens
                $('.image-link').magnificPopup({type:'image'});
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                $("#menu-content").html("<p>Ocorreu um erro ao carregar o menu.</p>");
            }
        });
       
    });

    $("#btn-restaurante-fast").click(function() {
        $.ajax({
            url: "./restauracao/mostrarFast.php",
            type: "GET",
            dataType: "json",
            success: function(response) {
                $("#menu-content").empty();
                $.each(response, function(index, item) {
                    $("#menu-content").append(
                        '<div class="col-md-4">' +
                        '<a class="image-link" href="' + item.imagem + '">' +
                        '<img src="' + item.imagem + '" width="350px" height="350px">' +
                        '</a>' +
                        '<h5>' + item.nome + '</h5>' +
                        '<p>Preço: ' + item.preco + ' €</p>' +
                        '</div>'
                    );
                });
                
                // Inicializa o Magnific Popup após adicionar as imagens
                $('.image-link').magnificPopup({type:'image'});
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                $("#menu-content").html("<p>Ocorreu um erro ao carregar o menu.</p>");
            }
        });
    });

    $("#btn-bar").click(function() {
        $.ajax({
            url: "./restauracao/mostrarBar.php",
            type: "GET",
            dataType: "json",
            success: function(response) {
                $("#menu-content").empty();
                $.each(response, function(index, item) {
                    $("#menu-content").append(
                        '<div class="col-md-4">' +
                        '<a class="image-link" href="' + item.imagem + '">' +
                        '<img src="' + item.imagem + '" alt="" width="350px" height="350px">' +
                        '</a>' +
                        '<h5>' + item.nome + '</h5>' +
                        '<p>Preço: ' + item.preco + ' €</p>' +
                        '</div>'
                    );
                });
                
                // Inicializa o Magnific Popup após adicionar as imagens
                $('.image-link').magnificPopup({type:'image'});
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                $("#menu-content").html("<p>Ocorreu um erro ao carregar o menu.</p>");
            }
        });
    });

    $("#btn-tudo").click(function() {
        carregarMostrarTudo();
        
    });
});
