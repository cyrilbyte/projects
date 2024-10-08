<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Responses Graph</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
        <h2>Graphical Representation of Survey Responses</h2>
        <canvas id="responseChart" width="400" height="200"></canvas>
    </div>

    <script>
    // Fetch response data via AJAX
    fetch('fetch_data.php')
        .then(response => response.json())
        .then(data => {
            const ctx = document.getElementById('responseChart').getContext('2d');
            
            // Create Chart.js chart
            const responseChart = new Chart(ctx, {
                type: 'bar', // You can change this to 'pie', 'line', etc.
                data: {
                    labels: data.labels, // Labels from the PHP response
                    datasets: [{
                        label: 'Survey Responses',
                        data: data.data, // Data from the PHP response
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>
