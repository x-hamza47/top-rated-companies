//! Registrations Area Chart
var registrationsOptions = {
    chart: {
        type: "area",
        width: "100%",
        height: "100%",
        toolbar: { show: false },
        zoom: { enabled: false },
    },
    series: [
        {
            name: "Registrations",
            data: window.registrationCounts,
        },
    ],
    stroke: {
        curve: "smooth",
        width: 3,
    },
    grid: {
        show: true,
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
        hover: { size: 8 },
    },
    fill: {
        type: "solid",
        colors: ["#65A30D"],
        opacity: 0.2,
    },
    colors: ["#65A30D"],
    xaxis: {
        categories: window.registrationDates,
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

var registrationsChart = new ApexCharts(
    document.querySelector("#registrationsChart"),
    registrationsOptions
);

//! Ratings Bar Chart
var ratingsOptions = {
    chart: {
        type: "bar",
        width: "100%",
        height: "100%",
        toolbar: { show: false },
    },
    series: [
        {
            name: "Reviews",
            data: window.ratingCounts,
        },
    ],
    plotOptions: {
        bar: {
            borderRadius: 6,
            columnWidth: "50%",
        },
    },
    colors: ["#f59e0b"],
    dataLabels: { enabled: false },
    grid: {
        borderColor: "rgba(255,255,255,.05)",
        strokeDashArray: 7,
    },
    xaxis: {
        categories: window.ratingLabels,
        labels: { style: { colors: "#9ca3af", fontSize: "13px" } },
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

var ratingsChart = new ApexCharts(
    document.querySelector("#ratingsChart"),
    ratingsOptions
);

var platformViewsOptions = {
    chart: {
        type: "area",
        width: "100%",
        height: "100%",
        toolbar: { show: false },
        zoom: { enabled: false },
    },
    series: [{ name: "Views", data: window.platformViewCounts }],
    stroke: { curve: "smooth", width: 3 },
    grid: {
        show: true,
        borderColor: "rgba(255,255,255,.05)",
        strokeDashArray: 7,
        yaxis: { lines: { show: true } },
    },
    dataLabels: { enabled: false },
    markers: { size: 5, strokeWidth: 3, hover: { size: 8 } },
    fill: { type: "solid", colors: ["#6366f1"], opacity: 0.2 },
    colors: ["#6366f1"],
    xaxis: {
        categories: window.platformViewDates,
        labels: {
            style: { colors: "#9ca3af", fontSize: "11px" },
            rotate: -45,
        },
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

// ! Traffic by Hour Bar Chart
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
    colors: ["#06b6d4"],
    dataLabels: { enabled: false },
    grid: {
        borderColor: "rgba(255,255,255,.05)",
        strokeDashArray: 7,
    },
    xaxis: {
        categories: window.hourLabels,
        labels: {
            style: { colors: "#9ca3af", fontSize: "10px" },
            rotate: -45,
        },
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

// ! Top Companies Horizontal Bar Chart
var topCompaniesOptions = {
    chart: {
        type: "bar",
        width: "100%",
        height: "100%",
        toolbar: { show: false },
    },
    series: [{ name: "Total Views", data: window.topCompanyCounts }],
    plotOptions: {
        bar: {
            borderRadius: 6,
            horizontal: true,
            barHeight: "55%",
        },
    },
    colors: ["#8b5cf6"],
    dataLabels: {
        enabled: true,
        style: { colors: ["#e5e7eb"], fontSize: "12px" },
        formatter: (val) => val.toLocaleString(),
    },
    grid: {
        borderColor: "rgba(255,255,255,.05)",
        strokeDashArray: 7,
    },
    xaxis: {
        categories: window.topCompanyLabels,
        labels: {
            style: { colors: "#9ca3af", fontSize: "12px" },
            formatter: (val) => val.toLocaleString(),
        },
        axisBorder: { show: false },
        axisTicks: { show: false },
    },
    yaxis: {
        labels: { style: { colors: "#9ca3af", fontSize: "12px" } },
    },
    tooltip: { theme: "dark" },
    legend: { show: false },
};

// *===================================
// * INITIALIZATION
// *===================================
document.addEventListener("DOMContentLoaded", function () {
    registrationsChart.render();
    ratingsChart.render();
    new ApexCharts(document.querySelector("#platformViewsChart"), platformViewsOptions).render();
    new ApexCharts(document.querySelector("#hoursChart"), hoursOptions).render();
    new ApexCharts(document.querySelector("#topCompaniesChart"), topCompaniesOptions).render();
});