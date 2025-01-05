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
            <div class="container-fluid d-flex flex-column p-0">
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15">
                        <img src="./assets/img/1.png" alt="Icon CodeWave" width="40px" height="40px">
                    </div>
                    <div class="sidebar-brand-text mx-3">
                        <img src="./assets/img/codewave_logo_sfundo.png" alt="CodeWave" width="150px" height="100px">
                    </div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <?php
                    if ($id_cargo == 2) {
                        // Exibe apenas os Bilhetes e Alugueres para id_cargo 2
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
                        <li class="nav-item"><a class="nav-link" href="eventos.php"><i class="fas fa-calendar"></i><span>Eventos</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="zonas.php"><i class="fas fa-map-marker-alt"></i><span>Zonas</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="produtos.php"><i class="fas fa-box"></i><span>Produtos</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="funcionarios.php"><i class="fas fa-address-book"></i><span>Funcionários</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="cargo.php"><i class="fas fa-address-card"></i><span>Cargos</span></a></li>
                        <li class="nav-item"><a class="nav-link active" href="feedback.php"><i class="fas fa-quote-right"></i><span>Feedbacks</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="restauracao.php"><i class="fas fa-solid fa-utensils"></i><span>Restauração</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="gerir_horario.php"><i class="fas fa-calendar"></i><span>Horários</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="noticias.php"><i class="fas fa-newspaper"></i><span>Notícias</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="progressao.php"><i class="fas fa-id-card"></i><span>Progressão</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="mapa.php"><i class="fas fa-map"></i><span>Mapa</span></a></li>
                        ';
                    }
                    ?>
                </ul>
                <div class="text-center d-none d-md-inline">
                    <button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button>
                </div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-expand bg-white shadow mb-4 topbar static-top navbar-light">
                    <div class="container-fluid">
                        <button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button">
                            <i class="fas fa-bars"></i>
                        </button>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item dropdown d-sm-none no-arrow">
                                <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown"
                                    href="#">
                                    <i class="fas fa-search"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end p-3 animated--grow-in"
                                    aria-labelledby="searchDropdown">
                                    <form class="me-auto navbar-search w-100">
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary py-0" type="button">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </li>
                            <li class="nav-item dropdown no-arrow mx-1">
                                <div class="nav-item dropdown no-arrow">
                                    <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown"
                                        href="#">
                                        <span id="notification-badge" class="badge bg-danger badge-counter"></span>
                                        <i class="fas fa-bell fa-fw"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
                                        <h6 class="dropdown-header">Alertas</h6>
                                        <?php require './alertas/alerta.php'; ?> <a
                                            class="dropdown-item text-center small text-gray-500"
                                            href="./alertas.php">Ver Todos os
                                            Alertas</a>
                                    </div>
                                </div>
                            </li>
                            <script src="evento.js"></script>
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow">
                                    <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown"
                                        href="#">
                                        <span class="d-none d-lg-inline me-2 text-gray-600 small">
                                            <?php echo $_SESSION['userf_name']; ?>
                                        </span>
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
                <div class="container-fluid">
                    <div class="row">
                        <div class="row">
                            <div class="col-md-6 col-xl-3 mb-4">
                                <div class="card shadow border-start-primary py-2">
                                    <div class="card-body">
                                        <div class="row align-items-center no-gutters">
                                            <div class="col me-2">
                                                <div class="text-uppercase text-primary fw-bold text-xs mb-1">
                                                    <span>Número de Feedback</span>
                                                </div>
                                                <div class="text-dark fw-bold h5 mb-0">
                                                    <span><?php require "../feedbacks/totalFeedbacks.php"; ?></span>
                                                </div>
                                            </div>
                                            <div class="col-auto"><i class="fas fa-quote-right fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div id="confirm-delete-overlay" style="display: none;"></div>
                        <div id="confirm-delete-modal" class="modal" style="display: none;">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Excluir Feedback</h5>
                                    </div>
                                    <div class="modal-body">
                                        <p>Tem certeza que deseja apagar este feedback?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Não</button>
                                        <button type="button" class="btn btn-danger"
                                            onclick="deleteCargo(<?php echo $id_feedback; ?>)">Sim </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <style>
                            #confirm-delete-overlay {
                                position: fixed;
                                top: 0;
                                left: 0;
                                width: 100%;
                                height: 100%;
                                background-color: rgba(0, 0, 0, 0.5);
                                backdrop-filter: blur(5px);
                                z-index: 999;
                            }

                            .is-invalid {
                                border-color: #ffc107 !important;
                                box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.5) !important;
                            }
                        </style>
                        <script src="../feedbacks/assets/js/script.js"></script>
                        <link rel="stylesheet" href="cargo/styles/style.css">
                        <div class="container-fluid">
                            <div class="card shadow">
                                <div class="card-header py-3">
                                    <p class="text-primary m-0 fw-bold">Feedback Informações</p>
                                </div>
                                <div class="card-body">
                                    <div class="text-md-end dataTables_filter" id="dataTable_filter">
                                        <label class="form-label">
                                            <input type="search" class="form-control form-control-sm"
                                                aria-controls="dataTable" placeholder="Procurar..">
                                        </label>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 text-nowrap"></div>
                                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                    </div>
                                    <div class="table-responsive table mt-2" id="dataTable" role="grid"
                                        aria-describedby="dataTable_info">
                                        <table class="table my-0" id="dataTable">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nome do utilizador</th>
                                                    <th>Data</th>
                                                    <th style="width: 50%;">Descrição</th>
                                                    <th>Avaliação</th>
                                                    <th>Ação</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                    <div class="pagination">
                                        <a href="#" class="prev">←</a>
                                        <div class="pages"></div>
                                        <a href="#" class="next">→</a>
                                    </div>
                                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
                                    </script>
                                    <script>
                                        $(document).ready(function () {

                                            function updateTotalFeedbacks() {
                                                var totalItems = $('#dataTable tbody tr:visible').length;
                                                if (totalItems > 0) {
                                                    $('#startItem').text(1);
                                                    $('#totalItens').text(totalItems);
                                                } else {
                                                    $('#startItem').text(0);
                                                    $('#totalItens').text(0);
                                                }
                                            }

                                            // Atualiza o número total de feedbacks quando a página carrega
                                            updateTotalFeedbacks();

                                            // Atualiza o número total de feedbacks conforme a pesquisa
                                            $('#dataTable_filter input').on('input', function () {
                                                var searchText = $(this).val().toLowerCase();
                                                $('#dataTable tbody tr').each(function () {
                                                    if ($(this).text().toLowerCase().indexOf(
                                                        searchText) > -1) {
                                                        $(this).show();
                                                    } else {
                                                        $(this).hide();
                                                    }
                                                });
                                                updateTotalFeedbacks();
                                            });





                                            var pagina_atual = 1;
                                            var feedback_por_pagina = 7;
                                            var feedback_cache = {};

                                            function carregarFeedback(pagina, termoPesquisa) {
                                                pagina_atual = pagina; // Atualiza a página atual

                                                // Verifica se os dados já estão em cache
                                                if (feedback_cache[pagina] && feedback_cache[pagina][
                                                    termoPesquisa]) {
                                                    renderizarFeedbacks(feedback_cache[pagina][termoPesquisa]);
                                                } else {
                                                    $.ajax({
                                                        url: '../feedbacks/feedbackScript.php',
                                                        type: 'get',
                                                        dataType: 'json',
                                                        data: {
                                                            pagina: pagina,
                                                            pesquisa: termoPesquisa // Passa o termo de pesquisa para o script PHP
                                                        },
                                                        success: function (data) {
                                                            if (!feedback_cache[pagina]) {
                                                                feedback_cache[
                                                                    pagina] = {}; // Cria um objeto vazio para essa página
                                                            }
                                                            feedback_cache[pagina][termoPesquisa] =
                                                                data; // Armazena os dados em cache
                                                            renderizarFeedbacks(data);
                                                        }
                                                    });
                                                }
                                            }

                                            function gerarEstrelas(avaliacao) {
                                                var num_estrelas = Math.floor(avaliacao);
                                                var estrelas = '<span class="star-rating">';
                                                for (var i = 0; i < num_estrelas; i++) {
                                                    estrelas += '<i class="fa fa-star" aria-hidden="true"></i>';
                                                }
                                                // Adiciona meia estrela se a avaliação não for um número inteiro
                                                if (avaliacao - num_estrelas >= 0.5) {
                                                    estrelas +=
                                                        '<i class="fa fa-star-half-alt" aria-hidden="true"></i>';
                                                }
                                                // Completa com estrelas vazias até 5 estrelas
                                                for (var i = num_estrelas + (avaliacao - num_estrelas >= 0.5 ? 1 :
                                                    0); i < 5; i++) {
                                                    estrelas += '<i class="far fa-star" aria-hidden="true"></i>';
                                                }
                                                estrelas += '</span>';
                                                return estrelas;
                                            }

                                            function renderizarFeedbacks(data) {
                                                $('#dataTable tbody').empty();
                                                $.each(data.feedbacks, function (key, row) {
                                                    var tr = $('<tr>');
                                                    tr.append('<td>' + row.id_feedback + '</td>');
                                                    tr.append('<td>' + row.nome_utilizador + '</td>');
                                                    tr.append('<td>' + row.data_formatada + '</td>');
                                                    tr.append('<td>' + row.descricao + '</td>');
                                                    tr.append('<td>' + gerarEstrelas(row.avaliacao) +
                                                        '</td>'
                                                    ); // Adiciona estrelas na coluna de avaliação
                                                    tr.append(
                                                        '<td><button class="btn btn-danger btn-sm" onclick="apagarFeedback(' +
                                                        row.id_feedback + ')">Apagar</button></td>');

                                                    $('#dataTable tbody').append(tr);
                                                });

                                                var total_paginas = Math.ceil(data.total / feedback_por_pagina);
                                                var pagination = $('.pagination .pages');
                                                pagination.empty();

                                                function makeClickHandler(page) {
                                                    return function (e) {
                                                        e.preventDefault();
                                                        carregarFeedback(page);
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

                                                // Atualiza os links para as páginas anterior e próxima
                                                $('.pagination .prev').off('click').on('click', function (e) {
                                                    e.preventDefault();
                                                    if (pagina_atual > 1) {
                                                        carregarFeedback(pagina_atual - 1);
                                                    }
                                                });
                                                $('.pagination .next').off('click').on('click', function (e) {
                                                    e.preventDefault();
                                                    if (pagina_atual < total_paginas) {
                                                        carregarFeedback(pagina_atual + 1);
                                                    }
                                                });
                                            }

                                            carregarFeedback(pagina_atual);

                                        });
                                    </script>
                                    <style>
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
                                    <div id="confirm-delete-overlay" style="display: none;"></div>
                                    <div id="confirm-delete-modal" class="modal" style="display: none;">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Excluir feedback</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Tem certeza que deseja apagar este feedback?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Não</button>
                                                    <button type="button" class="btn btn-danger"
                                                        onclick="deleteCargo(<?php echo $id_feedback; ?>)">Sim </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <style>
                                        #confirm-delete-overlay {
                                            position: fixed;
                                            top: 0;
                                            left: 0;
                                            width: 100%;
                                            height: 100%;
                                            background-color: rgba(0, 0, 0, 0.5);
                                            backdrop-filter: blur(5px);
                                            z-index: 999;
                                        }

                                        .is-invalid {
                                            border-color: #ffc107 !important;
                                            box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.5) !important;
                                        }
                                    </style>


                                    <script>
                                        document.getElementById("btnFechar").addEventListener("click", function () {
                                            document.getElementById("modalAdicionar").style.display = "none";
                                            document.getElementById("overlay").style.display = "none";
                                        });

                                        $(document).ready(function () {
                                            $('#dataTable_filter input').on('input', function () {
                                                var searchText = $(this).val().toLowerCase();
                                                $('#dataTable tbody tr').filter(function () {
                                                    $(this).toggle($(this).text().toLowerCase()
                                                        .indexOf(searchText) > -1);
                                                });
                                            });
                                        });

                                        function showDeleteConfirmationPopup() {
                                            document.getElementById('confirm-delete-overlay').style.display = 'block';
                                            document.getElementById('confirm-delete-modal').style.display = 'block';
                                        }

                                        function hideDeleteConfirmationPopup() {
                                            document.getElementById('confirm-delete-overlay').style.display = 'none';
                                            document.getElementById('confirm-delete-modal').style.display = 'none';
                                        }

                                        function apagarFeedback(idFeedback) {
                                            showDeleteConfirmationPopup();

                                            
                                            var btnDanger = document.getElementById('confirm-delete-modal').querySelector('.btn-danger');
                                            var btnSecondary = document.getElementById('confirm-delete-modal').querySelector('.btn-secondary');
                                            var newBtnDanger = btnDanger.cloneNode(true);
                                            var newBtnSecondary = btnSecondary.cloneNode(true);

                                            btnDanger.parentNode.replaceChild(newBtnDanger, btnDanger);
                                            btnSecondary.parentNode.replaceChild(newBtnSecondary, btnSecondary);

                                            
                                            newBtnDanger.addEventListener('click', function () {
                                                window.location.href = '../feedbacks/apagarFeedback.php?id_feedback=' + idFeedback;
                                            });
                                            newBtnSecondary.addEventListener('click', function () {
                                                hideDeleteConfirmationPopup();
                                            });
                                        }
                                    </script>

                                    <link rel="stylesheet" href="./cargo/styles/style.css">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright">
                        <span>Copyright © CodeWave 2024</span>
                    </div>
                </div>
            </footer>
        </div>
        <a class="border rounded d-inline scroll-to-top" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>