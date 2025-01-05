function fetchCategoriaCount() {
  fetch("categorias/totalCategorias.php")
    .then((response) => {
      if (!response.ok) {
        throw new Error("Erro na resposta do servidor");
      }
      return response.json();
    })
    .then((data) => {
      if (data.error) {
        document.getElementById("categoriaCount").textContent = data.error;
      } else {
        document.getElementById("categoriaCount").textContent = data.total;
      }
    })
    .catch((error) => {
      document.getElementById("categoriaCount").textContent =
        "Erro ao procurar dados.";
      console.error("Erro:", error);
    });
}

fetchCategoriaCount();

const btnAdicionar = document.getElementById("btnAdicionar");
const modalFormulario = new bootstrap.Modal(
  document.getElementById("modalFormulario")
);
const formAdicionarCategoria = document.getElementById("formCategoria");
const categoriaCount = document.getElementById("categoriaCount");

const modalFeedback = new bootstrap.Modal(
  document.getElementById("modalFeedback")
);
const modalFeedbackBody = document.getElementById("modalFeedbackBody");

btnAdicionar.addEventListener("click", function () {
  modalFormulario.show();
});

formAdicionarCategoria.addEventListener("submit", function (event) {
  event.preventDefault();

  const formData = new FormData(formAdicionarCategoria);
  fetch("./categorias/adicionarCategorias.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      modalFormulario.hide();
      if (data.success) {
        modalFeedbackBody.textContent = "Categoria adicionada com sucesso!";
        fetchCategoriaCount(); // Atualiza o número de categorias
        loadTable(); // Atualiza a tabela
      } else {
        modalFeedbackBody.textContent =
          "Erro ao adicionar categoria: " + data.message;
      }
      modalFeedback.show();
    })
    .catch((error) => {
      console.error("Erro:", error);
      modalFeedbackBody.textContent = "Erro ao adicionar categoria.";
      modalFormulario.hide();
      modalFeedback.show();
    });
});

document.addEventListener('DOMContentLoaded', function () {
  loadTable();
});

var currentPage = 1;
var itemsPerPage = 10;

function loadTable(page = 1) {
  currentPage = page;
  var xhr = new XMLHttpRequest();
  xhr.open('GET', `./categorias/categoriasScript.php?page=${page}&limit=${itemsPerPage}`, true);
  xhr.responseType = 'json';
  xhr.onload = function () {
    if (xhr.status === 200) {
      var response = xhr.response;
      if (response && response.data) {
        renderTable(response.data);
        renderPagination(response.total, response.page, response.limit);
      } else {
        console.error('Resposta do servidor vazia ou inválida.');
      }
    } else {
      console.error('Erro ao carregar dados da tabela.');
    }
  };
  xhr.send();
}

function renderTable(data) {
  var len = data.length;
  var tbody = document.querySelector('#dataTable tbody');
  tbody.innerHTML = ''; // Limpa o corpo da tabela

  for (var i = 0; i < len; i++) {
    var id = data[i].id_categoria;
    var nome = data[i].nome;
    var lojaOnline = data[i].loja_online;

    var tr = document.createElement('tr');

    var tdId = document.createElement('td');
    tdId.align = 'center';
    tdId.textContent = id;

    var tdNome = document.createElement('td');
    tdNome.align = 'center';
    tdNome.textContent = nome;

    var tdActions = document.createElement('td');
    tdActions.align = 'center';

    var tdLojaOnline = document.createElement('td');
    tdLojaOnline.align = 'center';

    var editButton = document.createElement('button');
    editButton.className = 'btn btn-info btn-sm';
    editButton.textContent = 'Editar';
    editButton.onclick = (function(id, nome) {
      return function() {
        editRecord(id, nome);
      };
    })(id, nome);

    var deleteButton = document.createElement('button');
    deleteButton.className = 'btn btn-danger btn-sm';
    deleteButton.textContent = 'Eliminar';
    deleteButton.onclick = (function(id) {
      return function() {
        deleteRecord(id);
      };
    })(id);

    var lojaOnlineButton = document.createElement('button');
    lojaOnlineButton.className = lojaOnline ? 'btn btn-warning btn-sm' : 'btn btn-success btn-sm';
    lojaOnlineButton.textContent = lojaOnline ? 'Remover da loja online' : 'Adicionar à loja online';
    lojaOnlineButton.onclick = (function(id, lojaOnline) {
      return function() {
        toggleLojaOnline(id, !lojaOnline);
      };
    })(id, lojaOnline);

    tdActions.appendChild(editButton);
    tdActions.appendChild(deleteButton);

    tdLojaOnline.appendChild(lojaOnlineButton);

    tr.appendChild(tdId);
    tr.appendChild(tdNome);
    tr.appendChild(tdActions);
    tr.appendChild(tdLojaOnline);

    tbody.appendChild(tr);
  }
}

// Função para renderizar a paginação
function renderPagination(totalItems, currentPage, itemsPerPage) {
  var totalPages = Math.ceil(totalItems / itemsPerPage);
  var pagination = document.getElementById('pagination');
  pagination.innerHTML = '';

  for (var i = 1; i <= totalPages; i++) {
    var pageButton = document.createElement('button');
    pageButton.className = 'btn btn-secondary btn-sm';
    pageButton.textContent = i;
    if (i === currentPage) {
      pageButton.classList.add('active');
    }
    pageButton.onclick = (function(page) {
      return function() {
        loadTable(page);
      };
    })(i);
    pagination.appendChild(pageButton);
  }
}

document.addEventListener('DOMContentLoaded', function () {
  loadTable(); // Carrega a tabela na página 1 ao carregar a página
});

// Função para alternar o status de loja_online
function toggleLojaOnline(id, status) {
  var xhr = new XMLHttpRequest();
  xhr.open('POST', './categorias/toggleLojaOnline.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function () {
    if (xhr.status === 200) {
      loadTable(currentPage); // Atualiza a tabela na página atual
    } else {
      console.error('Erro ao atualizar o status da loja online.');
    }
  };
  xhr.send('id=' + id + '&loja_online=' + status);
}

// Função para abrir o modal de edição e carregar os dados da categoria
function editRecord(id, nome) {
  const modalFormularioEdit = new bootstrap.Modal(
    document.getElementById("modalFormularioEditar")
  );
  // Preenche o formulário de edição com os dados da categoria
  document.getElementById('editCategoryId').value = id;
  document.getElementById('editCategoryName').value = nome;

  console.log(nome + ' ' + id)

  // Exibe o modal de edição
  
  modalFormularioEdit.show();


// Manipula o evento de submissão do formulário de edição
document.getElementById('formCategoriaEditar').addEventListener('submit', function (event) {
  event.preventDefault();

  const formData = new FormData(document.getElementById('formCategoriaEditar'));
  fetch('./categorias/editarCategorias.php', {
    method: 'POST',
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      modalFormulario.hide();
      if (data.success) {
        modalFormularioEdit.hide();
        modalFeedbackBody.textContent = 'Categoria editada com sucesso!';
        fetchCategoriaCount(); // Atualiza o número de categorias, se necessário
        loadTable(); // Atualiza a tabela
      } else {
        modalFeedbackBody.textContent = 'Erro ao editar categoria: ' + data.error;
      }
      modalFeedback.show();
    })
    .catch((error) => {
      console.error('Erro:', error);
      modalFeedbackBody.textContent = 'Erro ao editar categoria.';
      modalFormulario.hide();
      modalFeedback.show();
    });
});

}



function deleteRecord(id) {
  document.getElementById('modalFeedbackLabel').textContent = 'Confirmar exclusão';
  document.getElementById('modalFeedbackBody').innerHTML = 'Tem certeza de que deseja excluir esta categoria? <button class="btn btn-danger" onclick="confirmDelete(' + id + ')">Excluir</button>';
  $('#modalFeedback').modal('show');
}

function confirmDelete(id) {
  var xhr = new XMLHttpRequest();
  xhr.open('POST', './categorias/apagarCategorias.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function () {
      if (xhr.status === 200) {
          $('#modalFeedback').modal('hide');
          fetchCategoriaCount();
          loadTable();
      } else {
          console.error('Erro ao excluir categoria.');
      }
  };
  xhr.send('id=' + id);
}

$(document).ready(function() {
  $('#dataTable_Categorias input').on('input', function() {
      var searchText = $(this).val().toLowerCase();
      $('#dataTableCategorias tbody tr').filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(searchText) > -1);
      });
  });
});
