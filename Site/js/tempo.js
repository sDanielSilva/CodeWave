$(document).ready(function () {
  
  const API_KEY = process.env.WEATHER_API_KEY;

  // Coordenadas do parque aquático CodeWave
  const LATITUDE = "40.64791492340506";
  const LONGITUDE = "-8.593609469316988";

  // Função para obter a previsão do tempo da WeatherAPI
  function getWeatherForecast() {
    const url = `http://api.weatherapi.com/v1/forecast.json?key=${API_KEY}&q=${LATITUDE},${LONGITUDE}&days=3`;

    fetch(url)
      .then((response) => response.json())
      .then((data) => {
        console.log(data);
        // Cria o carrossel com os dados da previsão do tempo
        createCarouselItems(data.forecast.forecastday, data);
      })
      .catch((error) => console.error("Error:", error));
  }

  // Função para criar o carrossel com os dados da previsão do tempo
  function createCarouselItems(forecastDays, data) {
    const carousel = document.getElementById("carouselItems");

    // Limpa o carrossel antes de adicionar novos objetos
    carousel.innerHTML = "";

    forecastDays.forEach((day, index) => {
      // Crie um novo elemento .carousel-item
      const item = document.createElement("div");
      item.classList.add("carousel-item");

      item.setAttribute("data-date", day.date);

      const content = document.createElement("div");
      content.innerHTML = `
                    <h5>${day.date}</h5>
                    <img src="http:${day.day.condition.icon}" alt="${day.day.condition.text}">
                    <p>Temperatura mínima: ${day.day.mintemp_c}°C</p>
                    <p>Temperatura máxima: ${day.day.maxtemp_c}°C</p>
                    <p>Vento: ${day.day.avgvis_km}km/h</p>

                `;

      item.appendChild(content);
      carousel.appendChild(item);

      // Quando um objeto do carrossel é clicado, exibe a previsão do tempo hora a hora para esse dia
      item.addEventListener("click", (event) => {
        const date = event.currentTarget.getAttribute("data-date");
        const dayForecast = data.forecast.forecastday.find(
          (forecast) => forecast.date === date
        );

        // Mostrar o carrossel hourly-weather
        const hourlyWeather = document.getElementById("hourly-weather");
        const prevBtnHourly = document.getElementById("prevBtnHourly");
        const nextBtnHourly = document.getElementById("nextBtnHourly");

        // Se o objeto já está ativo, remove a classe 'active' e oculta a previsão do tempo hora a hora
        if (item.classList.contains("active")) {
          item.classList.remove("active");
          hourlyWeather.style.display = "none";
          hourlyWeather.classList.remove("open");
          prevBtnHourly.style.display = "none";
          nextBtnHourly.style.display = "none";

          // Limpa as informações de previsão do tempo hora a hora
          const container = document.getElementById("hourlyItems");
          container.innerHTML = "";
        } else {
          // Remove a classe 'active' de todos os objetos do carrossel
          document
            .querySelectorAll(".carousel-item.active")
            .forEach((activeItem) => {
              activeItem.classList.remove("active");
            });

          // Adiciona a classe 'active' ao objeto clicado
          item.classList.add("active");

          // Exibe a previsão do tempo hora a hora para o dia selecionado
          displayHourlyForecast(dayForecast.hour);
          hourlyWeather.style.display = "block";
          hourlyWeather.classList.add("open");
          prevBtnHourly.style.display = "block";
          nextBtnHourly.style.display = "block";
        }
      });
    });
  }

  // Função para exibir a previsão do tempo hora a hora para um dia específico
  function displayHourlyForecast(hourlyForecast) {
    const container = document.getElementById("hourlyItems");
    container.innerHTML = "";
    hourlyForecast.forEach((hour) => {
      // Extrai apenas a hora da string de tempo
      const time = hour.time.split(" ")[1];

      const content = document.createElement("div");
      content.classList.add("hourly-weather-item");
      content.innerHTML = `
        <h6>${time}</h6>
        <p>Temperatura: ${hour.temp_c}°C</p>
        <img src="http:${hour.condition.icon}" alt="${hour.condition.text}">
      `;

      container.appendChild(content);
    });
  }

  // Obtem a previsão do tempo quando a página é carregada
  getWeatherForecast();

  document.getElementById("prevBtn").addEventListener("click", function () {
    document
      .getElementById("carouselItems")
      .scrollBy(-window.innerWidth / 2, 0);
  });

  document.getElementById("nextBtn").addEventListener("click", function () {
    document.getElementById("carouselItems").scrollBy(window.innerWidth / 2, 0);
  });

  document
    .getElementById("prevBtnHourly")
    .addEventListener("click", function () {
      document
        .getElementById("hourlyItems")
        .scrollBy(-window.innerWidth / 2, 0);
    });

  document
    .getElementById("nextBtnHourly")
    .addEventListener("click", function () {
      document.getElementById("hourlyItems").scrollBy(window.innerWidth / 2, 0);
    });
});
