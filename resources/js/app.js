import ApexCharts from 'apexcharts'

let chart = document.querySelector("#chart");

if (chart) {
    let chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
}
