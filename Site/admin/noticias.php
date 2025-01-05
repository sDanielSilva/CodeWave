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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
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
              <li class="nav-item"><a class="nav-link" href="feedback.php"><i class="fas fa-quote-right"></i><span>Feedbacks</span></a></li>
              <li class="nav-item"><a class="nav-link" href="restauracao.php"><i class="fas fa-solid fa-utensils"></i><span>Restauração</span></a></li>
              <li class="nav-item"><a class="nav-link" href="gerir_horario.php"><i class="fas fa-calendar"></i><span>Horários</span></a></li>
              <li class="nav-item"><a class="nav-link active" href="noticias.php"><i class="fas fa-newspaper"></i><span>Notícias</span></a></li>
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
                                <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                                    <i class="fas fa-search"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end p-3 animated--grow-in" aria-labelledby="searchDropdown">
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
                                    <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                                        <span id="notification-badge" class="badge bg-danger badge-counter"></span>
                                        <i class="fas fa-bell fa-fw"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
                                        <h6 class="dropdown-header">Alertas</h6> <?php require './alertas/alerta.php'; ?> <a class="dropdown-item text-center small text-gray-500" href="./alertas.php">Ver Todos os Alertas</a>
                                    </div>
                                </div>
                            </li>
                            <script src="evento.js"></script>
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow">
                                    <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                                        <span class="d-none d-lg-inline me-2 text-gray-600 small"> <?php echo $_SESSION['userf_name']; ?> </span>
                                        <img class="border rounded-circle img-profile" src="<?php echo $_SESSION['userf_img']; ?>">
                                    </a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in">
                                        <a class="dropdown-item" href="./fecharSessao.php">
                                            <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout </a>
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
                                                    <span>Total de noticias</span>
                                                </div>
                                                <div class="text-dark fw-bold h5 mb-0">
                                                    <span> <?php require "./noticias/totalNoticias.php"; ?> </span>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3 mb-4">
                                <div class="card shadow border-start-success py-2">
                                    <div class="card-body">
                                        <div class="row align-items-center no-gutters">
                                            <div class="col me-2">
                                                <div class="text-uppercase text-success fw-bold text-xs mb-1">
                                                    <span>Adicionar notícia</span>
                                                </div>
                                                <div class="text-dark fw-bold h5 mb-0">
                                                    <button type="button" id="btnAdicionar" class="btn btn-success text-white">Criar</button>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if (isset($_GET['msg'])) : ?>
                            <div id="mensagem">
                                <?php if ($_GET['msg'] == 'sucesso') : ?>
                                    <p style="color: green;">Notícia atualizada com sucesso!</p>
                                <?php elseif ($_GET['msg'] == 'erro') : ?>
                                    <p style="color: red;">Erro ao atualizar a notícia: <?php echo htmlspecialchars($_GET['detalhes']); ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <script>
                            // Esconde a mensagem depois de algum tempo
                            setTimeout(function() {
                                var mensagem = document.getElementById('mensagem');
                                if (mensagem) {
                                    mensagem.style.display = 'none';
                                }
                            }, 3000); // Esconde a mensagem após 5 segundos
                        </script>
                        <div id="overlay" style="display: none;"></div>
                        <div id="modalFormulario" class="modal" style="display: none;">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Adicionar Notícia</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" id="btnFechar" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="formAdicionarNoticia" method="POST" action="./noticias/adicionarNoticia.php" enctype="multipart/form-data">
                                            <div class="mb-3">
                                                <label for="imagem">Imagem de Capa:</label>
                                                <input type="file" class="form-control" id="imagem" name="imagem">
                                                <input type="hidden" id="imagemUrl" name="imagemUrl">
                                            </div>
                                            <div class="mb-3">
                                                <label for="titulo">Título da Notícia:</label>
                                                <input type="text" class="form-control" id="titulo" name="titulo" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="funcionario">Funcionário Criador:</label>
                                                <input type="text" class="form-control" id="funcionario" name="funcionario" value="<?php echo isset($_SESSION['userf_name']) ? $_SESSION['userf_name'] : ''; ?>" readonly required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="descricao">Descrição da Notícia:</label>
                                                <textarea class="form-control" id="descricao" name="descricao" rows="4" required></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Adicionar</button>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="modalEditar" class="modal" style="display: none;">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Editar Notícia</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" id="btnFecharEditar" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="formEditarNoticia" method="POST" action="./noticias/editarNoticia.php" enctype="multipart/form-data">
                                            <input type="hidden" id="edit_id_noticia" name="edit_id_noticia">
                                            <div class="mb-3">
                                                <label for="edit_imagem">Nova Imagem de Capa:</label>
                                                <input type="file" class="form-control" id="edit_imagem" name="edit_imagem">
                                                <input type="hidden" id="edit_imagemUrl" name="edit_imagemUrl">
                                            </div>
                                            <div class="mb-3">
                                                <label for="edit_tituloNoticia" class="form-label">Novo Título da Notícia</label>
                                                <input type="text" class="form-control" id="edit_tituloNoticia" name="edit_tituloNoticia">
                                            </div>
                                            <div class="mb-3">
                                                <label for="edit_descricaoNoticia" class="form-label">Nova Descrição da Notícia</label>
                                                <textarea class="form-control" id="edit_descricaoNoticia" name="edit_descricaoNoticia" rows="4"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Guardar Alterações</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script src="./noticias/script_noticias.js"></script>
                        <link rel="stylesheet" href="cargo/styles/style.css">
                        <div class="container-fluid">
                            <div class="card shadow">
                                <div class="card-header py-3">
                                    <p class="text-primary m-0 fw-bold">Notícias Informações</p>
                                </div>
                                <div class="card-body">
                                    <div class="text-md-end dataTables_filter" id="dataTable_filter">
                                        <label class="form-label">
                                            <input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Procurar..">
                                        </label>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 text-nowrap"></div>
                                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                    </div>
                                    <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                        <table class="table my-0" id="dataTable">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Título</th>
                                                    <th>Capa</th>
                                                    <th>Data/Hora Publicação</th>
                                                    <th>Funcionário</th>
                                                    <th>Ações</th>
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
                                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                                    <script>
                                        $(document).ready(function() {
                                            var pagina_atual = 1;
                                            var noticias_por_pagina = 7;
                                            var noticias_cache = [];

                                            function carregarNoticias(pagina) {
                                                pagina_atual = pagina; // Atualiza a página atual

                                                // Verifica se os dados já estão em cache
                                                if (noticias_cache[pagina]) {
                                                    renderizarNoticias(noticias_cache[pagina]);
                                                } else {
                                                    $.ajax({
                                                        url: "./noticias/noticiasScript.php?pagina=" + pagina,
                                                        type: "get",
                                                        dataType: "json",
                                                        success: function(data) {
                                                            noticias_cache[pagina] = data; // Armazena os dados em cache
                                                            renderizarNoticias(data);
                                                        },
                                                    });
                                                }
                                            }

                                            function renderizarNoticias(data) {
                                                $("#dataTable tbody").empty();
                                                $.each(data.noticias, function(key, row) {
                                                    var tr = $("<tr>");
                                                    tr.append("<td>" + row.id_noticia + "</td>");
                                                    tr.append("<td>" + row.titulo_noticia + "</td>");
                                                    tr.append(
                                                        '<td><img src="' +
                                                        row.imagem_capa +
                                                        '" alt="Capa" width="50" height="50"></td>'
                                                    );
                                                    tr.append("<td>" + row.data_hora + "</td>");
                                                    tr.append("<td>" + row.funcionario_criador + "</td>");
                                                    tr.append(
                                                        '<td><button class="btn btn-warning text-white btn-sm" onclick="editarNoticia(' +
                                                        row.id_noticia +
                                                        ", '" +
                                                        row.titulo_noticia +
                                                        "', '" +
                                                        row.descricao_noticia +
                                                        "', '" +
                                                        row.imagem_capa +
                                                        '\')">Editar</button><button class="btn btn-danger btn-sm" onclick="apagarNoticia(' +
                                                        row.id_noticia +
                                                        ')">Apagar</button></td>'
                                                    );
                                                    $("#dataTable tbody").append(tr);
                                                });

                                                var total_paginas = Math.ceil(data.total / noticias_por_pagina);
                                                var pagination = $(".pagination .pages");
                                                pagination.empty();

                                                function makeClickHandler(page) {
                                                    return function(e) {
                                                        e.preventDefault();
                                                        carregarNoticias(page);
                                                    };
                                                }

                                                for (var i = 1; i <= total_paginas; i++) {
                                                    var a = $("<a>").text(i);
                                                    if (i === pagina_atual) {
                                                        a.addClass("current");
                                                    } else {
                                                        a.attr("href", "#").click(makeClickHandler(i));
                                                    }
                                                    pagination.append(a);
                                                }

                                                // Atualiza os links para as páginas anterior e próxima
                                                $(".pagination .prev")
                                                    .off("click")
                                                    .on("click", function(e) {
                                                        e.preventDefault();
                                                        if (pagina_atual > 1) {
                                                            carregarNoticias(pagina_atual - 1);
                                                        }
                                                    });
                                                $(".pagination .next")
                                                    .off("click")
                                                    .on("click", function(e) {
                                                        e.preventDefault();
                                                        if (pagina_atual < total_paginas) {
                                                            carregarNoticias(pagina_atual + 1);
                                                        }
                                                    });
                                            }

                                            carregarNoticias(pagina_atual);
                                        });

                                        function editarNoticia(idNoticia, tituloNoticia, descricaoNoticia, imagemUrl) {
                                            document.getElementById("modalEditar").style.display = "block";
                                            document.getElementById("overlay").style.display = "block";
                                            // Preenche os campos do formulário com os dados da notícia
                                            document.getElementById("edit_id_noticia").value = idNoticia;
                                            document.getElementById("edit_tituloNoticia").value = tituloNoticia;
                                            document.getElementById("edit_descricaoNoticia").value = descricaoNoticia;
                                            document.getElementById("edit_imagemUrl").value = imagemUrl;
                                        }

                                        document.getElementById("formEditarNoticia").addEventListener("submit", async function(event) {
                                            var imagemInput = document.getElementById("edit_imagem");
                                            if (imagemInput.files.length > 0) {
                                                event.preventDefault();
                                                var imagemFile = imagemInput.files[0];
                                                var formData = new FormData();
                                                formData.append("image", imagemFile);
                                                try {
                                                    var response = await fetch(
                                                        "https://api.imgbb.com/1/upload?key=" + getenv('IMGBB_API_KEY'), {
                                                            method: "POST",
                                                            body: formData,
                                                        }
                                                    );
                                                    var result = await response.json();
                                                    if (response.ok && result.data && result.data.url) {
                                                        var imageUrl = result.data.url;
                                                        document.getElementById("edit_imagemUrl").value = imageUrl;
                                                        this.submit();
                                                    } else {
                                                        console.error("Erro ao enviar a imagem:", result);
                                                    }
                                                } catch (error) {
                                                    console.error("Erro ao enviar a imagem:", error);
                                                }
                                            } else {
                                                this.submit();
                                            }
                                        });

                                        document.getElementById("btnAdicionar").addEventListener("click", function() {
                                            document.getElementById("modalFormulario").style.display = "block";
                                            document.getElementById("overlay").style.display = "block";
                                        });

                                        document.getElementById("btnFechar").addEventListener("click", function() {
                                            document.getElementById("modalFormulario").style.display = "none";
                                            document.getElementById("overlay").style.display = "none";
                                        });

                                        document.getElementById("btnFecharEditar").addEventListener("click", function() {
                                            document.getElementById("modalEditar").style.display = "none";
                                            document.getElementById("overlay").style.display = "none";
                                        });

                                        function showDeleteConfirmationPopup() {
                                            document.getElementById('confirm-delete-overlay').style.display = 'block';
                                            document.getElementById('confirm-delete-modal').style.display = 'block';
                                        }

                                        function hideDeleteConfirmationPopup() {
                                            document.getElementById('confirm-delete-overlay').style.display = 'none';
                                            document.getElementById('confirm-delete-modal').style.display = 'none';
                                        }

                                        function apagarNoticia(idNoticia) {
                                            showDeleteConfirmationPopup();
                                            var btnDelete = document.getElementById('confirm-delete-modal').querySelector('.btn-danger');
                                            var existingListener = btnDelete.onclick;
                                            if (existingListener) {
                                                btnDelete.removeEventListener('click', existingListener);
                                            }
                                            btnDelete.addEventListener('click', function() {
                                                window.location.href = './noticias/apagarNoticia.php?id_noticia=' + idNoticia;
                                            });
                                            document.getElementById('confirm-delete-modal').querySelector('.btn-secondary').addEventListener('click', function() {
                                                hideDeleteConfirmationPopup();
                                            });
                                        }
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
                                                    <h5 class="modal-title">Excluir Notícia</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Tem a certeza que deseja eliminar permanentemente esta notícia? (Esta opção não pode ser revertida)</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                                                    <button type="button" class="btn btn-danger" onclick="apagarNoticia(<?php echo $id_noticia; ?>)">Sim </button>
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
                                        document.addEventListener("DOMContentLoaded", function() {
                                            var tituloNoticiaInput = document.getElementById("titulo");
                                            tituloNoticiaInput.addEventListener("input", function() {
                                                if (this.value.trim() !== "") {
                                                    this.classList.remove("is-invalid");
                                                }
                                            });
                                            document.getElementById("formAdicionarNoticia").addEventListener("submit", function(event) {
                                                var tituloNoticia = tituloNoticiaInput.value.trim();
                                                if (tituloNoticia === "") {
                                                    event.preventDefault();
                                                    tituloNoticiaInput.classList.add("is-invalid");
                                                }
                                            });
                                            document.getElementById("btnFechar").addEventListener("click", function() {
                                                tituloNoticiaInput.classList.remove("is-invalid");
                                            });
                                        });
                                        document.getElementById("btnFecharEditar").addEventListener("click", function() {
                                            document.getElementById("modalEditar").style.display = "none";
                                            document.getElementById("overlay").style.display = "none";
                                        });
                                        $(document).ready(function() {
                                            $('#dataTable_filter input').on('input', function() {
                                                var searchText = $(this).val().toLowerCase();
                                                $('#dataTable tbody tr').filter(function() {
                                                    $(this).toggle($(this).text().toLowerCase().indexOf(searchText) > -1);
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

                                        function apagarNoticia(idNoticia) {
                                            showDeleteConfirmationPopup();
                                            var btnDelete = document.getElementById('confirm-delete-modal').querySelector('.btn-danger');
                                            var existingListener = btnDelete.onclick;
                                            if (existingListener) {
                                                btnDelete.removeEventListener('click', existingListener);
                                            }
                                            btnDelete.addEventListener('click', function() {
                                                window.location.href = './noticias/apagarNoticia.php?id_noticia=' + idNoticia;
                                            });
                                            document.getElementById('confirm-delete-modal').querySelector('.btn-secondary').addEventListener('click', function() {
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