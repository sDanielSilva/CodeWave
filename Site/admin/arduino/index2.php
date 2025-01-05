<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Mapa Interativo</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <style>
    #map {
      position: absolute;
      top: 0;
      bottom: 0;
      left: 0;
      right: 0;
      z-index: 0;
    }
  </style>
</head>
<body>
  <div id="map"></div>

  <script>
    var map = L.map("map").setView([0, 0], 2);

    L.imageOverlay("./mapa/s2.png", [
      [-90, -180],
      [90, 180],
    ]).addTo(map);


    var casamentoIcon = L.icon({
      iconUrl: 'casamento.svg',
      iconSize: [50, 50],
      iconAnchor: [25, 25],
    });

    var aniversarioIcon = L.icon({
      iconUrl: 'aniversario.svg',
      iconSize: [50, 50],
      iconAnchor: [25, 25],
    });

    var festaIcon = L.icon({
      iconUrl: 'festa.svg',
      iconSize: [50, 50],
      iconAnchor: [25, 25],
    });

    var initialMarker = L.marker([30, -95]);


    function updateMarker(event) {
  console.log("Evento recebido:", event); // Verifica se os dados do evento estão corretos

  const today = new Date();
  const formattedToday = today.toISOString().split('T')[0]; // Formata a data atual no formato "YYYY-MM-DD"

  console.log("Data atual:", formattedToday); // Verifica se a data atual está correta

  const eventDate = new Date(event.data_inicio);

  // Verifica se a data do evento é igual à data atual
  if (eventDate.toISOString().split('T')[0] === formattedToday) {
    let icon;
    if (event.tipo.toLowerCase() === 'casamento') {
      console.log("Tipo de evento: Casamento");
      icon = casamentoIcon;
    } else if (event.tipo.toLowerCase() === 'aniversario') {
      console.log("Tipo de evento: Aniversário");
      icon = aniversarioIcon;
    } else {
      console.log("Tipo de evento: Outro");
      icon = festaIcon;
    }
    console.log("Ícone definido:", icon); // Verifica se o icon está a ser atribuído corretamente
    // Atualiza a posição e o icon do marcador inicial
    initialMarker.setIcon(icon).addTo(map); // Adiciona o marcador ao mapa

    // Adiciona um popup ao marcador com as informações do evento
    initialMarker.bindPopup(`
      <h5>${event.tipo}</h5>
      <p>
        <strong>Descrição:</strong> ${event.descricao}<br>
        <strong>Número de convidados:</strong> ${event.num_convidados}<br>
        <strong>Organizador:</strong> ${event.nome_utilizador}<br>
        <strong>Local:</strong> ${event.nome_zona}
      </p>
    `);
  } else {
    console.log("Evento não é para hoje.");
    map.removeLayer(initialMarker); // Remove o marcador se o evento não for para hoje
  }
}
// Faz uma solicitação AJAX para obter o evento de hoje
fetch('script3.php')
  .then(response => response.json())
  .then(evento => {
    // Verifica se foi retornado um evento válido
    if (evento) {
      // Chama a função updateMarker com o evento retornado
      updateMarker(evento);
    } else {
      console.log("Nenhum evento encontrado para hoje.");
    }
  })
  .catch(error => console.error('Erro ao obter evento:', error));





    // Faz uma solicitação AJAX para obter o evento de hoje
    fetch('script2.php')
      .then(response => response.json())
      .then(evento => {
        // Verifica se foi retornado um evento válido
        if (evento) {
          // Chama a função updateMarker com o evento retornado
          updateMarker(evento);
        } else {
          console.log("Nenhum evento encontrado para hoje.");
        }
      })
      .catch(error => console.error('Erro ao obter evento:', error));

  </script>
</body>
</html>
