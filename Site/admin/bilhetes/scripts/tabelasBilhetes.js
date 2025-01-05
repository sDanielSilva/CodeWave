function fetchBilhetesValidar() {
    fetch("bilhetes/scripts/tabelaBilhetesValidar.php")
      .then((response) => response.json())
      .then((data) => {
        var tabela = document.getElementById("dataTableValidar").getElementsByTagName('tbody')[0];
        var bilhetes = Array.isArray(data) ? data : [data]; // Garante que os bilhetes é sempre um array
        bilhetes.forEach((bilhete) => {
          var row = tabela.insertRow();
          row.insertCell().innerText = bilhete.data_inicio;
          row.insertCell().innerText = bilhete.tipo;
          row.insertCell().innerText = bilhete.codigo;
          row.insertCell().innerText = parseFloat(bilhete.preco).toFixed(2) + "€";
        });
      })
      .catch((error) => console.error("Erro:", error));
  }
  
  fetchBilhetesValidar();


  function fetchBilhetesValidados() {
    fetch("bilhetes/scripts/tabelaBilhetesValidados.php")
      .then((response) => response.json())
      .then((data) => {
        var tabela = document.getElementById("dataTableValidados").getElementsByTagName('tbody')[0];
        var bilhetes = Array.isArray(data) ? data : [data]; // Garante que os bilhetes é sempre um array
        bilhetes.forEach((bilhete) => {
          var row = tabela.insertRow();
          row.insertCell().innerText = bilhete.data_fim;
          row.insertCell().innerText = bilhete.tipo;
          row.insertCell().innerText = bilhete.codigo;
          row.insertCell().innerText = parseFloat(bilhete.preco).toFixed(2) + "€";
          row.insertCell().innerText = bilhete.nome;
        });
      })
      .catch((error) => console.error("Erro:", error));
  }
  
  fetchBilhetesValidados();
  