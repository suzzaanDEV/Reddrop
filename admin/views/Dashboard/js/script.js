document.addEventListener('DOMContentLoaded', function () {
    const dateFilter = document.getElementById('dateFilter');

    dateFilter.addEventListener('change', fetchData);

    function fetchData() {
        const date = dateFilter.value;

        fetch(`data/data.php?date=${date}`)
            .then(response => response.json())
            .then(data => {
                updateStatistics(data.stats);
                renderBloodGroupChart(data.chartData.bloodGroups);
                renderDonationTrendsChart(data.chartData.trends);
                renderDonationByCenterChart(data.chartData.centers);
            });
    }

    function updateStatistics(stats) {
        document.getElementById('totalDonations').textContent = stats.total;
        document.getElementById('oPlusDonors').textContent = stats.O_positive;
        document.getElementById('oMinusDonors').textContent = stats.O_negative;
        document.getElementById('aPlusDonors').textContent = stats.A_positive;
        document.getElementById('aMinusDonors').textContent = stats.A_negative;
        document.getElementById('abPlusDonors').textContent = stats.AB_positive;
        document.getElementById('abMinusDonors').textContent = stats.AB_negative;
    }

    function renderBloodGroupChart(data) {
        const ctx = document.getElementById('bloodGroupChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.labels,
                datasets: [{
                    label: 'Blood Donations by Group',
                    data: data.values,
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
    }

    function renderDonationTrendsChart(data) {
        const ctx = document.getElementById('donationTrendsChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: data.dates,
                datasets: [{
                    label: 'Donations Over Time',
                    data: data.values,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Date'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Number of Donations'
                        },
                        beginAtZero: true
                    }
                }
            }
        });
    }

    function renderDonationByCenterChart(data) {
        const ctx = document.getElementById('donationByCenterChart').getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: data.labels,
                datasets: [{
                    label: 'Donations by Center',
                    data: data.values,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            }
        });
    }

    // Fetch data on page load
    fetchData();
});
