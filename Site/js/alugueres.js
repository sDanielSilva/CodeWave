window.onload = function () {
  var productsDiv = document.getElementById("products");
  var rentModal = document.getElementById("rentModal");
  var rentForm = document.getElementById("rentForm");
  var productNameInput = document.getElementById("productName");
  var productImage = document.getElementById("productImage");
  var startTimeInput = document.getElementById("startTime");
  var endTimeInput = document.getElementById("endTime");
  var quantityInput = document.getElementById("quantity");
  var totalPriceInput = document.getElementById("totalPrice");

  var selectedProduct = null;

  fetch("alugueres/get_produtos.php")
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
        productPrice.textContent = "Preço: " + product.preco + "€ /hora";
        productCard.appendChild(productPrice);

        var rentButton = document.createElement("button");
        rentButton.textContent = "Alugar";
        rentButton.currentProduct = product;

        rentButton.onclick = (function (currentProduct) {
          return function () {
            alert(JSON.stringify(currentProduct));

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
                  sessionStorage.setItem("redirectURL", "../alugueres.php");
                  window.location.href = "../Site/loja-online/login.html";
                } else {
                  rentModal.style.display = "block";
                
                  productNameInput.value = currentProduct.nome;
                  productImage.src = currentProduct.imagem;
                }
              });
            document.getElementById("isRental").value = "true";
          };
        })(product);

        productCard.appendChild(rentButton);
        productsDiv.appendChild(productCard);

        startTime.oninput =
          endTime.oninput =
          quantityInput.oninput =
            function calculateTotalPrice() {
              if (startTime.value && endTime.value && quantityInput.value) {
                var hours =
                  (endTime.valueAsNumber - startTime.valueAsNumber) / 3600000;
                var totalPrice =
                  selectedProduct.preco * quantityInput.value * hours;
                totalPriceInput.value = totalPrice.toFixed(2) + "€";
              }
            };

        rentForm.onsubmit = function (event) {
          console.log(selectedProduct); 

          event.preventDefault();

          // Verifica se um produto foi selecionado
          if (selectedProduct === null) {
            alert(
              "Por favor, selecione um produto antes de submeter o formulário."
            );
            return;
          }

          
          var product = selectedProduct;

          
          document.getElementById("isRental").value = "true";

          var hora_inicio =
            document.getElementById("startDate").value +
            " " +
            document.getElementById("startTime").value;
          var hora_fim =
            document.getElementById("endDate").value +
            " " +
            document.getElementById("endTime").value;

          var hours =
            (endTimeInput.valueAsNumber - startTimeInput.valueAsNumber) /
            3600000;
          var totalPrice = product.preco * quantityInput.value * hours;
          totalPriceInput.value = totalPrice.toFixed(2) + "€";

          console.log("Preço a ser enviado: " + product.preco);
          console.log(
            "isRental a ser enviado: " +
              document.getElementById("isRental").value
          );

          
          var formData = new FormData();
          formData.append(
            "isRental",
            document.getElementById("isRental").value
          );
          formData.append("hora_inicio", hora_inicio);
          formData.append("hora_fim", hora_fim);
          formData.append("nome", product.nome);
          formData.append("preco", product.preco);
          formData.append("imagem", product.imagem);
          formData.append("quantidade", quantityInput.value);
          formData.append("horas", hours);
          // Adiciona o id_produto aos dados do formulário
          formData.append("id_produto", product.id_produto);

          alert(JSON.stringify(product));

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

  startDate.onchange = function () {
    endDate.value = this.value;
  };

  endDate.onchange = function () {
    startDate.value = this.value;
  };
};
