<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Mapa Interativo</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
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
  <!-- Modal do Bootstrap -->
  <div class="modal fade" id="zonaModal" tabindex="-1" aria-labelledby="zonaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="zonaModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

  <script>
    var map = L.map("map").setView([0, 0], 2);

    L.imageOverlay("./mapa/s2.png", [
      [-90, -180],
      [90, 180],
    ]).addTo(map);

    // Definir a zona como um array de coordenadas
    var zona = [
      [74.847801, -17.753906],
      [50.151989, -37.856236],
      [46.471618, -37.197056],
      [39.605688, -11.162109],
      [40.5472, -2.548828],
      [44.902578, 2.834473],
      [46.012224, 3.504639],
      [43.192232, 39.631745],
      [47.558256, 38.204716],
      [53.836552, 40.094365],
      [54.658171, 48.57581],
      [51.351201, 67.093506],
      [66.548263, 71.202393],
      [71.081182, 60.545654]
    ];

    var zona2 = [
      [78.627839, -51.767578],
      [73.858452, -69.807129],
      [64.53191, -37.089844],
      [75.594507, -24.543457]
    ];

    var zona3 = [
      [30.353916, -72.399902],
      [26.29834, -76.530762],
      [24.327077, -73.190918],
      [3.370856, -92.668304],
      [12.42853, -108.218079],
      [3.869735, -115.680542],
      [21.391705, -143.173828],
      [48.107431, -116.367187],
      [48.451066, -115.372925],
      [48.672826, -113.225098],
      [48.770672, -111.51123],
      [48.0083, -109.105225]
    ];

    var zona4 = [
      [-60.403002, -134.637451],
      [-66.921449, -119.564209],
      [-71.791114, -94.053955],
      [-72.164987, -91.862183],
      [-73.024195, -86.5448],
      [-74.202667, -53.660707],
      [-75.321256, -29.769196],
      [-75.624384, -25.215363],
      [-76.399772, -4.21875],
      [-75.477886, 35.804443],
      [-76.378442, 37.65564],
      [-80.141131, 18.781202],
      [-80.033361, -30.657293],
      [-79.851093, -44.604492],
      [-79.443619, -102.740392],
      [-79.372941, -107.513952],
      [-79.134119, -114.422607],
      [-80.772954, -120.860596],
      [-79.758726, -129.896851],
      [-79.253586, -135.516357],
      [-77.61064, -147.821045],
      [-76.71265, -155.654297],
      [-74.819057, -168.167725],
      [-73.738905, -169.980469],
      [-72.812828, -170.068359],
      [-71.972189, -167.969971],
      [-71.674029, -165.871582],
      [-71.184211, -164.091797],
      [-70.344623, -162.015381],
      [-68.776191, -159.060059],
      [-66.00015, -154.907227],
      [-65.173806, -150.721436],
      [-64.58147, -149.216309],
      [-63.729047, -148.161621],
      [-61.969943, -147.32666],
      [-59.894448, -142.811279],
      [-60.559979, -140.526123],
      [-60.174306, -139.537354],
      [-60.177038, -138.886414],
      [-59.935752, -138.400269],
      [-60.074433, -137.590027],
      [-60.012717, -137.002258],
      [-60.382648, -136.636963],
      [-60.350054, -136.123352],
      [-60.555929, -135.598755],
      [-60.561329, -135.137329]
    ];

    var zona5 = [
      [-82.89291, 27.800903],
      [-80.374463, 23.197632],
      [-79.909967, 24.263306],
      [-76.954755, 39.361267],
      [-72.711903, 58.002319],
      [-68.554359, 72.669067],
      [-62.747181, 86.385498],
      [-52.895649, 94.445343],
      [-52.604716, 96.119385],
      [-57.82491, 103.130179],
      [-61.577649, 99.310913],
      [-63.965113, 112.392883],
      [-64.032541, 111.376648],
      [-65.366837, 111.934204],
      [-66.172719, 117.89978],
      [-66.992404, 119.410],
      [-67.927205, 119.674072],
      [-68.198093, 119.020386],
      [-68.582459, 118.54248],
      [-68.930761, 118.328247],
      [-69.009611, 118.531494],
      [-69.207454, 118.498535],
      [-70.089918, 117.169189],
      [-70.783294, 115.477295],
      [-71.13454, 114.169922],
      [-71.221381, 113.532715],
      [-71.80141, 110.231323],
      [-72.198605, 110.159912],
      [-72.7168, 104.106445],
      [-73.403338, 102.854004],
      [-74.158088, 102.886963],
      [-74.149089, 102.897949],
      [-74.813302, 101.524658],
      [-75.419921, 99.437256],
      [-75.461347, 99.283447],
      [-75.973553, 98.876953],
      [-77.451715, 95.108643],
      [-77.582322, 93.603516],
      [-78.023294, 92.867432],
      [-78.547407, 90.681152],
      [-79.794799, 83.748779],
      [-80.670217, 77.2229],
      [-80.94746, 76.59668],
      [-82.405328, 69.938965],
      [-84.068477, 55.387573],
      [-84.041167, 48.120117],
      [-83.75152, 39.276123],
      [-83.408875, 36.705322],
      [-83.224771, 34.683838],
      [-82.853382, 33.310547],
      [-82.683284, 30.915527],
      [-82.763989, 28.366699]
    ];

    var zona6 = [
      [-49.898172936240364, 95.24597167968751],
      [-12.224602049269444, 115.79589843750001],
      [-2.3010169595723617, 119.34997558593751],
      [-1.1479944704491494, 119.98168945312501],
      [0.21423289925023814, 121.12426757812501],
      [1.625758360412755, 123.10729980468751],
      [3.1021210008142988, 126.09558105468751],
      [4.685929506606342, 129.50683593750003],
      [4.34093388932755, 131.19323730468753],
      [4.23685605976896, 132.56103515625003],
      [4.439520707701928, 134.76928710937503],
      [4.642129714308486, 136.15356445312503],
      [4.850154078505659, 137.11486816406253],
      [4.488809196778652, 137.97729492187503],
      [4.187551125218825, 139.08691406250003],
      [2.608351510224566, 139.94384765625003],
      [1.1864386394452024, 140.88317871093753],
      [0.010986328057681535, 141.66320800781253],
      [-0.7250783020332547, 142.22900390625003],
      [-1.5324100450044358, 142.60253906250003],
      [-2.103409206077377, 142.80029296875003],
      [-2.58640142780824, 142.95410156250003],
      [-3.1350311752713904, 143.20129394531253],
      [-3.524386660147952, 143.39904785156253],
      [-4.0944111352807955, 143.75061035156253],
      [-4.959615024698014, 143.73413085937503],
      [-5.801826969242172, 143.75061035156253],
      [-6.588217016715757, 143.99230957031253],
      [-7.476857400769451, 144.57458496093753],
      [-8.015715997869059, 145.06896972656253],
      [-8.635334050763111, 144.79980468750003],
      [-9.568251019008402, 144.37683105468753],
      [-10.287896197088946, 143.98132324218753],
      [-10.40137755454354, 143.96484375000003],
      [-12.270231266343348, 141.29516601562503],
      [-12.517028057234057, 140.56457519531253],
      [-13.384275684388783, 138.53759765625003],
      [-14.275030445572805, 135.92834472656253],
      [-14.886396022031692, 135.60424804687503],
      [-15.347761924346937, 136.52709960937503],
      [-15.60187487673981, 138.09814453125003],
      [-15.945484288404524, 139.67468261718753],
      [-16.188299533590644, 140.31738281250003],
      [-16.657243645360776, 140.77880859375003],
      [-17.644022027872726, 140.81726074218753],
      [-18.849111862024, 141.20727539062503],
      [-19.942369189542, 141.58081054687503],
      [-20.287961155077717, 141.56433105468753],
      [-20.725290873994197, 141.25671386718753],
      [-21.37124437061831, 141.29516601562503],
      [-21.75439787437119, 140.22399902343753],
      [-22.238259929564308, 140.21850585937503],
      [-22.948276856880895, 140.55908203125003],
      [-23.634459770994653, 140.62500000000003],
      [-25.005972656239177, 140.31738281250003],
      [-30.609549797190844, 137.92236328125003],
      [-31.905541455900366, 137.28515625000003],
      [-33.385586268871016, 136.24145507812503],
      [-33.760882000869174, 135.71411132812503],
      [-33.90689555128868, 135.70312500000003],
      [-34.27083595165, 135.13183593750003],
      [-34.624167789904895, 134.94506835937503],
      [-34.80478291957241, 134.25292968750003],
      [-36.05798104702501, 133.96728515625003],
      [-37.063944300566845, 134.04418945312503],
      [-37.857507156252034, 134.15405273437503],
      [-38.487994609214795, 134.06616210937503],
      [-39.04478604850143, 133.60473632812503],
      [-39.631076770083666, 133.25317382812503],
      [-40.12849105685408, 133.19824218750003],
      [-40.73893324113602, 133.09936523437503],
      [-41.36031866306708, 132.87963867187503],
      [-41.91045347666419, 132.84667968750003],
      [-42.45588764197166, 133.00048828125003],
      [-42.811521745097885, 133.28613281250003],
      [-43.36512572875843, 133.57177734375003],
      [-43.91372326852401, 133.62670898437503],
      [-44.52001001133986, 133.67065429687503],
      [-45.18203683701588, 133.65966796875003],
      [-45.75985868785574, 133.46191406250003],
      [-46.70973594407156, 133.03344726562503],
      [-47.01022565568349, 132.52807617187503],
      [-47.532038246759974, 132.56103515625003],
      [-48.16608541901253, 132.74780273437503],
      [-48.61112192003075, 132.64892578125003],
      [-49.37522008143603, 132.84667968750003],
      [-51.33061163769853, 133.64868164062503],
      [-52.07275365395318, 132.78076171875003],
      [-52.34205163638786, 132.15454101562503],
      [-52.66305767075936, 130.07812500000003],
      [-53.67068019347264, 130.25390625000003],
      [-55.73329638198708, 131.80297851562503],
      [-56.065902963300424, 131.84692382812503],
      [-56.426054476049735, 131.40747070312503],
      [-56.92099675839106, 130.20996093750003],
      [-57.36208986154895, 129.30908203125003],
      [-57.833054912910875, 129.38598632812503],
      [-58.51665179936379, 129.00146484375003],
      [-58.88194208135912, 129.05639648437503],
      [-59.34439461630004, 128.94653320312503],
      [-59.80616004020659, 128.72680664062503],
      [-60.02095215374802, 128.30932617187503],
      [-60.20161587042499, 127.69409179687501],
      [-60.19615576604439, 126.83715820312501],
      [-60.32150850738404, 125.95825195312501],
      [-57.028773851491124, 110.13793945312501],
      [-56.68037378950137, 104.12841796875]

    ];

    var zona7 = [
      [30.921076375384906, -58.33740234375001],
      [39.59722324495565, -54.21752929687501],
      [45.298075138707965, -50.87768554687501],
      [48.857487002645485, -57.73315429687501],
      [51.56341232867588, -82.66113281250001],
      [43.874138181474734, -88.41796875000001],
      [38.41916639395372, -75.56396484375001]
    ];

    var zona8 = [
      [50.91688748924508, -64.42382812500001],
      [55.3915921070334, -62.99560546875001],
      [55.875310835696816, -63.36914062500001],
      [64.78348816818996, -84.77050781250001],
      [64.74601725111455, -94.74609375000001],
      [57.25528054528889, -110.45654296875001],
      [54.13669645687002, -100.34912109375]

    ];

    // Definir os polígonos e adicionar IDs personalizados
var poligono = L.polygon(zona, { color: 'red' }).addTo(map);
var poligono2 = L.polygon(zona2, { color: 'blue' }).addTo(map);
var poligono3 = L.polygon(zona3, { color: 'yellow' }).addTo(map);
var poligono4 = L.polygon(zona4, { color: 'cyan' }).addTo(map);
var poligono5 = L.polygon(zona5, { color: 'cyan' }).addTo(map);
var poligono6 = L.polygon(zona6, { color: 'cyan' }).addTo(map);
var poligono7 = L.polygon(zona7, { color: 'green' }).addTo(map);
var poligono8 = L.polygon(zona8, { color: 'green' }).addTo(map);

// Adicionar IDs personalizados
poligono.customId = 4;
poligono2.customId = 12;
poligono3.customId = 1;
poligono4.customId = 3;
poligono5.customId = 5;
poligono6.customId = 5;
poligono7.customId = 6;
poligono8.customId = 11;

// Função para procurar e exibir os dados no modal
function showZonaData(id) {
    fetch('getZonas.php?id=' + id)
        .then(response => response.json())
        .then(data => {
            document.getElementById('zonaModalLabel').innerText = data.nome;
            var zonaModal = new bootstrap.Modal(document.getElementById('zonaModal'));
            zonaModal.show();
        })
        .catch(error => console.error('Erro ao procurar dados:', error));
}

// Adicionar o evento de clique a cada polígono
[poligono, poligono2, poligono3, poligono4, poligono5, poligono6, poligono7, poligono8].forEach(p => {
    p.on('click', function () {
        showZonaData(p.customId);
    });
});

  </script>
</body>

</html>