document.getElementById("btnAdicionar").addEventListener("click", function() {
    document.getElementById("modalFormulario").style.display = "block";
    document.getElementById("overlay").style.display = "block";
});

document.getElementById("btnFechar").addEventListener("click", function() {
    document.getElementById("modalFormulario").style.display = "none";
    document.getElementById("overlay").style.display = "none";
});

document.getElementById("btnFecharEditar").addEventListener("click", function() {
    document.getElementById("modalEditar").style.display = "none";
    document.getElementById("overlay").style.display = "none";
});




function editarCargo(idCargo, nomeCargo) {
    document.getElementById("modalEditar").style.display = "block";
    document.getElementById("overlay").style.display = "block";
    // Preencher o campo do formulário com o nome do cargo
    document.getElementById("edit_id_cargo").value = idCargo;
    document.getElementById("edit_nomeCargo").value = nomeCargo;
}


