//! Views Area Chart
var viewsOptions = {
    chart: {
        type: "area",
        width: "100%",
        height: "100%",
        toolbar: { show: false },
        zoom: { enabled: false },
    },
    series: [{ name: "Views", data: window.viewCounts }],
    stroke: { curve: "smooth", width: 3 },
    grid: {
        show: true,
        borderColor: "rgba(255,255,255,.05)",
        strokeDashArray: 7,
        yaxis: { lines: { show: true } },
    },
    dataLabels: { enabled: false },
    markers: { size: 5, strokeWidth: 3, hover: { size: 8 } },
    fill: { type: "solid", colors: ["#65A30D"], opacity: 0.2 },
    colors: ["#65A30D"],
    xaxis: {
        categories: window.viewDates,
        labels: { style: { colors: "#9ca3af", fontSize: "11px" }, rotate: -45 },
        axisBorder: { show: false },
        axisTicks: { show: false },
    },
    yaxis: {
        min: 0,
        labels: {
            style: { colors: "#9ca3af", fontSize: "12px" },
            formatter: (val) => Math.round(val),
        },
    },
    tooltip: { theme: "dark" },
    legend: { show: false },
};

var viewsChart = new ApexCharts(document.querySelector("#viewsChart"), viewsOptions);

//! Devices Donut Chart
var devicesOptions = {
    chart: { type: "donut", width: "100%", height: "100%" },
    stroke: { width: 0 },
    plotOptions: {
        pie: {
            donut: {
                size: "47%",
                labels: { show: true },
            },
        },
    },
    dataLabels: { enabled: false },
    colors: ["#3b82f6", "#f59e0b", "#10b981", "#ef4444"],
    legend: {
        show: true,
        position: "bottom",
        horizontalAlign: "center",
        fontSize: "14px",
        labels: { colors: "#9ca3af" },
        markers: { size: 7, strokeWidth: 0 },
        itemMargin: { horizontal: 10, vertical: 5 },
    },
    series: window.deviceCounts.length ? window.deviceCounts : [1],
    labels: window.deviceLabels.length ? window.deviceLabels : ["No data"],
};

var devicesChart = new ApexCharts(document.querySelector("#devicesChart"), devicesOptions);

//! Hours Bar Chart
var hoursOptions = {
    chart: {
        type: "bar",
        width: "100%",
        height: "100%",
        toolbar: { show: false },
    },
    series: [{ name: "Visits", data: window.hourCounts }],
    plotOptions: {
        bar: { borderRadius: 4, columnWidth: "70%" },
    },
    colors: ["#3b82f6"],
    dataLabels: { enabled: false },
    grid: {
        borderColor: "rgba(255,255,255,.05)",
        strokeDashArray: 7,
    },
    xaxis: {
        categories: window.hourLabels,
        labels: { style: { colors: "#9ca3af", fontSize: "11px" }, rotate: -45 },
        axisBorder: { show: false },
        axisTicks: { show: false },
    },
    yaxis: {
        min: 0,
        labels: {
            style: { colors: "#9ca3af", fontSize: "12px" },
            formatter: (val) => Math.round(val),
        },
    },
    tooltip: { theme: "dark" },
    legend: { show: false },
};

var hoursChart = new ApexCharts(document.querySelector("#hoursChart"), hoursOptions);

// *===================================
// * INITIALIZATION
// *===================================
document.addEventListener("DOMContentLoaded", function () {
    viewsChart.render();
    devicesChart.render();
    hoursChart.render();
});