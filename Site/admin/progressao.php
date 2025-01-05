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
          <div class="sidebar-brand-icon rotate-n-15"><img src="./assets/img/1.png" alt="Icon CodeWave" width="40px"
              height="40px"></div>
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
              <li class="nav-item"><a class="nav-link" href="eventos.php"><i class="fas fa-calendar"></i><span>Eventos</span></a></li>
              <li class="nav-item"><a class="nav-link" href="zonas.php"><i class="fas fa-map-marker-alt"></i><span>Zonas</span></a></li>
              <li class="nav-item"><a class="nav-link" href="produtos.php"><i class="fas fa-box"></i><span>Produtos</span></a></li>
              <li class="nav-item"><a class="nav-link" href="funcionarios.php"><i class="fas fa-address-book"></i><span>Funcionários</span></a></li>
              <li class="nav-item"><a class="nav-link" href="cargo.php"><i class="fas fa-address-card"></i><span>Cargos</span></a></li>
              <li class="nav-item"><a class="nav-link" href="feedback.php"><i class="fas fa-quote-right"></i><span>Feedbacks</span></a></li>
              <li class="nav-item"><a class="nav-link" href="restauracao.php"><i class="fas fa-solid fa-utensils"></i><span>Restauração</span></a></li>
              <li class="nav-item"><a class="nav-link" href="gerir_horario.php"><i class="fas fa-calendar"></i><span>Horários</span></a></li>
              <li class="nav-item"><a class="nav-link" href="noticias.php"><i class="fas fa-newspaper"></i><span>Notícias</span></a></li>
              <li class="nav-item"><a class="nav-link active" href="progressao.php"><i class="fas fa-id-card"></i><span>Progressão</span></a></li>
              <li class="nav-item"><a class="nav-link" href="mapa.php"><i class="fas fa-map"></i><span>Mapa</span></a></li>
              ';
          }
          ?>
        </ul>
        <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle"
            type="button"></button></div>
      </div>
    </nav>
    <div class="d-flex flex-column" id="content-wrapper">
      <div id="content">
        <nav class="navbar navbar-expand bg-white shadow mb-4 topbar static-top navbar-light">
          <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop"
              type="button"><i class="fas fa-bars"></i></button>

            <ul class="navbar-nav flex-nowrap ms-auto">
              <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false"
                  data-bs-toggle="dropdown" href="#"><i class="fas fa-search"></i></a>
                <div class="dropdown-menu dropdown-menu-end p-3 animated--grow-in" aria-labelledby="searchDropdown">
                </div>
              </li>
              <li class="nav-item dropdown no-arrow mx-1">
                <div class="nav-item dropdown no-arrow">
                  <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                    <span class="badge bg-danger badge-counter"></span>
                    <i class="fas fa-bell fa-fw"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
                    <h6 class="dropdown-header">Alertas</h6>
                    <?php require './alertas/alerta.php'; ?>
                    <a class="dropdown-item text-center small text-gray-500" href="#">Ver Todos os
                      Alertas</a>
                  </div>
                </div>

              </li>
              <script src="evento.js"></script>

              <div class="d-none d-sm-block topbar-divider"></div>
              <li class="nav-item dropdown no-arrow">
                <div class="nav-item dropdown no-arrow">
                  <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                    <span
                      class="d-none d-lg-inline me-2 text-gray-600 small"><?php echo $_SESSION['userf_name']; ?></span>
                    <img class="border rounded-circle img-profile" src="<?php echo $_SESSION['userf_img']; ?>">
                  </a>
                  <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item"
                      href="#"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile</a><a
                      class="dropdown-item" href="#"><i
                        class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Settings</a><a
                      class="dropdown-item" href="#"><i
                        class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Activity
                      log</a>
                    <div class="dropdown-divider"></div><a class="dropdown-item" href="./fecharSessao.php"><i
                        class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
        <div class="container-fluid">
          <div class="row">



            <style>
              #overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                backdrop-filter: blur(5px);
                z-index: 999;
              }
            </style>
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








            <div class="container-fluid">
              <div class="card shadow">
                <div class="card-header py-3">
                  <p class="text-primary m-0 fw-bold">Funcionários Informações</p>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6 text-nowrap">

                    </div>
                    <div class="col-md-6">
                      <div class="text-md-end dataTables_filter" id="dataTable_filter"><label class="form-label"><input
                            type="search" class="form-control form-control-sm" aria-controls="dataTable"
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

                  </div>
                  <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                    <table class="table my-0" id="dataTable">
                      <thead>
                        <tr>
                          <th>Nome</th>
                          <th>Cargo</th>
                          <th>Local</th>
                          <th>Idade</th>
                          <th>Data Início</th>
                          <th>Data Fim</th>
                          <th>Salário</th>
                          <th>Ações</th>
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
                  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                  <script>
                    $(document).ready(function () {
                      var pagina_atual = 1;
                      var progressoes_por_pagina = 7;
                      var progressoes_cache = [];

                      function carregarProgressoes(pagina) {
                        pagina_atual = pagina; // Atualiza a página atual

                        // Verifica se os dados já estão em cache
                        if (progressoes_cache[pagina]) {
                          renderizarProgressoes(progressoes_cache[pagina]);
                        } else {
                          $.ajax({
                            url: './progressao/progressaoScript.php?pagina=' + pagina,
                            type: 'get',
                            dataType: 'json',
                            success: function (data) {
                              progressoes_cache[pagina] = data; // Armazena os dados em cache
                              renderizarProgressoes(data);
                            }
                          });
                        }
                      }

                      function renderizarProgressoes(data) {
                        $('#dataTable tbody').empty();
                        $.each(data.progressoes, function (key, row) {
                          var tr = $('<tr>');
                          tr.append('<td><img class="rounded-circle me-2" width="30" height="30" src="' + row.img + '">' + row.nome + '</td>');
                          tr.append('<td>' + row.descricao + '</td>');
                          tr.append('<td>' + row.local + '</td>');
                          tr.append('<td>' + row.idade + '</td>');
                          tr.append('<td>' + row.ano_inicio + '</td>');
                          tr.append('<td>' + row.ano_fim + '</td>');
                          tr.append('<td>' + row.salario + '€</td>');
                          tr.append('<td><button class="btn btn-warning text-white btn-sm editar" id="editar">Editar</button></td>');
                          $('#dataTable tbody').append(tr);
                        });

                        var total_paginas = Math.ceil(data.total / progressoes_por_pagina);
                        var pagination = $('.pagination .pages');
                        pagination.empty();

                        function makeClickHandler(page) {
                          return function (e) {
                            e.preventDefault();
                            carregarProgressoes(page);
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
                            carregarProgressoes(pagina_atual - 1);
                          }
                        });
                        $('.pagination .next').off('click').on('click', function (e) {
                          e.preventDefault();
                          if (pagina_atual < total_paginas) {
                            carregarProgressoes(pagina_atual + 1);
                          }
                        });
                      }

                      carregarProgressoes(pagina_atual);
                      // Adiciona um manipulador de eventos para o botão de editar
                      $('#dataTable').on('click', '.editar', function () {
                        var row = $(this).closest('tr');
                        var img = row.find('img').attr('src');
                        var nome = row.find('td:eq(0)').text();
                        var descricao = row.find('td:eq(1)').text();
                        var local = row.find('td:eq(2)').text();
                        var idade = row.find('td:eq(3)').text();
                        var ano_inicio = row.find('td:eq(4)').text();
                        var ano_fim = row.find('td:eq(5)').text();
                        var salario = row.find('td:eq(6)').text();

                        
                        console.log(img, nome, descricao, local, idade, ano_inicio, ano_fim, salario);
                      });
                      // Adiciona um manipulador de eventos para o botão de editar
                      $('#dataTable').on('click', '.editar', function () {
                        var row = $(this).closest('tr');
                        var nome = row.find('td:eq(0)').text();
                        var cargo = row.find('td:eq(1)').text();
                        var local = row.find('td:eq(2)').text();
                        var idade = row.find('td:eq(3)').text();
                        var data_inicio = row.find('td:eq(4)').text();
                        var data_fim = row.find('td:eq(5)').text();
                        var salario = row.find('td:eq(6)').text();

                        // Preenche o formulário com os dados da linha
                        $('#nome').val(nome);
                        $('#cargo option').filter(function () {
                          return $(this).text() == cargo;
                        }).prop('selected', true);
                        $('#local').val(local);
                        $('#idade').val(idade);
                        $('#data_inicio').val(data_inicio);
                        $('#data_fim').val(data_fim);
                        $('#salario').val(salario);

                        // Mostra o formulário
                        $('#editForm').show();
                      });
                    });

                    $(document).ready(function () {
                      $.ajax({
                        url: './progressao/getCargos.php',
                        type: 'get',
                        dataType: 'json',
                        success: function (data) {
                          var select = $('#cargo');
                          $.each(data, function (key, value) {
                            select.append('<option value="' + value.id_cargo + '">' + value.descricao + '</option>');
                          });
                        }
                      });

                      // Adiciona um manipulador de eventos para o evento change do dropdown
                      $('#cargo').on('change', function () {
                        console.log('ID do cargo selecionado: ' + this.value);
                      });
                    });

                  </script>
                  <style>
                    #overlay {
                      position: fixed;
                      top: 0;
                      left: 0;
                      width: 100%;
                      height: 100%;
                      background-color: rgba(0, 0, 0, 0.5);
                      backdrop-filter: blur(5px);
                      z-index: 999;
                      display: none;
                    }
                  </style>
                  <div id="overlay" style="display: none;"></div>
                  <div id="editForm" class="modal" style="display: none;">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Editar Progressão</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form action="./progressao/atualizar.php" method="post" id="editFormulario">
                            <div class="mb-3">
                              <label for="nome" class="form-label">Nome:</label>
                              <input type="text" class="form-control" id="nome" name="nome">
                            </div>
                            <div class="mb-3">
                              <label for="cargo" class="form-label">Cargo:</label>
                              <select id="cargo" name="cargo" class="form-select"></select>
                            </div>
                            <div class="mb-3">
                              <label for="local" class="form-label">Local:</label>
                              <input type="text" class="form-control" id="local" name="local">
                            </div>
                            <div class="mb-3">
                              <label for="idade" class="form-label">Idade:</label>
                              <input type="text" class="form-control" id="idade" name="idade">
                            </div>
                            <div class="mb-3">
                              <label for="data_inicio" class="form-label">Data de Início:</label>
                              <input type="text" class="form-control datepicker" id="data_inicio" name="data_inicio">
                            </div>
                            <div class="mb-3">
                              <label for="data_fim" class="form-label">Data de Fim:</label>
                              <input type="text" class="form-control datepicker" id="data_fim" name="data_fim">
                            </div>
                            <div class="mb-3">
                              <label for="salario" class="form-label">Salário:</label>
                              <input type="text" class="form-control" id="salario" name="salario">
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Popup de Erro -->
                  <div id="errorPopup" class="modal" tabindex="-1" role="dialog" style="display:none;">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Erro</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p>Ocorreu um erro ao tentar enviar os dados.</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <script>
                    document.addEventListener('DOMContentLoaded', function () {
                      var form = document.getElementById('editFormulario');
                      form.addEventListener('submit', function (e) {
                        e.preventDefault();
                        var formData = new FormData(form);
                        var xhr = new XMLHttpRequest();
                        xhr.open('POST', form.action, true);
                        xhr.onload = function () {
                          if (xhr.status === 200) {
                            var overlay = document.getElementById('overlay');
                            var editFormModal = bootstrap.Modal.getInstance(document.getElementById('editForm'));

                            overlay.style.display = 'none';
                            if (editFormModal) {
                              editFormModal.hide();
                            }
                            window.location.reload();
                          } else {
                            var errorPopup = document.getElementById('errorPopup');
                            var modal = new bootstrap.Modal(errorPopup);
                            modal.show();
                          }
                        };
                        xhr.send(formData);
                      });
                      $('#editForm').on('hidden.bs.modal', function () {
                      $('#overlay').hide();
                    });
                    });
                  </script>
                  <script>
                    document.addEventListener('DOMContentLoaded', function () {
                      var overlay = document.getElementById('overlay');
                      var editFormModal = new bootstrap.Modal(document.getElementById('editForm'), {
                        keyboard: false
                      });

                      document.addEventListener('click', function (e) {
                        if (e.target && e.target.id === 'editar') {
                          overlay.style.display = 'block';
                          editFormModal.show();
                        }
                      });

                      var closeBtns = document.querySelectorAll('.btn-close');
                      closeBtns.forEach(function (btn) {
                        btn.addEventListener('click', function () {
                          overlay.style.display = 'none';
                          editFormModal.hide();
                        });
                      });
                    });
                  </script>

                </div>
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