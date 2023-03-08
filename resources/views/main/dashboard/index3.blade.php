<!DOCTYPE html>
<html>

<head>
    <title>Chart.js Example</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
</head>

<body>
    <div style="width: 50%;">
        <canvas id="myChart"></canvas>
    </div>

    <script>
        const data = {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                label: 'Sales',
                data: [12, 19, 3, 5, 2, 3, 8],
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        };

        // Configuration options for the chart
        const options = {
            plugins: {
                datalabels: {
                    anchor: 'end', // Position the label at the end of the bar
                    align: 'top', // Position the label on top of the bar
                    color: 'red',
                    font: {
                        weight: 'bold'
                    },
                    formatter: function(value, context) {
                        if (context.dataIndex === context.chart.data.datasets[0].data.length - 1) {
                            // Show the sum of all data points on top
                            const total = context.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                            return 'Total: ' + total;
                        } else {
                            return context.chart.data.labels[context.dataIndex] + ': ' + value;
                        }
                    }
                }
            }
        };

        // Create the chart
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options,
            plugins: [ChartDataLabels]
        });
    </script>
</body>

</html>
