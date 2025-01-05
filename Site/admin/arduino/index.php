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
    .navbar {
      z-index: 2;
    }
    
    
/*     button {
      position: absolute;
      top: 70px;
      left: 20px;
      z-index: 2;
    } */
  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Dashboard Mapa</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav mr-auto"> 
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Luzes
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" id="ledDropdown">
              <!-- LED controls will be inserted here -->
            </ul>
          </li>
        </ul>
        <div class="d-flex">
          <!-- <button type="button" class="btn btn-info me-2" onclick="updateLeds()">Update LEDs</button> -->
          <button type="button" class="btn btn-primary me-2" onclick="toggleAllLeds()">Ligar/Desligar Todos</button>
          <button type="button" class="btn btn-success" onclick="toggleEventLed()">Ligar/Desligar Evento</button>
        </div>
      </div>
    </div>
</nav>


  <div id="map"></div>

  <script>
// Defenir o intervalo de tempo em milissegundos
const intervaloAtualizacao = 5000; // 5 segundos

// Definir a função para atualizar os LEDs automaticamente
function atualizarAutomaticamente() {
  // Chama a função updateLeds() a cada intervalo de tempo definido
  setInterval(updateLeds, intervaloAtualizacao);
}

// Chama a função para começar a atualização automática dos LEDs
atualizarAutomaticamente();






var map = L.map('map', {
    zoomControl: false
}).setView([0, 0], 2);


    L.imageOverlay("./mapa/s2.png", [
      [-90, -180],
      [90, 180],
    ]).addTo(map);

    var ledIconOff = L.icon({
      iconUrl: 'off2.svg',
      iconSize: [50, 50],
      iconAnchor: [25, 25],
    });

    var ledIconOn = L.icon({
      iconUrl: 'on2.svg',
      iconSize: [50, 50],
      iconAnchor: [25, 25],
    });

    var leds = [
      L.marker([-32, 75], { icon: ledIconOff }).addTo(map),
      L.marker([38, 80], { icon: ledIconOff }).addTo(map),
      L.marker([62, 16], { icon: ledIconOff }).addTo(map),
      L.marker([75, -45], { icon: ledIconOff }).addTo(map),
      L.marker([15, -50], { icon: ledIconOff }).addTo(map),
      L.marker([-72, -135], { icon: ledIconOff }).addTo(map),
      L.marker([-57, -110], { icon: ledIconOff }).addTo(map),
      L.marker([-76, -65], { icon: ledIconOff }).addTo(map),
      L.marker([-68, -60], { icon: ledIconOff }).addTo(map),
      L.marker([-68, 5], { icon: ledIconOff }).addTo(map),
      L.marker([-66, 98], { icon: ledIconOff }).addTo(map),
      L.marker([-60, 45], { icon: ledIconOff }).addTo(map),
    ];

    var eventos = [
      L.marker([30, -110], { icon: ledIconOff }).addTo(map),
    ];
    function toggleEventLed() {
    // Verifica o estado atual do LED de eventos
    let eventLedState = eventos[0].options.icon.options.iconUrl === ledIconOn.options.iconUrl;
    // Altera o estado do LED de eventos para o oposto
    let newEventLedState = !eventLedState;
    let newIcon = newEventLedState ? ledIconOn : ledIconOff;
    eventos[0].setIcon(newIcon);
    // Atualiza o estado do LED de eventos no servidor
    updateLedState(13, newEventLedState);
  }


  function updateLeds() {
  fetch('script.php')
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok ' + response.statusText);
      }
      return response.json();
    })
    .then(data => {
      if (data.error) {
        console.error('Erro ao obter dados dos LEDs:', data.error);
      } else {
        data.forEach(led => {
          if (led.id_luz - 1 < leds.length) {
            leds[led.id_luz - 1].setIcon(led.status ? ledIconOn : ledIconOff);
          }
        });

        // Atualiza o estado do LED de eventos
        if (data.find(led => led.id_luz === 13)) {
          let eventLedState = data.find(led => led.id_luz === 13).status;
          let eventLedIcon = eventLedState ? ledIconOn : ledIconOff;
          eventos[0].setIcon(eventLedIcon);
        }
      }
    })
    .catch(error => console.error('Erro ao obter dados dos LEDs:', error));
}


    function toggleLed(ledId, checked) {
  let newIcon = checked ? ledIconOn : ledIconOff;
  leds[ledId - 1].setIcon(newIcon);
  
  // Atualiza o estado do LED no servidor
  updateLedState(ledId, checked);
}
document.addEventListener("DOMContentLoaded", function() {
  let ledDropdown = document.getElementById("ledDropdown");
  leds.forEach((led, index) => {
    let ledId = index + 1;
    let dropdownItem = document.createElement("li");
    dropdownItem.classList.add("dropdown-item");
    dropdownItem.innerHTML = `
      <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="ledSwitch${ledId}" onchange="toggleLed(${ledId}, this.checked)">
        <label class="form-check-label" for="ledSwitch${ledId}">LED ${ledId}</label>
      </div>
    `;
    ledDropdown.appendChild(dropdownItem);
  });
});

function toggleAllLeds() {
  // Verifica o estado atual do primeiro LED
  let currentState = leds[0].options.icon.options.iconUrl === ledIconOn.options.iconUrl;

  // Altera todos os LEDs para o estado oposto
  leds.forEach((led, index) => {
    let newIcon = currentState ? ledIconOff : ledIconOn;
    led.setIcon(newIcon);
    // Atualiza o estado do LED no servidor para manter a consistência
    updateLedState(index + 1, !currentState);
  });
}


function updateLedState(ledId, newState) {
  // Faz uma requisição para o servidor PHP para atualizar o estado do LED
  fetch('updateled.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({ ledId: ledId, newState: newState })
  })
  .then(response => {
    if (!response.ok) {
      throw new Error('Network response was not ok ' + response.statusText);
    }
    return response.json();
  })
  .then(data => {
    if (data.error) {
      console.error('Erro ao atualizar estado do LED no servidor:', data.error);
    } else {
      console.log('Estado do LED atualizado no servidor com sucesso.');
    }
  })
  .catch(error => console.error('Erro ao atualizar estado do LED no servidor:', error));
}

    // Atualiza os LEDs automaticamente ao carregar a página
    updateLeds();

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
