function createTeamSection(team) {
  // Append the section to the main container
  const container = document.querySelector(".container");
  // Create a section for each team
  const section = document.createElement("div");
  section.className = "team-section";

  // Add a heading for the team name
  const heading = document.createElement("h2");
  heading.textContent = team.team;
  container.appendChild(heading);

  // Create a container for team data
  const teamDataContainer = document.createElement("div");
  teamDataContainer.className = "team-data";

  // Add team data fields
  const fields = [
    { label: "Manager", value: team.manager },
    { label: "Played", value: team.played },
    { label: "Won", value: team.won },
    { label: "Drawn", value: team.drawn },
    { label: "Lost", value: team.lost },
    { label: "GF", value: team.gf },
    { label: "GA", value: team.ga },
    { label: "GD", value: team.gd },
    { label: "Points", value: team.points },
  ];

  fields.forEach((field) => {
    const p = document.createElement("p");
    p.textContent = `${field.label}: ${field.value}`;
    teamDataContainer.appendChild(p);
  });

  section.appendChild(teamDataContainer);

  // Add a canvas for the team chart
  const canvas = document.createElement("canvas");
  canvas.id = `teamChart_${team.team}`;
  canvas.width = 400; // Set width to 400px
  canvas.height = 400; // Set height to 400px
  section.appendChild(canvas);
  container.appendChild(section);
}

function displayChart(teamsData) { 
  if (!teamsData || teamsData.length === 0) {
    console.error("No data available to display the chart.");
    return;
  }

  teamsData.forEach((team) => {
    createTeamSection(team);

    // Extract the data you need for the chart
    const ctx = document
      .getElementById(`teamChart_${team.team}`)
      .getContext("2d");

    new Chart(ctx, {
      type: "pie",
      data: {
        labels: ["Won", "Lost", "Drawn"],
        datasets: [
          {
            label: `Games for ${team.team}`,
            data: [team.won, team.lost, team.drawn],
            backgroundColor: [
              "rgba(75, 192, 192, 0.2)",
              "rgba(255, 99, 132, 0.2)",
              "rgba(255, 206, 86, 0.2)",
            ],
            borderColor: [
              "rgba(75, 192, 192, 1)",
              "rgba(255, 99, 132, 1)",
              "rgba(255, 206, 86, 1)",
            ],
            borderWidth: 1,
          },
        ],
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: "top",
          },
        },
      },
    });
  });
}

function displayCombinedBarChart(teamsData) {
    if (!teamsData || teamsData.length === 0) {
        console.error("No data available to display the chart.");
        return;
    }

    // Prepare data for the bar chart
    const labels = teamsData.map((team) => team.team);
    const played = teamsData.map((team) => team.played); // Total played games
    const wins = teamsData.map((team) => team.won);
    const losses = teamsData.map((team) => team.lost);
    const draws = teamsData.map((team) => team.drawn);

    const ctx = document.getElementById("combinedBarChart").getContext("2d");
    new Chart(ctx, {
        type: "bar",
        data: {
            labels: labels, // Team names
            datasets: [
                {
                    label: "Played",
                    data: played,
                    backgroundColor: "rgba(153, 102, 255, 0.2)",
                    borderColor: "rgba(153, 102, 255, 1)",
                    borderWidth: 1,
                },
                {
                    label: "Wins",
                    data: wins,
                    backgroundColor: "rgba(75, 192, 192, 0.2)",
                    borderColor: "rgba(75, 192, 192, 1)",
                    borderWidth: 1,
                },
                {
                    label: "Losses",
                    data: losses,
                    backgroundColor: "rgba(255, 99, 132, 0.2)",
                    borderColor: "rgba(255, 99, 132, 1)",
                    borderWidth: 1,
                },
                {
                    label: "Draws",
                    data: draws,
                    backgroundColor: "rgba(255, 206, 86, 0.2)",
                    borderColor: "rgba(255, 206, 86, 1)",
                    borderWidth: 1,
                },
            ],
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: "Total Number of Games"
                    }
                },
            },
            plugins: {
                legend: {
                    position: "top",
                },
                title: {
                    display: true,
                    text: "Combined Team Performance",
                },
            },
        },
    });
}

