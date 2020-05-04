'use_strict';

(function ($) {

    /**
     * Charts
     * @type {OffscreenRenderingContext | CanvasRenderingContext2D | WebGLRenderingContext}
     */
        // Views
    var viewed = $('#viewsChartDoughnut').attr('data-views');
    var allartists = $('#viewsChartDoughnut').attr('data-all-artists');
    var DoughnutCtx = document.getElementById('viewsChartDoughnut').getContext('2d');
    var leaved = (allartists - viewed);
    var myDoughnutChart = new Chart(DoughnutCtx, {
        type: 'doughnut',
        data: {
            labels: ['Viewed', 'Not Viewed'],
            datasets: [{
                data: [viewed, leaved],
                backgroundColor: [
                    '#00d6ff',
                    '#8b939c'
                ],
                borderColor: [
                    '#262c33',
                    '#262c33',
                    '#262c33',
                    '#262c33',
                    '#262c33',
                    '#262c33'
                ],
                borderWidth: 5,
                weight: 20
            }]
        },
        options: {
            animation: {
                duration: 3000,
                easing: 'easeOutBounce'
            }
        }
    });

    // Total Views
    var viewed_single = $('#totalViewsChart').attr('data-single-views');
    var totalviews = $('#totalViewsChart').attr('data-total-views');
    var myBarCtx = document.getElementById('totalViewsChart').getContext('2d');
    var myBarChart = new Chart(myBarCtx, {
        type: 'bar',
        data: {
            labels: ['Total Views', 'Single Views'],
            datasets: [{
                data: [totalviews, viewed_single],
                backgroundColor: [
                    '#00d6ff',
                    '#8b939c'
                ],
                borderColor: [
                    '#262c33',
                    '#262c33',
                    '#262c33',
                    '#262c33',
                    '#262c33',
                    '#262c33'
                ],
                borderWidth: 1,
                weight: 20
            }]
        },
        options: {
            animation: {
                duration: 3000,
                easing: 'easeOutBounce'
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            legend: false
        }
    });

    // Average rating
    var averagerate = $('#avrate').attr('data-averge');
    var myAverageCtx = document.getElementById('avrate').getContext('2d');
    var myAverageChart = new Chart(myAverageCtx, {
        type: 'horizontalBar',
        data: {
            labels: ['', ''],
            datasets: [{
                data: [averagerate, 10],
                backgroundColor: [
                    '#00d6ff',
                    '#8b939c'
                ],
                borderColor: [
                    '#262c33',
                    '#262c33',
                    '#262c33',
                    '#262c33',
                    '#262c33',
                    '#262c33'
                ],
                borderWidth: 1
            }]
        },
        options: {
            animation: {
                duration: 3000,
                easing: 'easeOutBounce'
            },
            scales: {
                xAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            responsive: true,
            legend: false,
        }
    });

})(jQuery);
