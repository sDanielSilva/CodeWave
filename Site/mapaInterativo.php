<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mapa Interativo</title>
 
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.pannellum.org/2.5/pannellum.css">
<script src="https://cdn.pannellum.org/2.5/pannellum.js"></script>
    <style>
      #map {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: 0;
      }
      #sidebar {
        position: absolute;
        top: 0;
        left: 0;
        width: 400px;
        height: 100vh;
        background-color: #f8f9fa;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        z-index: 1;
        overflow-y: auto;
        display: none;
      }
      #toggleButton {
        position: absolute;
        top: 20px;
        left: 20px;
        z-index: 2;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <button hidden id="toggleButton1" onclick="toggleDiversoes()"></button>
    <button hidden id="toggleButton2" onclick="toggleRestaurantes()"></button>
    <button hidden id="toggleButton3" onclick="toggleLojas()"></button>
    <button hidden id="toggleButton4" onclick="toggleServico()"></button>
    <button hidden id="toggleButton5" onclick="toggleWc()"></button>
    <button hidden id="toggleButton6" onclick="toggle360()"></button>

    <div id="sidebar" class="p-4">
      <button class="btn-close position-absolute top-0 end-0 mt-2 me-2" onclick="closeSidebar()" aria-label="Close"></button>
      <br>
      <img src="#" id="sidebar-image" class="img-fluid mb-3" alt="Imagem"/>
      <h2 id="sidebar-title" class="text-center mb-3">Título</h2>
      <p id="sidebar-description" class="mb-0">Descrição</p>
      <div id="panorama" style="width: 100%; height: 300px;"></div>
  </div>

    <script>
      var map = L.map("map").setView([0, 0], 2);

      L.imageOverlay("./mapa/s2.png", [
        [-90, -180],
        [90, 180],
      ]).addTo(map);

      var panoramaIcon = L.icon({
        iconUrl: './mapa/icons8-camera.svg',
        iconSize: [32, 32],
        iconAnchor: [16, 32],
        popupAnchor: [0, -32]
    });

    var popup;

    var panoramaMarker = L.marker([-75, 0], {icon: panoramaIcon}).addTo(map).on('click', function () {
        if (!popup || !popup.isOpen()) {
            document.getElementById("sidebar").style.display = "block";
            document.getElementById("sidebar-title").innerText = "Panorama";
            document.getElementById("panorama").innerHTML = "";
            pannellum.viewer('panorama', {
                "type": "equirectangular",
                "panorama": "./mapa/3.jpg"
            });
            document.getElementById("sidebar-description").innerText = "Experimenta a nossa visita virtual 360º, onde pode explorar o parque aquático de uma forma única e interativa.";
        }
    });

    var panoramaMarker2 = L.marker([45, 120], {icon: panoramaIcon}).addTo(map).on('click', function () {
        if (!popup || !popup.isOpen()) {
            document.getElementById("sidebar").style.display = "block";
            document.getElementById("sidebar-title").innerText = "Panorama 2";
            document.getElementById("panorama").innerHTML = "";
            pannellum.viewer('panorama', {
                "type": "equirectangular",
                "panorama": "./mapa/1.jpg"
            });
            document.getElementById("sidebar-description").innerText = "Experimenta a nossa visita virtual 360º, onde pode explorar o parque aquático de uma forma única e interativa.";
        }
    });

    var panoramaMarker3 = L.marker([-3, 110], {icon: panoramaIcon}).addTo(map).on('click', function () {
        if (!popup || !popup.isOpen()) {
            document.getElementById("sidebar").style.display = "block";
            document.getElementById("sidebar-title").innerText = "Panorama 2";
            document.getElementById("panorama").innerHTML = "";
            pannellum.viewer('panorama', {
                "type": "equirectangular",
                "panorama": "./mapa/2.jpg"
            });
            document.getElementById("sidebar-description").innerText = "Experimenta a nossa visita virtual 360º, onde pode explorar o parque aquático de uma forma única e interativa.";
        }
    });

      var wcIcon = L.icon({
        iconUrl: "./mapa/icons8-wc.svg",
        iconSize: [32, 32],
        iconAnchor: [16, 32],
        popupAnchor: [0, -32],
      });

      var wc = [
        L.marker([-63, 125], { icon: wcIcon })
          .addTo(map)
          .on("click", function () {
            openSidebar(
              "wc",
              "./mapa/23.jpg",
              "Descrição do wc."
            );
          }),

          L.marker([-15, -85], { icon: wcIcon })
          .addTo(map)
          .on("click", function () {
            openSidebar(
              "wc",
              "./mapa/23.jpg",
              "Descrição do wc."
            );
          }),
          L.marker([-81, -35], { icon: wcIcon })
          .addTo(map)
          .on("click", function () {
            openSidebar(
              "wc",
              "./mapa/23.jpg",
              "Descrição do wc."
            );
          }),
      ];

      var informacaoIcon = L.icon({
        iconUrl: "./mapa/icons8-information.svg",
        iconSize: [32, 32],
        iconAnchor: [16, 32],
        popupAnchor: [0, -32],
      });

      var informacao = [
        L.marker([-81, -25], { icon: informacaoIcon })
          .addTo(map)
          .on("click", function () {
            openSidebar(
              "Nome do Lojas",
              "./mapa/22.jpg",
              "Descrição do lojas."
            );
          }),
      ];

      var lojasIcon = L.icon({
        iconUrl: "./mapa/icons8-store.svg",
        iconSize: [32, 32],
        iconAnchor: [16, 32],
        popupAnchor: [0, -32],
      });

      var lojas = [
        L.marker([-81, -50], { icon: lojasIcon })
          .addTo(map)
          .on("click", function () {
            openSidebar(
              "Nome do Lojas",
              "./mapa/6.jpg",
              "Descrição do lojas."
            );
          }),
      ];

      var restauranteIcon = L.icon({
        iconUrl: "./mapa/icons8-fork.svg",
        iconSize: [32, 32],
        iconAnchor: [16, 32],
        popupAnchor: [0, -32],
      });

      var restaurantes = [
        L.marker([-81, 10], { icon: restauranteIcon })
          .addTo(map)
          .on("click", function () {
            openSidebar(
              "Nome do Restaurante",
              "./mapa/5.jpg",
              "Descrição do restaurante."
            );
          }),

          L.marker([-81, -10], { icon: restauranteIcon })
          .addTo(map)
          .on("click", function () {
            openSidebar(
              "Nome do Restaurante 2",
              "./mapa/4.jpg",
              "Descrição do restaurante. 2"
            );
          }),

          L.marker([-63, 115], { icon: restauranteIcon })
          .addTo(map)
          .on("click", function () {
            openSidebar(
              "Nome do Restaurante 2",
              "./mapa/21.jpg",
              "Descrição do restaurante. 2"
            );
          }),
      ];

      var diversaoIcon = L.icon({
        iconUrl: "./mapa/icons8-water-park.svg",
        iconSize: [32, 32],
        iconAnchor: [16, 32],
        popupAnchor: [0, -32],
      });

      var diversoes = [
        L.marker([32, 80], { icon: diversaoIcon })
          .addTo(map)
          .on("click", function () {
            openSidebar("Laguna", "./mapa/15.jpg", "Piscina gigante com dimensões olímpicas, o lugar perfeito para se divertir com toda a família! Não é permitido mergulhar.");
          }),
        L.marker([38, 135], { icon: diversaoIcon })
          .addTo(map)
          .on("click", function () {
            openSidebar("The Big Wave", "./mapa/7.jpg", "Escorrega de alta velocidade e adrenalina! Deslize através das suas curvas e surpreendentemente suba a onda com uma sensação de gravidade zero! Adrenalina Total! REGRAS: Altura mínima de 1,20m.");
          }),

        L.marker([-40, 75], { icon: diversaoIcon })
          .addTo(map)
          .on("click", function () {
            openSidebar("Tropical Paradise", "./mapa/11.jpg", "Um mundo fascinante de água e fantasia para crianças. Área com 1400m² com profundidade de 0,20m. Equipado com jogos interativos, escorregas e baby-escorregas em forma de animais. Regras: até os 12 anos de idade, mas alguns escorregas as crianças pequenas podem ir com um adulto.");
          }),

        L.marker([-7, 50], { icon: diversaoIcon })
          .addTo(map)
          .on("click", function () {
            openSidebar("Disco River", "./mapa/13.jpg", "Único em Portugal com uma nova dimensão, a Música! Uma verdadeira discoteca com luzes. REGRAS: 1.20m de altura mínima. Entre 0.90m e 1.20m acompanhado por um adulto. Não aconselhável para cardíacos, claustrofóbicos e grávidas. Peso máximo permitido: 200kg na boia dupla e 100kg na boia individual.");
          }),

        L.marker([34, 23], { icon: diversaoIcon })
          .addTo(map)
          .on("click", function () {
            openSidebar("Tornado", "./mapa/17.jpg", "Para andar com a cabeça à volta. REGRAS: Não aconselhável para cardíaco. Restrições: Entre 1,20m e 1,40m de altura acompanhados por um adulto. Altura mínima de 1,40m para boia individual. Peso máximo: 200kg na boia dupla e 100kg na boia individual.");
          }),

        L.marker([70, -110], { icon: diversaoIcon })
          .addTo(map)
          .on("click", function () {
            openSidebar("Boomerang", "./mapa/18.jpg", "Um túnel colorido e um divertido vaivém, a combinação perfeita!");
          }),

        L.marker([75, -110], { icon: diversaoIcon })
          .addTo(map)
          .on("click", function () {
            openSidebar("Race", "./mapa/19.jpg", "Uma verdadeira corrida, cronometrada ao centésimo de segundo!");
          }),

        L.marker([75, -90], { icon: diversaoIcon })
          .addTo(map)
          .on("click", function () {
            openSidebar("Big Fall", "./mapa/20.jpg", "A nova viagem “cápsula”, para além da adrenalina.");
          }),

        L.marker([24, -30], { icon: diversaoIcon })
          .addTo(map)
          .on("click", function () {
            openSidebar("Kamikaze", "./mapa/16.jpg", "Duas pistas paralelas com 18 m de altura, prontas para oferecer uma dose dupla de emoção. O seu nome diz tudo! Não é aconselhável para cardíacos. Altura mínima: 1 metro");
          }),

        L.marker([10, -50], { icon: diversaoIcon })
          .addTo(map)
          .on("click", function () {
            openSidebar("Black Hole", "./mapa/8.jpg", "Para os amantes da aventura, escorregue numa boia dupla e enfrente a escuridão. REGRAS: Não recomendado para cardíacos, claustrofóbicos e grávidas. Restrições: Não é permitido abaixo da altura de 0,90m. De 0,90m a 1,20m acompanhados por um adulto. Peso máximo por boia dupla: 200Kg");
          }),

        L.marker([-18, -20], { icon: diversaoIcon })
          .addTo(map)
          .on("click", function () {
            openSidebar("Big Slides Tower", "./mapa/12.jpg", "TOTALMENTE RENOVADO EM 2019, OS SETE ESCORREGAS, CADA UM COM UMA COR - Sete aventuras que terminam em SPLASH! Não aconselhável para cardíacos. Altura mínima: 1 metro.");
          }),

        L.marker([-45, -110], { icon: diversaoIcon })
          .addTo(map)
          .on("click", function () {
            openSidebar(
              "Children Foam Slides",
              "./mapa/14.jpg",
              "É permitido apenas até 1,20m de altura. É impossível escorregar só uma vez…"
            );
          }),

        L.marker([-45, -80], { icon: diversaoIcon })
          .addTo(map)
          .on("click", function () {
            openSidebar("Foam Slides", "./mapa/14.jpg", "Cinco pistas fantásticas, divertidas e fofas, deslizando por águas cristalinas. Splash e prevalece a emoção! Não aconselhável para pessoas com doença cardíaca ou doença de ossos. Altura mínima: 1 metro.");
          }),

        L.marker([-65, 45], { icon: diversaoIcon })
          .addTo(map)
          .on("click", function () {
            openSidebar("Banzai", "./mapa/9.jpg", "Dois excelentes escorregas, ideais para uma verdadeira corrida! Deslize sobre um tapete e divirta-se com seus amigos em corridas loucas de verão! Não aconselhável para pacientes com doença cardíaca. Altura mínima: 1 metro");
          }),

        L.marker([-73, 30], { icon: diversaoIcon })
          .addTo(map)
          .on("click", function () {
            openSidebar("Jacuzzi", "./mapa/10.jpg", "Piscina Oval com jatos de hidromassagem relaxante, para relaxar! Só é permitido altura máxima de 1,4 m, duração máxima de 7 minutos.");
          }),
      ];

      function toggleDiversoes() {
        diversoes.forEach(function (marker) {
          if (marker._map) {
            map.removeLayer(marker);
          } else {
            marker.addTo(map);
          }
        });
      }
      function toggleRestaurantes() {
        restaurantes.forEach(function (marker) {
          if (marker._map) {
            map.removeLayer(marker);
          } else {
            marker.addTo(map);
          }
        });
      }
      function toggleLojas() {
        lojas.forEach(function (marker) {
          if (marker._map) {
            map.removeLayer(marker);
          } else {
            marker.addTo(map);
          }
        });
      }
      function toggleServico() {
        informacao.forEach(function (marker) {
          if (marker._map) {
            map.removeLayer(marker);
          } else {
            marker.addTo(map);
          }
        });
      }
      function toggleWc() {
        wc.forEach(function (marker) {
          if (marker._map) {
            map.removeLayer(marker);
          } else {
            marker.addTo(map);
          }
        });
      }
      var panoramaMarkers = [panoramaMarker, panoramaMarker2, panoramaMarker3];

function toggle360() {
    panoramaMarkers.forEach(function (marker) {
        if (marker._map) {
            map.removeLayer(marker);
        } else {
            marker.addTo(map);
        }
    });
}

      


      function openSidebar(title, imageSrc, description) {
        document.getElementById("sidebar-title").innerText = title;
        document.getElementById("sidebar-image").src = imageSrc;
        document.getElementById("sidebar-description").innerText = description;
        document.getElementById("sidebar").style.display = "block";
      }

      function closeSidebar() {
        document.getElementById("sidebar").style.display = "none";
      }
    </script>
  </body>
</html>
