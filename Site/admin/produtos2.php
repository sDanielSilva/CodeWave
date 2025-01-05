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
}else if ($id_cargo != 1) {
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
              <li class="nav-item"><a class="nav-link active" href="produtos.php"><i class="fas fa-box"></i><span>Produtos</span></a></li>
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
                      <span id="notification-badge" class="badge bg-danger badge-counter">3+</span>
                      <i class="fas fa-bell fa-fw"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
                      <h6 class="dropdown-header">Alertas</h6> <?php require './alertas/alerta.php'; ?> <a class="dropdown-item text-center small text-gray-500" href="#">Ver Todos os Alertas</a>
                    </div>
                  </div>
                </li>
                <script src="evento.js"></script>
                <div class="d-none d-sm-block topbar-divider"></div>
                <li class="nav-item dropdown no-arrow">
                  <div class="nav-item dropdown no-arrow">
                    <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                      <span class="d-none d-lg-inline me-2 text-gray-600 small"> <?php echo $_SESSION['userf_name']; ?> </span>
                      <img class="border rounded-circle img-profile" src="
																				
																				<?php echo $_SESSION['userf_img']; ?>">
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
                            <span>Número de Produtos</span>
                          </div>
                          <div class="text-dark fw-bold h5 mb-0">
                            <span> <?php require "./produtos/totalProduto.php"; ?> </span>
                          </div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-boxes fa-2x text-gray-300"></i>
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
                            <span>Adicionar Produtos</span>
                          </div>
                          <div class="text-dark fw-bold h5 mb-0">
                            <button type="button" id="btnAdicionar" class="btn btn-success text-white">Adicionar</button>
                          </div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-boxes  fa-2x text-gray-300"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div id="overlay" style="display: none;"></div>
              <div id="modalFormulario" class="modal" style="display: none;">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Adicionar Funcionário</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" id="btnFechar" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form id="formAdicionarFuncionario" method="POST" action="./funcionarios/adicionarFuncionario.php">
                        <div class="mb-3">
                          <label for="nomeFuncionario" class="form-label">Nome do Funcionário</label>
                          <input type="text" class="form-control" id="nomeFuncionario" name="nomeFuncionario">
                        </div>
                        <div class="mb-3">
                          <label for="emailFuncionario" class="form-label">Email</label>
                          <input type="email" class="form-control" id="emailFuncionario" name="emailFuncionario">
                        </div>
                        <div class="mb-3">
                          <label for="passwordFuncionario" class="form-label">Password</label>
                          <input type="password" class="form-control" id="passwordFuncionario" name="passwordFuncionario">
                        </div>
                        <div class="mb-3">
                          <label for="imagemFuncionario" class="form-label">Imagem</label>
                          <input type="file" class="form-control" id="imagemFuncionario" name="imagemFuncionario">
                          <input type="hidden" id="imagemUrl" name="imagemUrl">
                        </div>
                        <div class="mb-3">
                          <label for="cargoFuncionario" class="form-label">Cargo</label>
                          <select class="form-control" id="cargoFuncionario" name="cargoFuncionario"></select>
                        </div>
                        <button type="submit" class="btn btn-primary">Adicionar</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <script>
                document.addEventListener("DOMContentLoaded", function() {
                  fetch('./funcionarios/cargos.php').then(response => response.json()).then(data => {
                    const cargoSelect = document.getElementById('cargoFuncionario');
                    if (data.error) {
                      console.error(data.error);
                      return;
                    }
                    data.forEach(cargo => {
                      const option = document.createElement('option');
                      option.value = cargo.id;
                      option.textContent = cargo.descricao;
                      cargoSelect.appendChild(option);
                    });
                  }).catch(error => console.error('Erro ao carregar os cargos:', error));
                });
              </script>
              <div id="modalEditar-overlay"></div>
              <div id="modalEditar" class="modal" style="display: none;">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Editar Funcionário</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" id="btnFecharEditar" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form id="formEditarFuncionario" method="POST" action="./funcionarios/atualizarFuncionario.php">
                        <input type="hidden" id="edit_id_funcionario" name="edit_id_funcionario">
                        <div class="mb-3">
                          <label for="edit_nomeFuncionario" class="form-label">Novo Nome do Funcionário</label>
                          <input type="text" class="form-control" id="edit_nomeFuncionario" name="edit_nomeFuncionario">
                        </div>
                        <div class="mb-3">
                          <label for="edit_password" class="form-label">Nova Password</label>
                          <div class="input-group">
                            <input type="password" class="form-control" id="edit_password" name="edit_password">
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                              <i class="fas fa-eye" id="toggleIcon"></i>
                            </button>
                          </div>
                        </div>
                        <div class="mb-3">
                          <label for="edit_email" class="form-label">Novo Email</label>
                          <input type="email" class="form-control" id="edit_email" name="edit_email">
                        </div>
                        <div class="mb-3">
                          <label for="edit_img" class="form-label">Nova Imagem</label>
                          <input type="text" class="form-control" id="edit_img" name="edit_img">
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <link rel="stylesheet" href="cargo/styles/style.css">
              <div class="container-fluid">
                <div class="card shadow">
                  <div class="card-header py-3">
                    <p class="text-primary m-0 fw-bold">Produto Informações</p>
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
                            <th>Foto</th>
                            <th>Nome</th>
                            <th>Preço</th>
                            <th>Stock</th>
                            <th>IVA</th>
                            <th>Categoria</th>
                            <th>Ações</th>
                          </tr>
                        </thead>
                        <tbody> <?php include './produtos/produtosScript.php'; ?> </tbody>
                      </table>
                    </div>
                    <div class="row">
                      <div class="col-md-6 align-self-center">
                        <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">A mostrar 1 de <span id="numeroFuncionarios"> <?php include './produtos/totalProduto.php'; ?> </span>
                        </p>
                      </div>
                      <div class="col-md-6"></div>
                    </div>
                    <div id="confirm-delete-overlay" style="display: none;"></div>
                    <div id="confirm-delete-modal" class="modal" style="display: none;">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Excluir Produto</h5>
                          </div>
                          <div class="modal-body">
                            <p>Tem certeza que deseja apagar este produto?</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                            <button type="button" class="btn btn-danger" onclick="apagarProduto(<?php echo $id_produto; ?>)">Sim </button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <script>
                      $(document).ready(function() {
                        $(document).on('click', '.toggle-password', function() {
                          var passwordField = $(this).closest('.input-group').find('.password-field');
                          var passwordFieldType = passwordField.attr('type');
                          if (passwordFieldType === 'password') {
                            passwordField.attr('type', 'text');
                            $(this).find('i').removeClass('fa-eye-slash').addClass('fa-eye');
                          } else {
                            passwordField.attr('type', 'password');
                            $(this).find('i').removeClass('fa-eye').addClass('fa-eye-slash');
                          }
                        });
                      });
                    </script>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                    <script>
                      $(document).ready(function() {
                        $('#edit_password').attr('type', 'password');
                        $('#togglePassword').click(function() {
                          var passwordField = $('#edit_password');
                          var passwordToggle = $('#toggleIcon');
                          if (passwordField.attr('type') === 'password') {
                            passwordField.attr('type', 'text');
                            passwordToggle.removeClass('fa-eye').addClass('fa-eye-slash');
                          } else {
                            passwordField.attr('type', 'password');
                            passwordToggle.removeClass('fa-eye-slash').addClass('fa-eye');
                          }
                        });
                      });
                      $(document).ready(function() {
                        $('#formEditarFuncionario').submit(function(event) {
                          event.preventDefault();
                          var id_funcionario = $('#edit_id_funcionario').val();
                          var novo_nome_funcionario = $('#edit_nomeFuncionario').val();
                          var nova_password = $('#edit_password').val();
                          var novo_email = $('#edit_email').val();
                          var nova_img = $('#edit_img').val();
                          $.ajax({
                            type: 'POST',
                            url: './funcionarios/atualizaFuncionario.php',
                            data: {
                              edit_id_funcionario: id_funcionario,
                              edit_nomeFuncionario: novo_nome_funcionario,
                              edit_password: nova_password,
                              edit_email: novo_email,
                              edit_img: nova_img
                            },
                            success: function(response) {
                              location.reload();
                            },
                            error: function(xhr, status, error) {
                              alert('Erro ao atualizar funcionário. Por favor, tente novamente.');
                            }
                          });
                        });
                      });
                      $('#btnFecharEditar').click(function() {
                        $('#modalEditar-overlay').hide();
                        $('#modalEditar').modal('hide');
                      });

                      function editarFuncionario(id_funcionario, nome_funcionario, password, email, img) {
                        $('#edit_id_funcionario').val(id_funcionario);
                        $('#edit_nomeFuncionario').val(nome_funcionario);
                        $('#edit_password').val(password);
                        $('#edit_email').val(email);
                        $('#edit_img').val(img);
                        $('#modalEditar-overlay').show();
                        $('#modalEditar').modal('show');
                      }
                    </script>
                    <style>
                      #modalEditar-overlay {
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
                        document.getElementById("btnAdicionar").addEventListener("click", function() {
                          document.getElementById("modalFormulario").style.display = "block";
                          document.getElementById("overlay").style.display = "block";
                        });
                        document.getElementById("btnFechar").addEventListener("click", function() {
                          document.getElementById("modalFormulario").style.display = "none";
                          document.getElementById("overlay").style.display = "none";
                        });
                        var nomeFuncionarioInput = document.getElementById("nomeFuncionario");
                        var emailFuncionarioInput = document.getElementById("emailFuncionario");
                        var passwordFuncionarioInput = document.getElementById("passwordFuncionario");
                        nomeFuncionarioInput.addEventListener("input", function() {
                          if (this.value.trim() !== "") {
                            this.classList.remove("is-invalid");
                          }
                        });
                        emailFuncionarioInput.addEventListener("input", function() {
                          if (this.value.trim() !== "") {
                            this.classList.remove("is-invalid");
                          }
                        });
                        passwordFuncionarioInput.addEventListener("input", function() {
                          if (this.value.trim() !== "") {
                            this.classList.remove("is-invalid");
                          }
                        });
                        document.getElementById("formAdicionarFuncionario").addEventListener("submit", async function(event) {
                          var nomeFuncionario = nomeFuncionarioInput.value.trim();
                          var emailFuncionario = emailFuncionarioInput.value.trim();
                          var passwordFuncionario = passwordFuncionarioInput.value.trim();
                          var imagemFuncionarioInput = document.getElementById("imagemFuncionario");
                          if (nomeFuncionario === "") {
                            event.preventDefault();
                            nomeFuncionarioInput.classList.add("is-invalid");
                          }
                          if (emailFuncionario === "") {
                            event.preventDefault();
                            emailFuncionarioInput.classList.add("is-invalid");
                          }
                          if (passwordFuncionario === "") {
                            event.preventDefault();
                            passwordFuncionarioInput.classList.add("is-invalid");
                          }
                          if (imagemFuncionarioInput.files.length > 0) {
                            event.preventDefault();
                            var imagemFile = imagemFuncionarioInput.files[0];
                            var formData = new FormData();
                            formData.append('image', imagemFile);
                            try {
                                var response = await fetch('https://api.imgbb.com/1/upload?key=' + getenv('IMGBB_API_KEY'), {
                                method: 'POST',
                                body: formData
                              });
                              var result = await response.json();
                              var imageUrl = result.data.url;
                              document.getElementById("imagemUrl").value = imageUrl;
                              this.submit();
                            } catch (error) {
                              console.error('Erro ao enviar a imagem:', error);
                            }
                          }
                        });
                        document.getElementById("btnFechar").addEventListener("click", function() {
                          nomeFuncionarioInput.classList.remove("is-invalid");
                          emailFuncionarioInput.classList.remove("is-invalid");
                          passwordFuncionarioInput.classList.remove("is-invalid");
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

                      function apagarProduto(idProduto) {
                        showDeleteConfirmationPopup();
                        document.getElementById('confirm-delete-modal').querySelector('.btn-danger').addEventListener('click', function() {
                          window.location.href = './produtos/deleteProduto.php?id_produto=' + idProduto;
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