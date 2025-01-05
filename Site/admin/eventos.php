<?php
session_start();

// Verifica se o id_cargo está definido na sessão
if (!isset($_SESSION['userf_cargo'])) {
    // O id_cargo não está definido, redireciona para a página de login
    header("Location: login.html");
    exit();
}

// Verifica o valor do id_cargo
$id_cargo = $_SESSION['userf_cargo'];
if ($id_cargo == 2) {

    header("Location: bilhetes.php");
    exit();
} else if ($id_cargo != 1) {
    // O id_cargo não é 1, redireciona para a página de login
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - CodeWave</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0 navbar-dark">
            <div class="container-fluid d-flex flex-column p-0"><a
                    class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"><img src="./assets/img/1.png" alt="Icon CodeWave"
                            width="40px" height="40px"></div>
                    <div class="sidebar-brand-text mx-3"><img src="./assets/img/codewave_logo_sfundo.png" alt="CodeWave"
                            width="150px" height="100px"></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <?php
                    if ($id_cargo == 2) {
                        // Exibe apenas Bilhetes e Alugueres para id_cargo 2
                        echo '
              <li class="nav-item"><a class="nav-link" href="index.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
              <li class="nav-item"><a class="nav-link active" href="bilhetes.php"><i class="fas fa-ticket-alt"></i><span>Bilhetes</span></a></li>
              <li class="nav-item"><a class="nav-link" href="tableBilhetes.php"><i class="fas fa-ticket-alt"></i><span>Info Bilhetes</span></a></li>
              <li class="nav-item"><a class="nav-link" href="alugueres.php"><i class="fas fa-umbrella-beach"></i><span>Alugueres</span></a></li>
              ';
                    } else {
                        // Exibe todos para outros cargos
                        if ($id_cargo != 1) {
                            // O id_cargo não é 1, redireciona para a página de login
                            header("Location: login.html");
                            exit();
                        }
                        echo '
              <li class="nav-item"><a class="nav-link" href="index.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
              <li class="nav-item"><a class="nav-link" href="bilhetes.php"><i class="fas fa-ticket-alt"></i><span>Bilhetes</span></a></li>
              <li class="nav-item"><a class="nav-link" href="tableBilhetes.php"><i class="fas fa-ticket-alt"></i><span>Info Bilhetes</span></a></li>
              <li class="nav-item"><a class="nav-link" href="alugueres.php"><i class="fas fa-umbrella-beach"></i><span>Alugueres</span></a></li>
              <li class="nav-item"><a class="nav-link" href="categorias.php"><i class="fas fa-cubes"></i><span>Categorias</span></a></li>
              <li class="nav-item"><a class="nav-link active" href="eventos.php"><i class="fas fa-calendar"></i><span>Eventos</span></a></li>
              <li class="nav-item"><a class="nav-link" href="zonas.php"><i class="fas fa-map-marker-alt"></i><span>Zonas</span></a></li>
              <li class="nav-item"><a class="nav-link" href="produtos.php"><i class="fas fa-box"></i><span>Produtos</span></a></li>
              <li class="nav-item"><a class="nav-link" href="funcionarios.php"><i class="fas fa-address-book"></i><span>Funcionários</span></a></li>
              <li class="nav-item"><a class="nav-link" href="cargo.php"><i class="fas fa-address-card"></i><span>Cargos</span></a></li>
              <li class="nav-item"><a class="nav-link" href="feedback.php"><i class="fas fa-quote-right"></i><span>Feedbacks</span></a></li>
              <li class="nav-item"><a class="nav-link" href="restauracao.php"><i class="fas fa-solid fa-utensils"></i><span>Restauração</span></a></li>
              <li class="nav-item"><a class="nav-link" href="gerir_horario.php"><i class="fas fa-calendar"></i><span>Horários</span></a></li>
              <li class="nav-item"><a class="nav-link" href="noticias.php"><i class="fas fa-newspaper"></i><span>Notícias</span></a></li>
              <li class="nav-item"><a class="nav-link" href="progressao.php"><i class="fas fa-id-card"></i><span>Progressão</span></a></li>
              <li class="nav-item"><a class="nav-link" href="mapa.php"><i class="fas fa-map"></i><span>Mapa</span></a></li>
              ';
                    }
                    ?>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0"
                        id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-expand bg-white shadow mb-4 topbar static-top navbar-light">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3"
                            id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link"
                                    aria-expanded="false" data-bs-toggle="dropdown" href="#"><i
                                        class="fas fa-search"></i></a>
                                <div class="dropdown-menu dropdown-menu-end p-3 animated--grow-in"
                                    aria-labelledby="searchDropdown">
                                    <form class="me-auto navbar-search w-100">
                                        <div class="input-group"><input class="bg-light form-control border-0 small"
                                                type="text" placeholder="Procurar por ...">
                                            <div class="input-group-append"><button class="btn btn-primary py-0"
                                                    type="button"><i class="fas fa-search"></i></button></div>
                                        </div>
                                    </form>
                                </div>
                            </li>
                            <li class="nav-item dropdown no-arrow mx-1">
                                <div class="nav-item dropdown no-arrow">
                                    <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown"
                                        href="#">
                                        <span class="badge bg-danger badge-counter"></span>
                                        <i class="fas fa-bell fa-fw"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
                                        <h6 class="dropdown-header">Alertas</h6>
                                        <?php require './alertas/alerta.php'; ?> <a
                                            class="dropdown-item text-center small text-gray-500"
                                            href="./alertas.php">Ver Todos os Alertas</a>
                                    </div>
                                </div>

                            </li>
                            <script src="evento.js"></script>

                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow">
                                    <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown"
                                        href="#">
                                        <span
                                            class="d-none d-lg-inline me-2 text-gray-600 small"><?php echo $_SESSION['userf_name']; ?></span>
                                        <img class="border rounded-circle img-profile"
                                            src="<?php echo $_SESSION['userf_img']; ?>">
                                    </a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in">
                                        <a class="dropdown-item" href="./fecharSessao.php">
                                            <i
                                                class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout
                                        </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

                <div class="container-fluid">
                    <div class="row">
                        <style>
                            #confirm-overlay {
                                position: fixed;
                                top: 0;
                                left: 0;
                                width: 100%;
                                height: 100%;
                                background-color: rgba(0, 0, 0, 0.5);
                                backdrop-filter: blur(5px);
                                z-index: 999;
                            }

                            .pagination {
                                display: flex;
                                justify-content: space-between;
                                align-items: center;
                                padding: 1em;
                            }

                            .pagination .pages {
                                display: flex;
                                justify-content: center;
                                align-items: center;
                            }

                            .pagination a {
                                margin: 0 0.5em;
                                padding: 0.5em 1em;
                                text-decoration: none;
                                color: #007bff;
                                border: 1px solid #007bff;
                                border-radius: 5px;
                                transition: background-color 0.3s ease;
                            }

                            .pagination a:hover {
                                background-color: #007bff;
                                color: white;
                            }

                            .pagination .current {
                                background-color: #007bff;
                                color: white;
                                pointer-events: none;
                            }
                        </style>
                        <div class="container-fluid">
                            <div class="card shadow">
                                <div class="card-header py-3">
                                    <p class="text-primary m-0 fw-bold">Eventos Informações</p>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 text-nowrap">

                                        </div>
                                        <div class="col-md-6">
                                            <div class="text-md-end dataTables_filter" id="dataTable_filter"><label
                                                    class="form-label"><input type="search"
                                                        class="form-control form-control-sm" aria-controls="dataTable"
                                                        placeholder="Procurar"></label></div>
                                        </div>
                                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                        <script>
                                            $(document).ready(function () {
                                                $('#dataTable_filter input').on('input', function () {
                                                    var searchText = $(this).val().toLowerCase();
                                                    $('#dataTable tbody tr').filter(function () {
                                                        $(this).toggle($(this).text().toLowerCase().indexOf(searchText) > -1);
                                                    });
                                                });
                                            });
                                        </script>
                                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                        <script>
                                            $(document).ready(function () {
                                                
                                                // Abre o modal de confirmação ao clicar no botão "Aprovar"
                                                $(document).on('click', '.aprovar-btn', function () {
                                                    console.log("Botão 'Aprovar' clicado");
                                                    var idEvento = $(this).data('id'); // Pega no ID do evento
                                                    // Armazena o ID do evento no botão "Sim" do modal de confirmação
                                                    $('#confirm-approve').data('id', idEvento);
                                                    // Mostra o modal de confirmação
                                                    console.log("Abrindo modal de confirmação");
                                                    $('#confirm-overlay').show();
                                                    $('#confirm-modal').show();
                                                });

                                                // Aprova o evento ao clicar no botão "Sim" do modal de confirmação
                                                $('#confirm-approve').click(function () {
                                                    console.log("Botão 'Sim' dentro do modal de confirmação clicado");
                                                    var idEvento = $(this).data('id'); // Pega no ID do evento armazenado
                                                    // Executa a chamada AJAX para aprovar o evento
                                                    console.log("ID do evento:", idEvento);
                                                    $.ajax({
                                                        type: 'POST',
                                                        url: './eventos/aprovarEvento.php',
                                                        data: { id_evento: idEvento },
                                                        success: function (response) {
                                                            console.log("Evento aprovado com sucesso!");
                                                            // Esconde o modal de confirmação e recarrega a página
                                                            $('#confirm-overlay').hide();
                                                            $('#confirm-modal').hide();
                                                            location.reload();
                                                        },
                                                        error: function (xhr, status, error) {
                                                            console.error('Erro ao aprovar o evento:', error);
                                                        }
                                                    });
                                                });

                                                // Fecha o modal de confirmação ao clicar no botão "Não" ou fora do modal
                                                $(document).on('click', '#confirm-overlay, #confirm-modal .btn-secondary', function () {
                                                    console.log("Fechando modal de confirmação");
                                                    // Esconde o modal de confirmação
                                                    $('#confirm-overlay').hide();
                                                    $('#confirm-modal').hide();
                                                });
                                            });

                                        </script>
                                    </div>
                                    <div class="table-responsive table mt-2" id="dataTable" role="grid"
                                        aria-describedby="dataTable_info">
                                        <table class="table my-0" id="dataTable">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nome</th>
                                                    <th>Data Início</th>
                                                    <th>Data Fim</th>
                                                    <th>Tipo</th>
                                                    <th>Descrição</th>
                                                    <th>Nº Convidados</th>
                                                    <th>Zona</th>
                                                    <th>Aprovação</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>

                                    </div>
                                    <div class="pagination">
                                        <a href="#" class="prev">←</a>
                                        <div class="pages"></div>
                                        <a href="#" class="next">→</a>
                                    </div>
                                    <script
                                        src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                                    <script>
                                        $(document).ready(function () {
                                            var pagina_atual = 1;
                                            var noticias_por_pagina = 7;
                                            var eventos_cache = [];

                                            function carregarEventos(pagina) {
                                                pagina_atual = pagina; // Atualiza a página atual

                                                // Verifica se os dados já estão em cache
                                                if (eventos_cache[pagina]) {
                                                    renderizarEventos(eventos_cache[pagina]);
                                                } else {
                                                    $.ajax({
                                                        url: './eventos/eventosScript.php?pagina=' + pagina,
                                                        type: 'get',
                                                        dataType: 'json',
                                                        success: function (data) {
                                                            eventos_cache[pagina] = data; // Armazena os dados em cache
                                                            renderizarEventos(data);
                                                        }
                                                    });
                                                }
                                            }

                                            function renderizarEventos(data) {
                                                $('#dataTable tbody').empty();
                                                $.each(data.eventos, function (key, row) {
                                                    var tr = $('<tr>');
                                                    tr.append('<td>' + row.id_evento + '</td>');
                                                    tr.append('<td>' + row.nome_utilizador + '</td>');
                                                    tr.append('<td>' + row.data_inicio + '</td>');
                                                    tr.append('<td>' + row.data_fim + '</td>');
                                                    tr.append('<td>' + row.tipo + '</td>');
                                                    tr.append('<td>' + row.descricao + '</td>');
                                                    tr.append('<td>' + row.num_convidados + '</td>');
                                                    tr.append('<td>' + row.nome_zona + '</td>');

                                                    var aprovado = row.aprovado ?
                                                        '<button class="btn btn-success btn-sm" disabled>Aprovado</button>' :
                                                        '<form action="./eventos/aprovarEvento.php" method="post"><input type="hidden" name="id_evento" value="' + row.id_evento + '"><button class="btn btn-warning btn-sm aprovar-btn" data-id="' + row.id_evento + '"type="button">Aprovar</button></form>';
                                                    tr.append('<td>' + aprovado +
                                                        '<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalEmail' + row.id_evento + '">Enviar E-mail</button>' +
                                                        '<div class="modal fade" id="modalEmail' + row.id_evento + '" tabindex="-1" role="dialog" aria-labelledby="modalEmailLabel' + row.id_evento + '" aria-hidden="true">' +
                                                        '<div class="modal-dialog" role="document" id="modemail"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="modalEmailLabel' + row.id_evento + '">Enviar E-mail</h5>' +
                                                        '<button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button></div><form id="formEnviarEmail" action="./eventos/enviarEmail.php" method="post">' +
                                                        '<div class="modal-body"><input type="hidden" name="id_utilizador" value="' + row.id_utilizador + '"><input type="hidden" name="id_evento" value="' + row.id_evento + '"><div class="form-group"><label for="subject">Assunto:</label>' +
                                                        '<input type="text" class="form-control" id="subject" name="subject"></div><div class="form-group"><label for="body">Corpo:</label><textarea class="form-control" id="body" name="body"></textarea></div>' +
                                                        '</div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button><button type="submit" class="btn btn-primary">Enviar</button></div></form></div></div></div></td>');

                                                    $('#dataTable tbody').append(tr);
                                                });

                                                var total_paginas = Math.ceil(data.total / noticias_por_pagina);
                                                var pagination = $('.pagination .pages');
                                                pagination.empty();

                                                function makeClickHandler(page) {
                                                    return function (e) {
                                                        e.preventDefault();
                                                        carregarEventos(page);
                                                    };
                                                }

                                                for (var i = 1; i <= total_paginas; i++) {
                                                    var a = $('<a>').text(i);
                                                    if (i === pagina_atual) {
                                                        a.addClass('current');
                                                    } else {
                                                        a.attr('href', '#').click(makeClickHandler(i));
                                                    }
                                                    pagination.append(a);
                                                }

                                                $('.pagination .prev').off('click').on('click', function (e) {
                                                    e.preventDefault();
                                                    if (pagina_atual > 1) {
                                                        carregarEventos(pagina_atual - 1);
                                                    }
                                                });
                                                $('.pagination .next').off('click').on('click', function (e) {
                                                    e.preventDefault();
                                                    if (pagina_atual < total_paginas) {
                                                        carregarEventos(pagina_atual + 1);
                                                    }
                                                });
                                            }

                                            carregarEventos(pagina_atual);

                                            $(document).on('submit', 'form[action="./eventos/enviarEmail.php"]', function (event) {
                                                event.preventDefault(); // Evita o envio do formulário

                                                var form = $(this);
                                                var formData = form.serialize(); // Serializa os dados do formulário
                                                var eventId = form.find('input[name="id_evento"]').val(); // Pega no ID do evento

                                                console.log(eventId);

                                                $.ajax({
                                                    type: form.attr('method'),
                                                    url: form.attr('action'),
                                                    data: formData,
                                                    success: function (response) {

                                                        //#$('.modal').modal('hide');
                                                        $('#modalEmail' + eventId).removeClass('show').hide(); // Fecha o modal correto

                                                        // Exibe o modal de confirmação com a mensagem de sucesso
                                                        $('#emailConfirmationMessage').text('Email enviado com sucesso!');
                                                        $('#modalEmailConfirmation').modal('show');

                                                        $('.fade').remove();
                                                        $('body').removeClass('.fade');

                                                    },
                                                    error: function (xhr, status, error) {
                                                        $('#modalEmail' + eventId).removeClass('show').hide(); // Fecha o modal correto

                                                        // Exibe modal de confirmação com a mensagem de erro
                                                        $('#emailConfirmationMessage').text('Erro ao enviar o email.');
                                                        $('#modalEmailConfirmation').modal('show');
                                                    }
                                                });
                                            });

                                            document.getElementById('nhaFecho').addEventListener('click', function () {
                                                location.reload();
                                            });

                                            $('.aprovar-btn').click(function () {
                                                var idEvento = $(this).data('id');
                                                $('#confirm-modal').find('.confirm-aprovar').data('id', idEvento);
                                                $('#confirm-overlay').show();
                                                $('#confirm-modal').show();
                                            });
                                            $('#confirm-modal .btn-secondary').click(function () {
                                                $('#confirm-overlay').hide();
                                                $('#confirm-modal').hide();
                                            });
                                        });


                                    </script>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="modalEmailConfirmation" tabindex="-1" role="dialog"
                        aria-labelledby="modalEmailConfirmationLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalEmailConfirmationLabel">Confirmação de Envio</h5>
                                </div>
                                <div class="modal-body">
                                    <p id="emailConfirmationMessage"></p>
                                </div>
                                <div class="modal-footer">
                                    <button id="nhaFecho" type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Fechar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="confirm-overlay" style="display: none;"></div>
                    <div id="confirm-modal" class="modal" style="display: none;">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Aprovar evento</h5>
                                </div>
                                <div class="modal-body">
                                    <p>Tem certeza que deseja aprovar o evento?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                                    <button type="button" class="btn btn-warning btn-sm" id="confirm-approve">Sim</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="bg-white sticky-footer">
                    <div class="container my-auto">
                        <div class="text-center my-auto copyright"><span>Copyright © CodeWave 2024</span></div>
                    </div>
                </footer>
            </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
        </div>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/chart.min.js"></script>
        <script src="assets/js/bs-init.js"></script>
        <script src="assets/js/theme.js"></script>
</body>

</html>