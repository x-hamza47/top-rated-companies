//! Area Chart
var progressOptions = {
  chart: {
    type: "area",
    width:"100%",
    height: "100%",
    toolbar: { show: false },
    zoom: { enabled: false },
  },
  series: [
    {
      name: "Website",
      data: [120, 200, 300, 450, 350, 500, 420, 460, 390],
    },
  ],
  stroke: {
    curve: "smooth",
    width: 3,
  },
  grid: {
    show: !false,
    borderColor: "rgba(255,255,255,.05)",
    strokeDashArray: 7,
    yaxis: { lines: { show: true } },
  },
  dataLabels: {
    enabled: false,
  },
  markers: {
    size: 5,
    strokeWidth: 3,
    hover: {
      size: 8,
    },
  },
  fill: {
    type: "solid",
    colors: ["#65A30D"],
    opacity: 0.2,
  },
  xaxis: {
    categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep"],
    labels: { style: { colors: "#9ca3af", fontSize: "13px" } },
    axisBorder: { show: false },
    axisTicks: { show: false },
  },

  yaxis: {
    min: 0,
    labels: {
      style: { colors: "#9ca3af", fontSize: "12px" },
      formatter: (val) => val,
    },
  },
  tooltip: { theme: "dark" },
  legend: { show: false },
};

var progressChart = new ApexCharts(
  document.querySelector("#progressChart"),
  progressOptions
);
// progressChart.render();

//! Chart 2
var categoryChartoptions = {
  chart: {
    type: "donut",
    width:"100%",
    height: "100%",
  },
  stroke: {
    width: 0,
  },
  plotOptions: {
    pie: {
      donut: {
        size: "47%",
        labels: {
          show: true,
        },
      },
    },
  },
  dataLabels: {
    enabled: false,
  },
  colors: ["#FF4040", "#3b82f6", "#facc15", "#ef4444"],
  legend: {
    show: true,
    position: "bottom",
    horizontalAlign: "center",
    fontSize: "14px",
    labels: {
      colors: "#9ca3af",
    },
    markers: {
      size: 7,
      strokeWidth: 0,
    },
    itemMargin: {
      horizontal: 10,
      vertical: 5,
    },
  },

  series: [44, 33, 23],
  labels: ["Completed", "In Progress", "Pending"],
};

var categoryChart = new ApexCharts(
  document.querySelector("#categoryChart"),
  categoryChartoptions
);
// categoryChart.render();