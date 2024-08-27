// Function to fetch data from a JSON file using AJAX
function fetchLeagueData(callBack) {
  const jsonPath = "./League.json";
  const xhr = new XMLHttpRequest();
  xhr.overrideMimeType("application/json");
  xhr.open("GET", jsonPath, true);
  xhr.onreadystatechange = () => {
    if (xhr.readyState === 4 && xhr.status === 200) {
      const response = JSON.parse(xhr.responseText);
      callBack(response);
    }
  };
  xhr.onerror = () => {
    console.error("Failed to fetch the league data.");
  };
  xhr.send(null);
}

// Function to create table header
function createTableHead(tableHead, fields) {
  tableHead.forEach((row) => {
    const th = document.createElement("th");
    th.classList.add("td-tr-style");
    th.innerHTML = row;
    fields.appendChild(th);
  });
}

// Function to create table rows
function createPointTableRow(playersData, fields) {
  let rowsHtml = "";
  playersData.forEach((playerData) => {
    let rowHtml = "<tr>";
    Object.entries(playerData).forEach(([key, value]) => {
      if (key === "Form") {
        rowHtml += `<td class="td-tr-style">${value
          .split(",")
          .map((form) => {
            const iconSrc =
              form === "W"
                ? "https://i.postimg.cc/MT10jpdB/win-icon.png"
                : form === "L"
                ? "https://i.postimg.cc/GpyGZp0f/loss-icon.png"
                : "https://i.postimg.cc/KcrrG4KS/drow-icon.png";
            return `<img src="${iconSrc}" style="width:15px; margin:2px;">`;
          })
          .join("")}</td>`;
      } else {
        rowHtml += `<td class="td-tr-style"><b>${value}</b></td>`;
      }
    });
    rowHtml += "</tr>";
    rowsHtml += rowHtml;
  });
  fields.innerHTML = rowsHtml;
}
function createTopScorersRow(playersData, fields) {
  let rowsHtml = "";
  playersData.forEach((playerData) => {
    let rowHtml = "<tr>";
    Object.entries(playerData).forEach(([key, value]) => {
      rowHtml += `<td class="td-tr-style"><b>${value}</b></td>`;
    });
    rowHtml += "</tr>";
    rowsHtml += rowHtml;
  });
  fields.innerHTML = rowsHtml;
}

// Function to add form icons
function addFormIcon(image) {
  const img = document.createElement("img");
  img.style.width = "15px";
  img.style.margin = "2px";
  img.src = image;
  return img;
}
// make the table dynamic
function updateTableData(tableData) {
  // Step 1: Update Points
  tableData.forEach((e) => {
    // Convert string to Number
    let Won = Number(e.Won);
    let Drawn = Number(e.Drawn);

    // Calculate the points
    let Points = Won * 3 + Drawn;

    // Update the points field
    e.Points = Points;
  });

  // Step 2: Sort the table data by team points in descending order
  tableData.sort((a, b) => b.Points - a.Points);

  // Step 3: Add Position field to each object
  tableData.forEach((value, index) => {
    // Create a new object with Position at the start
    tableData[index] = {
      Position: String(index + 1),
      ...value,
    };
  });

  return tableData;
}

// Function to display league data
function displayLeagueData(leagueData) {
  const pathName = window.location.pathname;
  const topscorersTableHead = document.getElementById("topscorers-table-head");
  const topscorersTableBody = document.getElementById("topscorers-table-body");
  const topteamTableHead = document.getElementById("topteam-table-head");
  const topteamTableBody = document.getElementById("topteam-table-body");
  const { PremierLeagueTopScorers, PremierLeagueTable } = leagueData;
  //checking the path
  if (pathName.includes("Topscorers.html")) {
    const fields = Object.keys(PremierLeagueTopScorers[0]);
    createTableHead(fields, topscorersTableHead);
    createTopScorersRow(PremierLeagueTopScorers, topscorersTableBody);
  } else if (pathName.includes("League.html")) {
    const dymanicPoint = updateTableData(PremierLeagueTable);
    const fields = Object.keys(PremierLeagueTable[0]);
    createTableHead(fields, topteamTableHead);
    createPointTableRow(dymanicPoint, topteamTableBody);
  }
}

// Function to fetch and display league data
function fetchAndDisplayLeagueData() {
  setTimeout(() => {
    fetchLeagueData(displayLeagueData);
  });
}

// Calling the function
fetchAndDisplayLeagueData();
