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
    <title>Dashboard Feedback - CodeWave</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body id="page-top">
    <div id="wrapper">
        <nav class="navbar align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0 navbar-dark">
            <div class="container-fluid d-flex flex-column p-0">
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"><img src="./assets/img/1.png" alt="Icon CodeWave" width="40px" height="40px"></div>
                    <div class="sidebar-brand-text mx-3"><img src="./assets/img/codewave_logo_sfundo.png" alt="CodeWave" width="150px" height="100px"></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
          <li class="nav-item"><a class="nav-link" href="index.php"><i
                class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
          <li class="nav-item"><a class="nav-link" href="profile.html"><i
                class="fas fa-user"></i><span>Profile</span></a></li>
          <li class="nav-item"><a class="nav-link" href="table.html"><i class="fas fa-table"></i><span>Table</span></a>
          </li>
          <li class="nav-item"><a class="nav-link" href="bilhetes.php"><i
                class="fas fa-ticket-alt"></i><span>Bilhetes</span></a></li>
          <li class="nav-item"><a class="nav-link" href="alugueres.php"><i
                class="fas fa-umbrella-beach"></i><span>Alugueres</span></a></li>
          <li class="nav-item"><a class="nav-link" href="categorias.php"><i
                class="fas fa-cubes"></i><span>Categorias</span></a></li>
          <li class="nav-item"><a class="nav-link" href="eventos.php"><i
                class="fas fa-calendar"></i><span>Evento</span></a></li>
          <li class="nav-item"><a class="nav-link" href="zonas.php"><i
                class="fas fa-map-marker-alt"></i><span>Zona</span></a></li>
          <li class="nav-item"><a class="nav-link" href="produto.php"><i class="fas fa-box"></i><span>Produto</span></a>
          </li>
          <li class="nav-item"><a class="nav-link" href="funcionarios.php"><i
                class="fas fa-address-book"></i><span>Funcionário</span></a></li>
          <li class="nav-item"><a class="nav-link" href="cargo.php"><i
                class="fas fa-address-card"></i><span>Cargo</span></a></li>
          <li class="nav-item"><a class="nav-link active" href="feedback.php"><i
                class="fas fa-quote-right"></i><span>Feedback</span></a></li>
          <li class="nav-item"><a class="nav-link" href="restauracao.php"><i
                class="fas fa-solid fa-utensils"></i><span>Restauração</span></a></li>
          <li class="nav-item"><a class="nav-link" href="gerir_horario.php"><i
                class="fas fa-calendar"></i><span>Horário</span></a></li>
          <li class="nav-item"><a class="nav-link" href="noticias.php"><i
                class="fas fa-newspaper"></i><span>Notícias</span></a></li>
        </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-expand bg-white shadow mb-4 topbar static-top navbar-light">
                    <div class="container-fluid">
                        <button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow">
                                    <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                                        <span class="d-none d-lg-inline me-2 text-gray-600 small"><?php echo $_SESSION['userf_name']; ?></span>
                                        <img class="border rounded-circle img-profile" src="<?php echo $_SESSION['userf_img']; ?>">
                                    </a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="#"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile</a><a class="dropdown-item" href="#"><i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Settings</a><a class="dropdown-item" href="#"><i class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Activity log</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" href="./login.html"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Dashboard Feedback</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-primary py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Número de Feedback</span></div>
                                            <div class="text-dark fw-bold h5 mb-0">
                                                <span><?php require "../feedbacks/totalFeedbacks.php"; ?></span>
                                            </div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-quote-right fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container mt-4">
                            <div class="table-responsive">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome do utilizador</th>
                                            <th>Data</th>
                                            <th>Descrição</th>
                                            <th>Avaliação</th>
                                            <th>Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabelaFeedbacks">
                                        <?php
                                        include '../feedbacks/mostrarTodosFeedbacks.php';
                                        // Preenche a tabela com os dados dos feedbacks
                                        if (isset($resultado) && $resultado->rowCount() > 0) {
                                            while ($feedback = $resultado->fetch(PDO::FETCH_ASSOC)) {
                                                echo '<tr>';
                                                echo '<td>' . $feedback['id_feedback'] . '</td>';
                                                echo '<td>' . $feedback['nome_utilizador'] . '</td>';
                                                echo '<td>' . $feedback['data_formatada'] . '</td>';
                                                echo '<td>' . $feedback['descricao'] . '</td>';
                                                echo '<td>';
                                                $avaliacao = $feedback['avaliacao'];
                                                $num_estrelas = floor($avaliacao);
                                                // Adiciona estrelas inteiras
                                                for ($i = 0; $i < $num_estrelas; $i++) {
                                                    echo '<i class="fa fa-star" aria-hidden="true"></i>';
                                                }
                                                echo '</td>';
                                                echo "<td>
                                                      <button class='btn btn-danger btn-sm' onclick='apagarFeedback(" . $feedback['id_feedback'] . ")'>Apagar</button>
                                                  </td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='6'>Nenhum feedback encontrado</td></tr>";
                                        }
                                        ?>
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
                                function apagarFeedback(id_feedback) {
                                    if (confirm("Tem certeza de que deseja apagar este feedback?")) {
                                        window.location.href = "../feedbacks/apagarFeedback.php?id_feedback=" + id_feedback;
                                    }
                                }
                            </script>
                        </div>
                    </div>
                </div>
                <footer class="bg-white sticky-footer">
                    <div class="container my-auto">
                        <div class="text-center my-auto copyright"><span>Copyright © CodeWave 2024</span></div>
                    </div>
                </footer>
            </div>
            <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
        </div>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/chart.min.js"></script>
        <script src="assets/js/bs-init.js"></script>
        <script src="assets/js/theme.js"></script>
    </div>
</body>
</html>
