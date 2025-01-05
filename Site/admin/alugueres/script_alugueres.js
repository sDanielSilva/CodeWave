var filterPorRecolher = document.getElementById("dateFilterPorRecolher").value;
fetchAlugueresPorRecolher(filterPorRecolher);

var filterRecolhidos = document.getElementById("dateFilterRecolhidos").value;
fetchAlugueresRecolhidos(filterRecolhidos);

var alerta = document.getElementById("errorMarker").innerText;

async function recolherAluguer(id_aluguer, id_funcionario, verificationCode) {
  const response = await fetch("alugueres/recolher_aluguer.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      id_aluguer: id_aluguer,
      id_funcionario: id_funcionario,
      verificationCode: verificationCode,
    }),
  });

  if (!response.ok) {
    document.getElementById("verificationCode").classList.add("error");
    const responseData = await response.json();
    alerta = responseData.message;
  } else {
    const responseData = await response.json();
    if (responseData.status === "success") {
      console.log("Success:", responseData);
      $("#dataTablePorRecolher tbody").empty();
      $("#dataTableRecolhidos tbody").empty();
      fetchAlugueresPorRecolher(filterPorRecolher);
      fetchAlugueresRecolhidos(filterRecolhidos);
      // Fecha o formulário
      $("#verificationModal").modal("hide");
    } else {
      console.error("Error:", responseData.message);
    }
  }
}

var id_aluguer;
var id_funcionario;

function fetchAlugueresPorRecolher(filter) {
  fetch("alugueres/alugueres_recolher.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ filter: filter }),
  })
    .then((response) => response.json())
    .then((data) => {
      var tabela = document
        .getElementById("dataTablePorRecolher")
        .getElementsByTagName("tbody")[0];
      var alugueres = Array.isArray(data) ? data : [data];
      alugueres.forEach((aluguer) => {
        var row = tabela.insertRow();
        row.insertCell().innerText = aluguer.utilizador;
        row.insertCell().innerText = aluguer.tipo;
        row.insertCell().innerText = aluguer.produto;
        row.insertCell().innerText = aluguer.hora_inicio;
        row.insertCell().innerText = aluguer.hora_fim;
        var btnCell = row.insertCell();
        var btn = document.createElement("button");
        btn.textContent = "Marcar Recolha";

        btn.onclick = function () {
          id_aluguer = aluguer.id_aluguer;
          id_funcionario = document.getElementById("userf_id").value;
          // Gera um novo código de verificação
          var verificationCode = Math.floor(100000 + Math.random() * 900000);
          // Envia o e-mail com o código de verificação
          sendEmail(id_aluguer, id_funcionario, verificationCode);
          $("#verificationModal").modal("show");
        };

        btnCell.appendChild(btn);
      });
    })
    .catch((error) => console.error("Erro:", error));
}

function fetchAlugueresRecolhidos(filter) {
  fetch("alugueres/alugueres_recolhidos.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ filter: filter }),
  })
    .then((response) => response.json())
    .then((data) => {
      var tabela = document
        .getElementById("dataTableRecolhidos")
        .getElementsByTagName("tbody")[0];
      var alugueres = Array.isArray(data) ? data : [data];
      alugueres.forEach((aluguer) => {
        var row = tabela.insertRow();
        row.insertCell().innerText = aluguer.utilizador;
        row.insertCell().innerText = aluguer.tipo;
        row.insertCell().innerText = aluguer.produto;
        row.insertCell().innerText = aluguer.recolha;
        row.insertCell().innerText = aluguer.funcionario;
      });
    })
    .catch((error) => console.error("Erro:", error));
}

var globalVerificationCode;

document.getElementById("verifyButton").onclick = function () {
  var verificationCodeInput = document.getElementById("verificationCode");
  var verificationCode = verificationCodeInput.value;
  // Verifica se algum código foi inserido
  if (verificationCode.trim() === "") {
    displayErrorMessage("Por favor, insira o código de verificação.");
    verificationCodeInput.classList.add("error");
  } else {
    // Verifica se o código de verificação corresponde antes de prosseguir
    if (verificationCode === globalVerificationCode) {
      recolherAluguer(id_aluguer, id_funcionario, verificationCode);
    } else {
      displayErrorMessage("Código de verificação incorreto.");
      verificationCodeInput.classList.add("error");
    }
  }
};

document.getElementById("markWithoutCodeButton").onclick = function () {
  if (confirm("Tem a certeza que deseja marcar este aluguer sem código?")) {
    recolherAluguer(id_aluguer, id_funcionario, "");
  }
};

async function sendEmail(id_aluguer, id_funcionario) {
  // Gera um novo código de verificação
  var verificationCode = Math.floor(100000 + Math.random() * 900000);
  globalVerificationCode = verificationCode.toString();

  const emailResponse = await fetch("alugueres/email.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      id_aluguer: id_aluguer,
      id_funcionario: id_funcionario,
      verificationCode: globalVerificationCode,
    }),
  });

  if (!emailResponse.ok) {
    const emailData = await emailResponse.json();
    displayErrorMessage(emailData.message);
  } else {
    hideErrorMessage();
    // Exibe mensagem de sucesso ou fechar o modal
  }
}

function marcarRecolha(id_aluguer, id_funcionario) {
  // Envia o e-mail com o código de verificação
  sendEmail(id_aluguer, id_funcionario);
  // Abre o modal para inserir o código de verificação
  $("#verificationModal").modal("show");
}

// Eventos de mudança
document
  .getElementById("dateFilterPorRecolher")
  .addEventListener("change", function () {
    filterPorRecolher = this.value;
    $("#dataTablePorRecolher tbody").empty();
    fetchAlugueresPorRecolher(filterPorRecolher);
  });

document
  .getElementById("dateFilterRecolhidos")
  .addEventListener("change", function () {
    filterRecolhidos = this.value;
    $("#dataTableRecolhidos tbody").empty();
    fetchAlugueresRecolhidos(filterRecolhidos);
  });


function displaySuccessMessage(message) {
  var messageContainer = document.getElementById("messageContainer");
  var errorMessage = document.getElementById("errorMessage");
  errorMessage.textContent = message;
  errorMessage.style.color = "green";
  messageContainer.style.display = "block";
}

function displayErrorMessage(message) {
  var messageContainer = document.getElementById("messageContainer");
  var errorMessage = document.getElementById("errorMessage");
  errorMessage.textContent = message;
  errorMessage.style.color = "red";
  messageContainer.style.display = "block";
}


document.getElementById("markWithoutCodeButton").onclick = function () {
  $("#confirmationModal").modal("show");
};

document.getElementById("confirmWithoutCode").onclick = function () {
  recolherAluguer(id_aluguer, id_funcionario, "");
  $("#confirmationModal").modal("hide");
};

// Função para ocultar mensagens de erro
function hideErrorMessage() {
  var messageContainer = document.getElementById("messageContainer");
  messageContainer.style.display = "none";
}

// Adiciona um evento 'click' ao botão 'X' para fechar o modal
document.querySelector('#confirmationModal .close').onclick = function () {
  $('#confirmationModal').modal('hide');
};

// Adiciona um evento 'click' ao botão 'Cancelar' para fechar o modal
document.getElementById('confirmationModal').querySelector('.btn-secondary').onclick = function () {
  $('#confirmationModal').modal('hide');
};

document.querySelector('#verificationModal .close').onclick = function () {
  $('#verificationModal').modal('hide');
};