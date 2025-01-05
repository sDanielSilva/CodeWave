window.onload = function () {
  var productsDiv = document.getElementById("products");
  var rentModal = document.getElementById("rentModal");
  var rentForm = document.getElementById("rentForm");
  var productNameInput = document.getElementById("productName");
  var productImage = document.getElementById("productImage");
  var startDateInput = document.getElementById("startDate");
  var endDateInput = document.getElementById("endDate");
  var quantityInput = document.getElementById("quantity");
  var totalPriceInput = document.getElementById("totalPrice");

  var selectedProduct = null;

  fetch("alojamentos/get_alojamentos.php")
    .then((response) => response.json())
    .then((data) => {
      data.forEach((product) => {
        console.log("ID do produto: " + product.id_produto);
        var productCard = document.createElement("div");
        productCard.className = "product-card";

        var productImageElement = document.createElement("img");
        productImageElement.src = product.imagem;
        productCard.appendChild(productImageElement);

        var productName = document.createElement("h3");
        productName.textContent = product.nome;
        productCard.appendChild(productName);

        var productPrice = document.createElement("p");
        productPrice.textContent = "Preço: " + product.preco + "€ /dia";
        productCard.appendChild(productPrice);

        var rentButton = document.createElement("button");
        rentButton.textContent = "Reservar";
        rentButton.currentProduct = product;

        rentButton.onclick = (function (currentProduct) {
          return function () {
            startDateInput.value = "";
            endDateInput.value = "";
            quantityInput.value = "";
            totalPriceInput.value = "";
            var message = document.getElementById("availabilityMessage");
            message.textContent = "";

            selectedProduct = currentProduct;
            console.log(selectedProduct);
            productNameInput.value = currentProduct.nome;
            productImage.src = currentProduct.imagem;

            var formData = new FormData();
            formData.append("id_produto", currentProduct.id_produto);

            fetch("alugueres/verificar_sessao.php")
              .then((response) => response.text())
              .then((data) => {
                if (data !== "logado") {
                  sessionStorage.setItem("redirectURL", "../alojamento.php");
                  window.location.href = "../Site/loja-online/login.html";
                } else {
                  rentModal.style.display = "block";
                  productNameInput.value = currentProduct.nome;
                  productImage.src = currentProduct.imagem;
                }
              });
            document.getElementById("isAlojamento").value = "true";
          };
        })(product);

        productCard.appendChild(rentButton);
        productsDiv.appendChild(productCard);

        startDateInput.oninput =
          quantityInput.oninput =
          endDateInput.oninput =
            function () {
              var errorMessageElement = document.getElementById("errorMessage");

              // Verificação: A data de entrada não pode ser anterior à data atual
              var today = new Date();
              today.setHours(0, 0, 0, 0);
              var startDate = new Date(startDateInput.value);
              if (startDate < today) {
                errorMessageElement.textContent =
                  "A data de entrada não pode ser anterior à data atual.";
                errorMessageElement.style.color = "red";
                return;
              }

              // Verificação: A data de fim não pode ser anterior à data de entrada
              var endDate = new Date(endDateInput.value);
              if (endDate < startDate) {
                errorMessageElement.textContent =
                  "A data de fim não pode ser anterior à data de entrada.";
                errorMessageElement.style.color = "red";
                return;
              }

              errorMessageElement.textContent = "";

              var xhr = new XMLHttpRequest();
              xhr.open("POST", "alojamentos/get_disponibilidade.php", true);
              xhr.setRequestHeader(
                "Content-Type",
                "application/x-www-form-urlencoded"
              );
              xhr.onreadystatechange = function () {
                if (
                  this.readyState === XMLHttpRequest.DONE &&
                  this.status === 200
                ) {
                  var disponibilidade = JSON.parse(
                    this.responseText
                  ).disponibilidade;
                  var message = document.getElementById("availabilityMessage");
                  if (disponibilidade >= quantityInput.value) {
                    // Há disponibilidade
                    message.textContent =
                      "Há " +
                      disponibilidade +
                      " vagas disponíveis para esta data.";
                    message.style.color = "green";
                  } else {
                    // Não há mais disponibilidade
                    message.textContent =
                      "Não há vagas suficientes disponíveis para esta data. Apenas " +
                      disponibilidade +
                      " vaga(s) disponível(is).";
                    message.style.color = "red";
                  }
                  // Desativa o botão de confirmação se a quantidade selecionada for maior do que a disponibilidade
                  var confirmButton = document.querySelector(
                    '#rentForm button[type="submit"]'
                  );
                  confirmButton.disabled =
                    quantityInput.value > disponibilidade;
                  confirmButton.style.backgroundColor = confirmButton.disabled
                    ? "gray"
                    : "";
                }
              };
              xhr.send(
                "id_produto=" +
                  encodeURIComponent(selectedProduct.id_produto) +
                  "&data_inicio=" +
                  encodeURIComponent(startDateInput.value) +
                  "&data_fim=" +
                  encodeURIComponent(endDateInput.value)
              );

              // Calcula o preço total
              if (
                startDateInput.value &&
                endDateInput.value &&
                quantityInput.value
              ) {
                var days =
                  (new Date(endDateInput.value) -
                    new Date(startDateInput.value)) /
                    (1000 * 60 * 60 * 24) +
                  1;
                var totalPrice =
                  selectedProduct.preco * quantityInput.value * days;
                console.log("totalPrice: " + totalPrice);
                totalPriceInput.value = totalPrice.toFixed(2) + "€";
                console.log("totalPriceInput.value: " + totalPriceInput.value);
              }
            };

        rentForm.onsubmit = function (event) {
          console.log(selectedProduct);

          event.preventDefault();

          if (selectedProduct === null) {
            alert(
              "Por favor, selecione um produto antes de submeter o formulário."
            );
            return;
          }

          var product = selectedProduct;

          document.getElementById("isAlojamento").value = "true";

          var data_inicio =
            document.getElementById("startDate").value + " 08:00";
          var data_fim = document.getElementById("endDate").value + " 22:00";

          var days =
            (new Date(endDateInput.value) - new Date(startDateInput.value)) /
            (1000 * 60 * 60 * 24);

          console.log("Quantidade:" + quantityInput.value);
          console.log("Preço:" + selectedProduct.preco);
          console.log("Dias:" + days);
          console.log("Preço total a enviar: " + totalPriceInput.value);

          var formData = new FormData();
          formData.append(
            "isAlojamento",
            document.getElementById("isAlojamento").value
          );
          formData.append("data_inicio", data_inicio);
          formData.append("data_fim", data_fim);
          formData.append("nome", product.nome);
          formData.append("preco", product.preco);
          formData.append("imagem", product.imagem);
          formData.append("quantidade", quantityInput.value);
          formData.append("dias", days);
          formData.append("id_produto", product.id_produto);
          formData.append("totalPrice", totalPriceInput.value);

          fetch("../Site/loja-online/adicionar_ao_carrinho.php", {
            method: "POST",
            body: formData,
          })
            .then((response) => response.text())
            .then((data) => {
              console.log(data);
              window.location.href = "../Site/loja-online/carrinho.php";
            })
            .catch((error) => console.error(error));
        };
      });
    });

  window.onclick = function (event) {
    if (event.target == rentModal) {
      rentModal.style.display = "none";
    }
  };
};
