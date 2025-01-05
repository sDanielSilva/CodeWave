$.get("index/total_bilhetes_vendidos.php", function (data) {
  console.log(data);
  $("#totalBilhetesVendidos").text(data);
});

$.get("index/total_funcionarios.php", function (data) {
  $("#totalFuncionarios").text(data);
});

$.get("index/total_produtos.php", function (data) {
  $("#totalProdutos").text(data);
});

$.get("index/total_feedbacks.php", function (data) {
  $("#totalFeedbacks").text(data);
});

$.get("index/total_eventos.php", function (data) {
  $("#totalEventos").text(data);
});

$.get("index/total_utilizadores.php", function (data) {
  $("#totalUtilizadores").text(data);
});

$.get("index/total_compras.php", function (data) {
  $("#totalCompras").text(data);
});

$.get("index/media_convidados.php", function (data) {
  $("#mediaConvidados").text(data);
});

$.get("index/total_mes.php", function (data) {
  if (!data) {
    console.error("Nenhum dado retornado do servidor.");
    return;
  }
  data = JSON.parse(data);
  if (!Array.isArray(data.total_revenue)) {
    console.error("total_revenue is not an array.");
    return;
  }
  var ctx = document.getElementById("revenueChart").getContext("2d");
  console.log(data);

  // Converte os dados para números
  var total_revenue = data.total_revenue.map(Number);

  var months = data.months.map(function (date) {
    var d = new Date(date);
    var month = ("0" + (d.getMonth() + 1)).slice(-2);
    var year = d.getFullYear().toString().substr(-2);
    return month + "/" + year;
  });

  var chart = new Chart(ctx, {
    type: "line",
    data: {
      labels: months,
      datasets: [
        {
          label: "Receita Total",
          data: total_revenue, // usa os dados convertidos
          backgroundColor: "rgba(75, 192, 192, 0.2)",
          borderColor: "rgba(75, 192, 192, 1)",
          borderWidth: 1,
        },
      ],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
      },
    },
  });
});

$.get("index/produto_mais_vendido.php", function (data) {
  if (!data) {
    console.error("Nenhum dado retornado do servidor.");
    return;
  }
  data = JSON.parse(data);
  if (!Array.isArray(data.total_vendido)) {
    console.error("total_vendido is not an array.");
    return;
  }
  var ctx = document.getElementById("produtoMaisVendidoChart").getContext("2d");
  console.log(data);

  var total_vendido = data.total_vendido.map(Number);
  var produto_mais_vendido = data.produto_mais_vendido;

  var months = data.months.map(function (date) {
    var d = new Date(date);
    var month = ("0" + (d.getMonth() + 1)).slice(-2);
    var year = d.getFullYear().toString().substr(-2);
    return month + "/" + year;
  });

  var chart = new Chart(ctx, {
    type: "bar",
    data: {
      labels: months,
      datasets: [
        {
          label: "Total Vendido",
          data: total_vendido,
          backgroundColor: "rgba(75, 192, 192, 0.2)",
          borderColor: "rgba(75, 192, 192, 1)",
          borderWidth: 1,
        },
      ],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
      },
      tooltips: {
        callbacks: {
          title: function (tooltipItem, data) {
            var monthIndex = tooltipItem[0].index;
            return (
              produto_mais_vendido[monthIndex] + " - " + data.labels[monthIndex]
            );
          },
        },
      },
    },
  });
});

function getReceitaPorCategoria(periodo) {
  $.get("index/total_por_categoria.php?periodo=" + periodo, function (data) {
    if (!data) {
      console.error("Nenhum dado retornado do servidor.");
      return;
    }
    data = JSON.parse(data);
    if (!Array.isArray(data.total_receita)) {
      console.error("total_receita is not an array.");
      return;
    }
    var categorias = data.categorias;
    var total_receita = data.total_receita.map(Number);

    var ctx = document
      .getElementById("receitaPorCategoriaChart")
      .getContext("2d");
    var chart = new Chart(ctx, {
      type: "pie",
      data: {
        labels: categorias,
        datasets: [
          {
            data: total_receita,
            backgroundColor: [
              "rgba(255, 99, 132, 0.2)",
              "rgba(54, 162, 235, 0.2)",
              "rgba(255, 206, 86, 0.2)",
              "rgba(75, 192, 192, 0.2)",
              "rgba(153, 102, 255, 0.2)",
              "rgba(255, 159, 64, 0.2)",
            ],
            borderColor: [
              "rgba(255, 99, 132, 1)",
              "rgba(54, 162, 235, 1)",
              "rgba(255, 206, 86, 1)",
              "rgba(75, 192, 192, 1)",
              "rgba(153, 102, 255, 1)",
              "rgba(255, 159, 64, 1)",
            ],
            borderWidth: 1,
          },
        ],
      },
    });
  });
}

$.get("index/eventos_por_mes.php", function (data) {
  if (!data) {
    console.error("Nenhum dado retornado do servidor.");
    return;
  }
  data = JSON.parse(data);
  if (!Array.isArray(data.num_eventos)) {
    console.error("num_eventos is not an array.");
    return;
  }
  var meses = data.months.map(function (date) {
    var d = new Date(date);
    var month = ("0" + (d.getMonth() + 1)).slice(-2);
    var year = d.getFullYear().toString().substr(-2);
    return month + "/" + year;
  });
  var num_eventos = data.num_eventos.map(Number);

  var ctx = document.getElementById("eventosPorMesChart").getContext("2d");
  var chart = new Chart(ctx, {
    type: "line",
    data: {
      labels: meses,
      datasets: [
        {
          label: "Número de Eventos",
          data: num_eventos,
          fill: false,
          borderColor: "rgb(75, 192, 192)",
          tension: 0.1,
        },
      ],
    },
  });
});

function getCategoriasMaisPopulares(periodo) {
  $.get(
    "index/categorias_mais_populares.php?periodo=" + periodo,
    function (data) {
      if (!data) {
        console.error("Nenhum dado retornado do servidor.");
        return;
      }
      data = JSON.parse(data);
      if (!Array.isArray(data.total_vendido)) {
        console.error("total_vendido is not an array.");
        return;
      }
      var ctx = document
        .getElementById("categoriasMaisPopularesChart")
        .getContext("2d");
      console.log(data);

      var total_vendido = data.total_vendido.map(Number);
      var categorias = data.categorias;

      var chart = new Chart(ctx, {
        type: "bar",
        data: {
          labels: categorias,
          datasets: [
            {
              label: "Total Vendido",
              data: total_vendido,
              backgroundColor: "rgba(75, 192, 192, 0.2)",
              borderColor: "rgba(75, 192, 192, 1)",
              borderWidth: 1,
            },
          ],
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
            },
          },
        },
      });
    }
  );
}

function getClassificacoesClientes(periodo) {
  $.get(
    "index/classificacoes_clientes.php?periodo=" + periodo,
    function (data) {
      if (!data) {
        console.error("Nenhum dado retornado do servidor.");
        return;
      }
      data = JSON.parse(data);

      var labels = Object.keys(data.classificacoes);
      var valores = Object.values(data.classificacoes);
      var media = data.media;

      document.getElementById("mediaClassificacoes").textContent =
        "Média das Classificações: " + media.toFixed(2);

      var ctx = document
        .getElementById("classificacoesClientesChart")
        .getContext("2d");
      if (window.classificacoesChart) {
        window.classificacoesChart.destroy();
      }
      window.classificacoesChart = new Chart(ctx, {
        type: "bar",
        data: {
          labels: labels,
          datasets: [
            {
              label: "Número de Classificações",
              data: valores,
              backgroundColor: "rgba(54, 162, 235, 0.2)",
              borderColor: "rgba(54, 162, 235, 1)",
              borderWidth: 1,
            },
          ],
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
            },
          },
        },
      });
    }
  );
}

var periodo = document.getElementById("periodo").value;
getCategoriasMaisPopulares(periodo);

var periodoRPC = document.getElementById("periodoRPC").value;
getReceitaPorCategoria(periodoRPC);

var periodoCC = document.getElementById("periodoCC").value;
getClassificacoesClientes(periodoCC);

$(document).ready(function () {
  $(".btn-primary").click(function () {
    // Função para capturar elementos como imagens
    async function captureElement(elementId) {
      const element = document.getElementById(elementId);
      if (!element) {
        console.error(`Elemento com ID ${elementId} não encontrado.`);
        return null;
      }
      return html2canvas(element).then((canvas) => {
        return canvas.toDataURL("image/png");
      });
    }

    async function gerarRelatorioPDF() {
      var pdf = new jsPDF("p", "pt", "a4");
      var position = { x: 20, y: 30 };

      pdf.setFontSize(18);
      pdf.setFontStyle("bold");
      pdf.text("Relatório de Estatísticas", position.x, position.y);
      position.y += 60;

      const categorias = [
        { id: "totalBilhetesVendidos", nome: "Bilhetes Vendidos" },
        { id: "totalFuncionarios", nome: "Funcionários" },
        { id: "totalProdutos", nome: "Produtos" },
        { id: "totalFeedbacks", nome: "Feedbacks" },
        { id: "totalEventos", nome: "Eventos" },
        { id: "totalUtilizadores", nome: "Utilizadores" },
        { id: "totalCompras", nome: "Compras" },
        { id: "mediaConvidados", nome: "Média de Convidados por Evento" },
        {
          id: "mediaClassificacoes",
          nome: "Média das Classificações de Clientes",
        },
      ];

      categorias.forEach((categoria) => {
        pdf.setFontSize(14);
        pdf.setFontStyle("bold");
        pdf.text(`${categoria.nome}`, position.x, position.y);
        position.y += 20;

        const data = $("#" + categoria.id).text();
        pdf.setFontSize(14);
        pdf.setFontStyle("normal");
        pdf.text(`Total: ${data}`, position.x, position.y);
        position.y += 15;

        if (position.y > pdf.internal.pageSize.getHeight() - 100) {
          pdf.addPage();
          position.y = 20;
        }
      });

      position.y += 100;

      const graficos = [
        {
          id: "revenueChart",
          legenda: "Gráfico de Receita Mensal dos Bilhetes: ",
        },
        {
          id: "produtoMaisVendidoChart",
          legenda: "Gráfico de Produto Mais Vendido por Mès: ",
        },
        {
          id: "receitaPorCategoriaChart",
          legenda: "Gráfico de Receita por Categoria: ",
        },
        {
          id: "eventosPorMesChart",
          legenda: "Gráfico de Eventos por Mês: ",
        },
        {
          id: "categoriasMaisPopularesChart",
          legenda: "Gráfico de Categorias Mais Populares: ",
        },
        {
          id: "classificacoesClientesChart",
          legenda: "Gráfico de Classificações de Clientes: ",
        },
      ];

      for (const { id, legenda } of graficos) {
        const imageData = await captureElement(id);
        if (imageData) {
          pdf.setFontSize(14);
          pdf.setFontStyle("bold");
          pdf.text(legenda, position.x, position.y);
          position.y += 30;

          var imgProps = pdf.getImageProperties(imageData);
          var pdfWidth = pdf.internal.pageSize.getWidth();
          var scaledWidth = pdfWidth * 0.75; // Escala a largura da imagem
          var scaledHeight = (imgProps.height * scaledWidth) / imgProps.width; // Escala a altura proporcionalmente

          if (position.y + scaledHeight > pdf.internal.pageSize.getHeight()) {
            pdf.addPage();
            position.y = 20;
          }

          pdf.addImage(
            imageData,
            "PNG",
            position.x,
            position.y,
            scaledWidth,
            scaledHeight
          );
          position.y += scaledHeight + 10;
        }
      }

      pdf.save("relatorio_estatisticas.pdf");
    }

    gerarRelatorioPDF();
  });
});
