let tabs, tabContents, tableGeral, tableEscolas;

function toggleTab(tabIndex) {
  tabs = tabs || document.querySelectorAll(".tab");
  tabContents = tabContents || document.querySelectorAll(".tab-content");

  tabs.forEach((tab, index) => {
    const isActive = index === tabIndex;
    tab.classList.toggle("active", isActive);
    tabContents[index].classList.toggle("active", isActive);
  });

  loadHorarios(tabIndex);
}

async function loadHorarios(tabIndex) {
  const url = "horariosphp.php";

  try {
    const response = await fetch(url);
    if (response.ok) {
      const horarios = await response.json();
      updateHorariosTable(tabIndex, horarios);
    } else {
      console.error("Erro ao carregar os horários. Status:", response.status);
    }
  } catch (e) {
    console.error("Erro ao carregar os horários:", e);
  }
}

function updateHorariosTable(tabIndex, horarios) {
  const diasSemana = [
    "Domingo",
    "Segunda-feira",
    "Terça-feira",
    "Quarta-feira",
    "Quinta-feira",
    "Sexta-feira",
    "Sábado",
  ];

  const table =
    tabIndex === 0
      ? (tableGeral = tableGeral || document.querySelector("#tabGeral table"))
      : (tableEscolas =
          tableEscolas || document.querySelector("#tabEscolas table"));

  while (table.rows.length > 1) {
    table.deleteRow(1);
  }

  const modalidade = tabIndex === 0 ? "geral" : "escolas";
  const horariosModalidade = horarios[modalidade];

  diasSemana.forEach((diaSemana, index) => {
    const horario = horariosModalidade[index + 1];
    let abertura, fecho;

    if (horario) {
      [abertura, fecho] = horario;
      if (modalidade === "escolas" && abertura === null && fecho === null) {
        return; // Não cria uma linha para este dia se a modalidade for "escolas" e a hora de abertura e fecho forem NULL
      }
      const newRow = table.insertRow();

      newRow.insertCell().textContent = diaSemana;
      newRow.insertCell().textContent = abertura;
      newRow.insertCell().textContent = fecho;
    }
  });
}

window.onload = function () {
  loadHorarios(0);
};
