document.addEventListener("DOMContentLoaded", function () {
    const labels = window.chartData.labels;
    const data = window.chartData.data;

    const options = {
        chart: {
            type: "pie",
            height: '100%',
        },
        title: {
            text: "Services Distribution", // Chart title
            align: "left", // center, left, right
            // offsetX: -35,
            // offsetY: 40,
            style: {
                fontSize: "18px",
                fontWeight: "bold",
                color: "oklch(27.4% 0.072 132.109)",
            },
        },
        labels: labels,
        series: data,
        colors: generateColors(data.length),
        legend: {
            position: "right",
            offsetX: 20,
            offsetY: 0,
            markers: {
                width: 12,
                height: 12,
                radius: 50,
            },
        },

        dataLabels: {
            enabled: !true,
        },
        responsive: [
            {
                breakpoint: 768,
                options: {
                    chart: { height: 300 },
                    legend: { position: "bottom" },
                },
            },
        ],
        tooltip: {
            y: {
                formatter: function (val) {
                    return val + "%";
                },
            },
        },
    };

    const chart = new ApexCharts(document.querySelector("#myChart"), options);
    chart.render();
});

function generateColors(num) {
    const baseColors = ["#2b3b13", "#487504", "#165702", "#4ADE80", "#16A34A"];
    const colors = [];
    for (let i = 0; i < num; i++) {
        colors.push(baseColors[i % baseColors.length]);
    }
    return colors;
}
