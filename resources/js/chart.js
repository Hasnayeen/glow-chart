import ApexCharts from "apexcharts";

export default function glowChart({ options }) {
    return {
        init: () => {
            console.log("init chart")
            console.table(options)
            this.chart = new ApexCharts(document.querySelector("#chart"), options);
            this.chart.render();
        },
        chart: null,
    }
  
}
