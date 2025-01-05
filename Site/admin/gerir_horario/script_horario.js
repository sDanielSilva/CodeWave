async function buscarHorarios() {
  const response = await fetch("gerir_horario/horarios_gerente.php");
  const data = await response.json();
  preencherHorarios(data["geral"], "GeralAdmin");
  preencherHorarios(data["escolas"], "EscolasAdmin");
}

window.onload = async function () {
  await buscarHorarios();
  document
    .getElementById("botaoGuardar")
    .addEventListener("click", async function () {
      await atualizarHorarios("Geral");
      await atualizarHorarios("Escolas");
      displayNotification("Horários atualizados com sucesso!", true);
    });
};

function preencherHorarios(horarios, modalidade) {
  var dias = [
    "Domingo",
    "Segunda",
    "Terça",
    "Quarta",
    "Quinta",
    "Sexta",
    "Sábado",
  ];

  dias.forEach(function (dia, index) {
    var diaNumerico = index + 1;
    var abertura = horarios[diaNumerico][0];
    var fecho = horarios[diaNumerico][1];

    var inputAbertura = document.getElementById(
      "abertura" + modalidade + diaNumerico
    );
    if (inputAbertura) {
      inputAbertura.value = abertura;
    }

    var inputFecho = document.getElementById(
      "fecho" + modalidade + diaNumerico
    );
    if (inputFecho) {
      inputFecho.value = fecho;
    }
  });
}

function atualizarHorarios(modalidade) {
  var horarios = {};
  var dias = [
    "Domingo",
    "Segunda",
    "Terça",
    "Quarta",
    "Quinta",
    "Sexta",
    "Sábado",
  ];

  var inputsAbertura = document.querySelectorAll(
    'input[id^="abertura' + modalidade + '"]'
  );
  var inputsFecho = document.querySelectorAll(
    'input[id^="fecho' + modalidade + '"]'
  );

  dias.forEach(function (dia, index) {
    var diaNumerico = index + 1;
    var abertura = inputsAbertura[index].value;
    var fecho = inputsFecho[index].value;

    horarios[diaNumerico] = {
      dia: diaNumerico,
      abertura: abertura === "Encerrado" ? null : abertura,
      fecho: fecho === "Encerrado" ? null : fecho,
    };
  });

  var data = {
    modalidade: modalidade.toLowerCase(),
    horarios: horarios,
  };

  fetch("gerir_horario/update_horario.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(data),
  })
    .then((response) => response.text())
    .then((data) => console.log(data))
    .catch((error) => console.error("Erro:", error));
}

function toggleTab(tabIndex) {
  const tabs = document.querySelectorAll(".tab");
  const tabContents = document.querySelectorAll(".tab-content");

  tabs.forEach((tab, index) => {
    if (index === tabIndex) {
      tab.classList.add("active");
      tabContents[index].classList.add("active");
    } else {
      tab.classList.remove("active");
      tabContents[index].classList.remove("active");
    }
  });
}

// Função para exibir mensagens de notificação
function displayNotification(message, isSuccess) {
  var notificationContainer = document.getElementById("notificationContainer");
  var notificationMessage = document.getElementById("notificationMessage");
  notificationMessage.textContent = message;
  notificationMessage.style.color = isSuccess ? "green" : "red"; // Verde para sucesso, vermelho para erro
  notificationContainer.style.display = "block";

  // Ocultar a notificação após 5 segundos
  setTimeout(function () {
    notificationContainer.style.display = "none";
  }, 3000);
}

// Função para ocultar mensagens de notificação
function hideNotification() {
  var notificationContainer = document.getElementById("notificationContainer");
  notificationContainer.style.display = "none";
}
