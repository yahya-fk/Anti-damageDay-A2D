    var colors = ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0'];

    var barChart = new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: workshops,
            datasets: [{
                label: 'NOK Percentage per workshop',
                data: nokPercentages,
                backgroundColor: colors
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    title: {
                        display: true,
                        text: 'Percentage des NOK'
                    },
                    ticks: {
                        callback: function(value) {
                            return value + '%';
                        }
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Atelier'
                    }
                }
            }
        }
    
    });


