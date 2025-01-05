function validate() {
  var codigo = document.getElementById("codigo").value;

  console.log("Código inserido: " + codigo);

  var validationModal = bootstrap.Modal.getInstance(
    document.getElementById("validationModal")
  );
  var alertModal = new bootstrap.Modal(document.getElementById("alertModal"));

  if (!codigo || codigo.trim() === "") {
    document.getElementById("alertMessage").textContent =
      "O código não pode estar vazio!";
    alertModal.show();
    return;
  }

  if (!Number.isInteger(Number(codigo))) {
    document.getElementById("alertMessage").textContent =
      "O código deve ser um número inteiro!";
    alertModal.show();
    return;
  }

  // Envia uma solicitação AJAX para o servidor para validar o código
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "./bilhetes/scripts/validate.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {

      // Fecha a modal de validação e abre a modal de alerta
      validationModal.hide();

      // A solicitação foi concluída com sucesso, exibir o resultado
      document.getElementById("alertMessage").textContent = this.responseText;
      alertModal.show();

      setTimeout(function() {
        location.reload();
      }, 2000);
    }
  };
  xhr.send("codigo=" + encodeURIComponent(codigo));
}

function fetchLotacao() {
  fetch("./bilhetes/scripts/lotacao.php")
    .then((response) => response.json())
    .then((data) => {
      // Atualiza a lotação na página HTML
      document.getElementById("nBilhetes").textContent = data.num_bilhetes;
      document.getElementById("textoLotacao").textContent =
        data.lotacao.toFixed(2) + "%";
      document.querySelector(".progress-bar").style.width = data.lotacao + "%";
      document
        .querySelector(".progress-bar")
        .setAttribute("aria-valuenow", data.lotacao);
      document.querySelector(".visually-hidden").textContent =
        data.lotacao + "%";
    })
    .catch((error) => console.error("Error:", error));
}

window.onload = fetchLotacao;
