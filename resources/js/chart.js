import ApexCharts from "apexcharts";

export default function glowChart({ id, options }) {
    return {
        chart: null,
        init: () => {
            this.chart = new ApexCharts(this.$refs[id], options);
            this.chart.render();

            this.$wire.on('updateSeries', ({ data }) => {
                this.chart.updateSeries(data);
            });
        },
    }
  
}
