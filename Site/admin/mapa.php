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
              <li class="nav-item"><a class="nav-link" href="feedback.php"><i class="fas fa-quote-right"></i><span>Feedbacks</span></a></li>
              <li class="nav-item"><a class="nav-link" href="restauracao.php"><i class="fas fa-solid fa-utensils"></i><span>Restauração</span></a></li>
              <li class="nav-item"><a class="nav-link" href="gerir_horario.php"><i class="fas fa-calendar"></i><span>Horários</span></a></li>
              <li class="nav-item"><a class="nav-link" href="noticias.php"><i class="fas fa-newspaper"></i><span>Notícias</span></a></li>
              <li class="nav-item"><a class="nav-link" href="progressao.php"><i class="fas fa-id-card"></i><span>Progressão</span></a></li>
              <li class="nav-item"><a class="nav-link active" href="mapa.php"><i class="fas fa-map"></i><span>Mapa</span></a></li>
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
                </div>
              </li>
              <li class="nav-item dropdown no-arrow mx-1">
                <div class="nav-item dropdown no-arrow">
                  <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                    <span id="notification-badge" class="badge bg-danger badge-counter"></span>
                    <i class="fas fa-bell fa-fw"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
                    <h6 class="dropdown-header">Alertas</h6> <?php require './alertas/alerta.php'; ?> <a
                      class="dropdown-item text-center small text-gray-500" href="./alertas.php">Ver Todos os
                      Alertas</a>
                  </div>
                </div>
              </li>
              <script src="evento.js"></script>
              <div class="d-none d-sm-block topbar-divider"></div>
              <li class="nav-item dropdown no-arrow">
                <div class="nav-item dropdown no-arrow">
                  <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                    <span class="d-none d-lg-inline me-2 text-gray-600 small"> <?php echo $_SESSION['userf_name']; ?>
                    </span>
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
            <div class="button-container">
              <button type="button" class="btn btn-success" onclick="carregarZonas()">Ver Zonas</button>
              <button type="button" class="btn btn-success" onclick="carregarMapa()">Ver Mapa</button>
            </div>
              <style>
                .button-container {
                  display: flex;
                  gap: 10px;
                  /* Espaçamento entre os botões */
                }

                .btn {
                  padding: 10px 20px;
                  font-size: 16px;
                  cursor: pointer;
                }

                .btn-success {
                  background-color: #28a745;
                  color: white;
                  border: none;
                  border-radius: 5px;
                }

                .btn-success:hover {
                  background-color: #218838;
                }
              </style>
              <script>
                function carregarZonas() {
                  const iframe = document.getElementById('myIframe');
                  if (iframe) {
                    iframe.src = './arduino/index3.php';
                  } else {
                    console.error('iFrame não encontrado.');
                  }
                }

                function carregarMapa() {
                  const iframe = document.getElementById('myIframe');
                  if (iframe) {
                    iframe.src = './arduino/index.php';
                  } else {
                    console.error('iFrame não encontrado.');
                  }
                }
              </script>
              <iframe src="./arduino/index.php" frameborder="0" width="100%" height="750px" id="myIframe"></iframe>

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