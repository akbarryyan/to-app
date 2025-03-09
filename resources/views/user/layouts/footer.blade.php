<!--scripts -->
<script src="{{ asset('user/assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('user/assets/js/flatpickr.js') }}"></script>
<script>
  // min-calender
  $("#min-calender").flatpickr({
    enableTime: true,
    dateFormat: "Y-m-d H:i",
    inline: true,
  });
</script>
<script src="{{ asset('user/assets/js/slick.min.js') }}"></script>
<script src="{{ asset('user/assets/js/aos.js') }}"></script>
<script>
  AOS.init();
</script>
<script src="{{ asset('user/assets/js/main.js') }}"></script>
<script src="{{ asset('user/assets/js/chart.js') }}"></script>
<script>
  function pieChart() {
    let pieChart = document.getElementById("pie_chart").getContext("2d");

    const data = {
      labels: [10, 20, 30],
      datasets: [
        {
          label: "My First Dataset",
          data: [15, 20, 35, 40],
          backgroundColor: ["#1A202C", "#61C660", "#F8CC4B", "#EDF2F7"],
          borderColor: ["#ffffff", "#ffffff", "#ffffff", "#1A202C"],
          hoverOffset: 18,
          borderWidth: 0,
        },
      ],
    };
    const customDatalabels = {
      id: "customDatalabels",
      afterDatasetsDraw(chart, args, pluginOptions) {
        const {
          ctx,
          data,
          chartArea: { top, bottom, left, right, width, height },
        } = chart;
        ctx.save();
        data.datasets[0].data.forEach((datapoint, index) => {
          const { x, y } = chart
            .getDatasetMeta(0)
            .data[index].tooltipPosition();
          ctx.font = "bold 12px sans-serif";
          ctx.fillStyle = data.datasets[0].borderColor[index];
          ctx.textAlign = "center";
          ctx.textBaseline = "middle";
          ctx.fillText(`${datapoint}%`, x, y);
        });
      },
    };
    const config = {
      type: "doughnut",
      data,
      options: {
        maintainAspectRatio: false,
        layout: {
          padding: {
            left: 10,
            right: 10,
            top: 10,
            bottom: 10,
          },
        },
        plugins: {
          legend: {
            display: false,
          },
        },
      },
      plugins: [customDatalabels],
    };

    let pieChartConfiig = new Chart(pieChart, config);
  }
  pieChart();
  let revenueFlowElement = document
    .getElementById("overAllBalance")
    .getContext("2d");
  let month = [
    "Jan",
    "Feb",
    "Mar",
    "April",
    "May",
    "Jun",
    "July",
    "Aug",
    "Sep",
    "Oct",
    "Nov",
    "Dec",
  ];
  let revenueFlow = new Chart(revenueFlowElement, {
    type: "line",
    plugins: [
      {
        beforeDatasetsDraw(chart) {
          chart.ctx.shadowColor = "rgba(37, 99, 235, 0.14)";
          chart.ctx.shadowBlur = 8;
        },
        afterDatasetsDraw(chart) {
          chart.ctx.shadowColor = "rgba(0, 0, 0, 0)";
          chart.ctx.shadowBlur = 0;
        },
      },
    ],
    data: {
      labels: month,
      datasets: [
        {
          label: "Signed",
          data: [65, 75, 65, 55, 75, 55, 45, 65, 75, 65, 85, 75],
          backgroundColor: () => {
            const chart = document
              .getElementById("overAllBalance")
              .getContext("2d");
            const gradient = chart.createLinearGradient(0, 0, 0, 450);
            gradient.addColorStop(0, "rgba(34, 197, 94,0.41)");
            gradient.addColorStop(0.6, "rgba(255, 255, 255, 0)");
            return gradient;
          },
          borderColor: "#22C55E",
          // pointRadius: 5,
          pointBorderColor: "#ffffff",
          pointBackgroundColor: "#22C55E",
          pointBorderWidth: 4,
          borderWidth: 2,
          fill: true,
          fillColor: "#fff",
          tension: 0.4,
        },
      ],
    },
    options: {
      // layout: {
      //   padding: {
      //     bottom: -20,
      //   },
      // },
      maintainAspectRatio: false,
      responsive: true,
      scales: {
        x: {
          grid: {
            color: "rgb(243 ,246, 255 ,1)",
          },
          gridLines: {
            zeroLineColor: "transparent",
          },
        },
        y: {
          beginAtZero: true,
          grid: {
            color: "rgb(243 ,246, 255 ,1)",
            borderDash: [5, 5],
            borderDashOffset: 2,
          },
          gridLines: {
            zeroLineColor: "transparent",
          },
          ticks: {
            callback(value) {
              return `${value}K `;
            },
          },
        },
      },

      plugins: {
        legend: {
          position: "top",
          display: false,
        },
        title: {
          display: false,
          text: "Visitor: 2k",
        },
        // tooltip: {
        //   enabled: false,
        // },
      },
      elements: {
        point: {
          radius: [0, 0, 0, 6, 0, 0, 0, 0, 0, 0, 0, 0],
          hoverRadius: 6,
        },
      },
    },
  });

  //dark switch
  let themeToggleSwitch = document.getElementById("theme-toggle");

  //onclick
  if (themeToggleSwitch) {
    themeToggleSwitch.addEventListener("click", function () {
      if (
        document.documentElement.classList[0] === "dark" ||
        localStorage.theme === "dark"
      ) {
        revenueFlow.options.scales.y.ticks.color = "white";
        revenueFlow.options.scales.x.ticks.color = "white";
        revenueFlow.options.scales.x.grid.color = "#242830";
        revenueFlow.options.scales.y.grid.color = "#242830";
        revenueFlow.update();
      } else {
        revenueFlow.options.scales.y.ticks.color = "black";
        revenueFlow.options.scales.x.ticks.color = "black";
        revenueFlow.options.scales.x.grid.color = "rgb(243 ,246, 255 ,1)";
        revenueFlow.options.scales.y.grid.color = "rgb(243 ,246, 255 ,1)";
        revenueFlow.update();
      }
      revenueFlow.update();
    });
  }

  //initial load
  if (
    localStorage.theme === "dark" ||
    window.matchMedia("(prefers-color-scheme: dark)").matches
  ) {
    revenueFlow.options.scales.y.ticks.color = "white";
    revenueFlow.options.scales.x.ticks.color = "white";
    revenueFlow.options.scales.x.grid.color = "#242830";
    revenueFlow.options.scales.y.grid.color = "#242830";
  } else {
    revenueFlow.options.scales.y.ticks.color = "black";
    revenueFlow.options.scales.x.ticks.color = "black";
    revenueFlow.options.scales.x.grid.color = "rgb(243 ,246, 255 ,1)";
    revenueFlow.options.scales.y.grid.color = "rgb(243 ,246, 255 ,1)";
  }
  revenueFlow.update();
</script>
</body>
</html>