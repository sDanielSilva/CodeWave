// Mostra o formulário de adição
document.getElementById("btnAdicionar").addEventListener("click", function() {
    document.getElementById("modalFormulario").style.display = "block";
    document.getElementById("overlay").style.display = "block";
});

// Fecha o formulário de adição
document.getElementById("btnFechar").addEventListener("click", function() {
    document.getElementById("modalFormulario").style.display = "none";
    document.getElementById("overlay").style.display = "none";
});

// Fecha o formulário de edição
document.getElementById("btnFecharEditar").addEventListener("click", function() {
    document.getElementById("modalEditar").style.display = "none";
    document.getElementById("overlay").style.display = "none";
});

