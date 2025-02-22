
$(document).ready(function () {
    let testBowiesBar = document.getElementById('testBowiesChart');
    $.get('/testbowies/chart-data', function (response) {
        let testBowiesChart = new Chart(testBowiesBar, {
            type: 'bar',
            data: {
                labels: response.Negativos.original.days,
                datasets: [{
                    label: 'Negativos',
                    data: response.Negativos.original.data,
                    backgroundColor: [
                        '#6366F1',
                    ],
                    borderColor: [
                        '#6366F1',
                    ],
                    borderWidth: 1
                },
                {
                    label: 'Positivos',
                    data: response.Positivos.original.data,
                    backgroundColor: [
                        '#c53929',
                    ],
                    borderColor: [
                        '#c53929',
                    ],
                    borderWidth: 1
                }
                ]
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
    let testVacummsBar = document.getElementById('testVacummsBar');
    $.get('/testvacuums/chart-data', function (response) {
        let testVacummsBar = new Chart(testVacummsBar, {
            type: 'bar',
            data: {
                labels: response.Negativos.original.days,
                datasets: [{
                    label: 'Negativos',
                    data: response.Negativos.original.data,
                    backgroundColor: [
                        '#6366F1',
                    ],
                    borderColor: [
                        '#6366F1',
                    ],
                    borderWidth: 1
                },
                {
                    label: 'Positivos',
                    data: response.Positivos.original.data,
                    backgroundColor: [
                        '#c53929',
                    ],
                    borderColor: [
                        '#c53929',
                    ],
                    borderWidth: 1
                }
                ]
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

});
