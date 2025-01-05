document
  .getElementById("formAdicionarNoticia")
  .addEventListener("submit", async function (event) {
    var imagemInput = document.getElementById("imagem");
    if (imagemInput.files.length > 0) {
      event.preventDefault();
      var imagemFile = imagemInput.files[0];
      var formData = new FormData();
      formData.append("image", imagemFile);
      try {
        var response = await fetch(
          "https://api.imgbb.com/1/upload?key=75d5fe304154f554910b517c87d3c33f",
          {
            method: "POST",
            body: formData,
          }
        );
        var result = await response.json();
        if (response.ok && result.data && result.data.url) {
          var imageUrl = result.data.url;
          document.getElementById("imagemUrl").value = imageUrl;
          this.submit();
        } else {
          console.error("Erro ao enviar a imagem:", result);
        }
      } catch (error) {
        console.error("Erro ao enviar a imagem:", error);
      }
    } else {
      this.submit();
    }
  });

document
  .getElementById("formEditarNoticia")
  .addEventListener("submit", async function (event) {
    event.preventDefault(); // Impede o envio padrão do formulário

    var imagemInput = document.getElementById("edit_imagem");
    var formData = new FormData(this);

    if (imagemInput.files.length > 0) {
      var imagemFile = imagemInput.files[0];
      formData.append("image", imagemFile);

      try {
        var response = await fetch(
          "https://api.imgbb.com/1/upload?key=75d5fe304154f554910b517c87d3c33f",
          {
            method: "POST",
            body: formData,
          }
        );
        var result = await response.json();
        if (response.ok && result.data && result.data.url) {
          var imageUrl = result.data.url;
          formData.set("edit_imagemUrl", imageUrl);
        } else {
          console.error("Erro ao enviar a imagem:", result);
          return; // Sai da função se houver erro ao enviar a imagem
        }
      } catch (error) {
        console.error("Erro ao enviar a imagem:", error);
        return; // Sai da função se houver erro ao enviar a imagem
      }
    }

    // Envia o formulário via AJAX
    try {
      var response = await fetch("./noticias/editarNoticia.php", {
        method: "POST",
        body: formData,
      });
      var result = await response.text();
      if (response.ok) {
        document.getElementById("modalEditar").style.display = "none";
        document.getElementById("overlay").style.display = "none";
        carregarNoticias(pagina_atual); // Atualiza a tabela
      } else {
        console.error("Erro ao atualizar a notícia:", result);
      }
    } catch (error) {
      console.error("Erro ao atualizar a notícia:", error);
    }
  });

document.getElementById("btnAdicionar").addEventListener("click", function () {
  document.getElementById("modalFormulario").style.display = "block";
  document.getElementById("overlay").style.display = "block";
});

document.getElementById("btnFechar").addEventListener("click", function () {
  document.getElementById("modalFormulario").style.display = "none";
  document.getElementById("overlay").style.display = "none";
});

document
  .getElementById("btnFecharEditar")
  .addEventListener("click", function () {
    document.getElementById("modalEditar").style.display = "none";
    document.getElementById("overlay").style.display = "none";
  });

function editarNoticia(idNoticia, tituloNoticia, descricaoNoticia, imagemUrl) {
  document.getElementById("modalEditar").style.display = "block";
  document.getElementById("overlay").style.display = "block";
  // Preenche os campos do formulário com os dados da notícia
  document.getElementById("edit_id_noticia").value = idNoticia;
  document.getElementById("edit_tituloNoticia").value = tituloNoticia;
  document.getElementById("edit_descricaoNoticia").value = descricaoNoticia;
  document.getElementById("edit_imagemUrl").value = imagemUrl;
}
