var mainContent = document.getElementById("main-content");

function loadContent(section) {
  // Atualiza o conteúdo da página

  switch (section) {
    case "dados-pessoais":
      fetch("../loja-online/perfilPHP/dadospessoais.php")
        .then((response) => response.json())
        .then((data) => {
          mainContent.innerHTML = `
          <div class="container2">
          <!-- Conteúdo -->
          <div class="content" id="main-content">
              <h1>Dados Pessoais</h1>
              <form id="updateForm" class="needs-validation" novalidate>
                  <div class="mb-3">
                      <label for="nome" class="form-label">Nome:</label>
                      <input type="text" class="form-control" id="nome" name="nome" value="${data.nome}" required>
                  </div>
                  <div class="mb-3">
                      <label for="email" class="form-label">Email:</label>
                      <input type="email" class="form-control" id="email" name="email" value="${data.email}" required>
                      <div class="invalid-feedback">Por favor, insira um email válido.</div>
                  </div>
                  <div class="mb-3">
                      <label for="num_telemovel" class="form-label">Telefone:</label>
                      <input type="tel" class="form-control" id="num_telemovel" name="num_telemovel" value="${data.num_telemovel}" required>
                      <div class="invalid-feedback">Por favor, insira um número de telemóvel válido.</div>
                  </div>
                  <button type="submit" class="btn btn-primary">Guardar</button>
              </form>
              <br>
              <h1>Alterar Senha</h1>
              <form id="passwordForm" class="needs-validation" novalidate>
                  <div class="mb-3">
                      <label for="current_password" class="form-label">Senha atual:</label>
                      <input type="password" class="form-control" id="current_password" name="current_password" required>
                  </div>
                  <div class="mb-3">
                      <label for="new_password" class="form-label">Nova senha:</label>
                      <input type="password" class="form-control" id="new_password" name="new_password" required>
                  </div>
                  <div class="mb-3">
                      <label for="verify_password" class="form-label">Verificar senha:</label>
                      <input type="password" class="form-control" id="verify_password" name="verify_password" required>
                  </div>
                  <button type="submit" class="btn btn-primary">Guardar</button>
              </form>
          </div>
      </div>
            `;

          // Função para validar email
          function isValidEmail(email) {
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailPattern.test(email);
          }

          // Função para validar número de telemóvel português
          function isValidPortuguesePhoneNumber(phoneNumber) {
            const phonePattern = /^(9[1236]\d{7})$/;
            return phonePattern.test(phoneNumber);
          }

          function validateForm(event) {
            const emailInput = document.getElementById("email");
            const phoneInput = document.getElementById("num_telemovel");
            let isValid = true;

            // Valida email
            if (!isValidEmail(emailInput.value)) {
              emailInput.classList.add("is-invalid");
              isValid = false;
            } else {
              emailInput.classList.remove("is-invalid");
            }

            // Valida número de telemóvel
            if (!isValidPortuguesePhoneNumber(phoneInput.value)) {
              phoneInput.classList.add("is-invalid");
              isValid = false;
            } else {
              phoneInput.classList.remove("is-invalid");
            }

            if (!isValid) {
              event.preventDefault();
              event.stopPropagation();
            }
          }

          document
            .getElementById("updateForm")
            .addEventListener("submit", function (event) {
              validateForm(event);
              if (!event.defaultPrevented) {
                updateDadosPessoais(event);
              }
            });
          document
            .getElementById("passwordForm")
            .addEventListener("submit", updatePassword);
        })
        .catch((error) => console.error("Erro:", error));
      break;
    case "historico-compras":
      fetchHistoricoCompras();
      break;
    case "newsletter":
      fetch("../loja-online/perfilPHP/dadospessoais.php")
        .then((response) => response.json())
        .then((data) => {
          mainContent.innerHTML = `
            <h1>Newsletter</h1>
            <br>
            <form id="newsletterForm" class="needs-validation" novalidate>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="newsletter" name="newsletter" ${
                      data.newsletter ? "checked" : ""
                    }>
                    <label class="form-check-label" for="newsletter">Subscrição geral</label>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
          `;
          document
            .getElementById("newsletterForm")
            .addEventListener("submit", updateNewsletterSubscription);
        })
        .catch((error) => console.error("Erro:", error));
      break;
    case "bilhetes":
      fetchHistoricoBilhetes();
      break;
    default:
      mainContent.innerHTML =
        "<h1>Conteúdo Principal</h1><p>Esta é a seção principal da sua página.</p>";
      break;
  }

  // Ativa o botão clicado e desativa os outros
  var navContainer = document.querySelector(".nav-container2");
  var navLinks = navContainer.querySelectorAll("a");
  for (var i = 0; i < navLinks.length; i++) {
    if (navLinks[i].getAttribute("data-section") === section) {
      navLinks[i].classList.add("active");
    } else {
      navLinks[i].classList.remove("active");
    }
  }
}

function updateNewsletterSubscription(event) {
  event.preventDefault();

  // Obtem o estado atual do checkbox
  const isSubscribed = document.getElementById("newsletter").checked;

  // Envia uma requisição para atualizar a subscrição na base de dados
  fetch("../loja-online/perfilPHP/updateNewsletter.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ newsletter: isSubscribed }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        alert("Subscrição da newsletter atualizada com sucesso!");
      } else {
        alert("Houve um erro ao atualizar a subscrição da newsletter.");
      }
    })
    .catch((error) => console.error("Erro:", error));
}

function updateDadosPessoais(event) {
  event.preventDefault();
  var form = event.target;
  var data = {
    nome: form.nome.value,
    email: form.email.value,
    num_telemovel: form.num_telemovel.value,
  };
  fetch("../loja-online/perfilPHP/updateDadosPessoais.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(data),
  })
    .then((response) => response.json())
    .then((data) => {
      console.log("Sucesso:", data);
      // Exibe o modal com a mensagem de sucesso
      document.getElementById("myModalBody").innerText =
        "Dados pessoais atualizados com sucesso!";
      $("#myModal").modal("show");
    })
    .catch((error) => {
      console.error("Erro:", error);
      // Exibe o modal com a mensagem de erro
      document.getElementById("myModalBody").innerText =
        "Erro ao atualizar os dados pessoais.";
      $("#myModal").modal("show");
    });
}

function updatePassword(event) {
  event.preventDefault(); // Impede o comportamento padrão do formulário

  formPassword = event.target;

  var data = {
    currentPassword: formPassword.current_password.value,
    newPassword: formPassword.new_password.value,
    verifyPassword: formPassword.verify_password.value,
  };

  if (data.newPassword !== data.verifyPassword) {
    console.log(
      "As novas senhas não correspondem. Por favor, tente novamente."
    );
    document.getElementById("myModalBody").innerText =
      "As novas senhas não correspondem. Por favor, tente novamente.";
    $("#myModal").modal("show");
    return;
  }

  fetch("../loja-online/perfilPHP/updatePassword.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(data),
  })
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      console.log("Sucesso:", data);
      // Exibe o modal com a mensagem de sucesso
      document.getElementById("myModalBody").innerText =
        "Senha atualizada com sucesso!";
      $("#myModal").modal("show");
    })
    .catch((error) => {
      console.error("Erro:", error);
      // Exibe o modal com a mensagem de erro
      document.getElementById("myModalBody").innerText =
        "Erro ao atualizar a senha.";
      $("#myModal").modal("show");
    });
}

document.addEventListener("DOMContentLoaded", function () {
  loadContent("dados-pessoais");
});

var pagina = 1;
var itens_por_pagina = 3;

function fetchHistoricoCompras() {
  fetch(
    "../loja-online/perfilPHP/historicoCompras.php?pagina=" +
      pagina +
      "&itens_por_pagina=" +
      itens_por_pagina
  )
    .then((response) => response.text()) // get the response as text
    .then((text) => {
      try {
        return JSON.parse(text); // try to parse the text as JSON
      } catch (error) {
        console.error("Erro:", error);
        // if it fails, assume it's because there are no purchases
        return { compras: [] };
      }
    })
    .then((data) => {
      var html = "<h1>Histórico de Compras</h1>";
      html += "<hr/>";
      // Loop through the purchases to display larger IDs first
      const compras = Object.values(data.compras);
      compras.forEach((compra) => {
        let totalCompra = 0; // Variável para acompanhar o total da compra
        html += `
            <div class="compra-card">
              <div class="card-body">
                <h5 class="card-title">Compra #${compra.id_compra} em ${compra.data_hora}</h5>
                <p class="card-text">
                  <strong>Morada de Entrega:</strong> ${compra.morada_entrega}<br>
                  <strong>Produtos:</strong><br>
            `;
        compra.produtos.forEach((produto) => {
          totalCompra += parseFloat(produto.preco_total); // Adiciona o preço total do produto ao total da compra
          html += `
            <strong>Nome:</strong> ${produto.nome_produto}<br>
            <strong>Quantidade:</strong> ${produto.quantidade}<br>
            <strong>Subtotal:</strong> ${produto.preco_total} €<br>
            <hr>
          `;
        });
        html += `
                    <strong>Total da Compra:</strong> ${totalCompra.toFixed(
                      2
                    )} €<br> <!-- Mostra o total da compra com duas casas decimais -->
                  </p>
                </div>
              </div>
          `;
      });
      html += `
        <div class="pagination" style="display: flex; justify-content: space-between; align-items: center;">
          <button class="btn btn-primary" onclick="paginaAnterior()">Página Anterior</button>
          <span>Página ${pagina} de ${data.total_paginas}</span>
          <button class="btn btn-primary" onclick="proximaPagina()">Próxima Página</button>
        </div>
      `;
      mainContent.innerHTML = html;
    })
    .catch((error) => console.error("Erro:", error));
}

function fetchHistoricoBilhetes() {
  fetch(
    "../loja-online/perfilPHP/historicoBilhetes.php?pagina=" +
      pagina +
      "&itens_por_pagina=" +
      itens_por_pagina
  )
    .then((response) => response.json())
    .then((data) => {
      var html = "<h1>Histórico de Bilhetes</h1>";
      html += "<hr/>";
      data.bilhetes.forEach((bilhete) => {
        // Determina a classe CSS com base no status
        var statusClass = bilhete.status ? "invalido" : "valido";
        // Determina o estilo de texto com base no status
        var statusTextStyle = bilhete.status
          ? "color: red; font-weight: bold;"
          : "color: green; font-weight: bold;";
        html += `
                <div class="card mb-3 ${statusClass}">
                <div class="card-body">
                  <h5 class="card-title">${bilhete.tipo}</h5>
                  <p class="card-text">
                    <strong>Data Do Bilhete:</strong> ${bilhete.data_inicio}<br>
                    <strong>Código:</strong> ${bilhete.codigo}<br>
                    <strong>Status:</strong> <span style="${statusTextStyle}">${
          bilhete.status ? "Inválido" : "Válido"
        }</span><br>
                    <strong>Preço:</strong> ${bilhete.preco} €<br>
                    <strong>Data da Compra:</strong> ${bilhete.data_compra}
                  </p>
                </div>
              </div>
                                `;
      });
      html += `
      <div class="pagination" style="display: flex; justify-content: space-between; align-items: center;">
          <button class="btn btn-primary" onclick="paginaAnteriorBilhete()">Página Anterior</button>
          <span>Página ${pagina} de ${data.total_paginas}</span>
          <button class="btn btn-primary" onclick="proximaPaginaBilhete()">Próxima Página</button>
        </div>
      `;
      mainContent.innerHTML = html;
    })
    .catch((error) => console.error("Erro:", error));
}

function proximaPagina() {
  pagina++;
  fetchHistoricoCompras();
}

function paginaAnterior() {
  if (pagina > 1) {
    pagina--;
    fetchHistoricoCompras();
  }
}

function proximaPaginaBilhete() {
  pagina++;
  fetchHistoricoBilhetes();
}

function paginaAnteriorBilhete() {
  if (pagina > 1) {
    pagina--;
    fetchHistoricoBilhetes();
  }
}
