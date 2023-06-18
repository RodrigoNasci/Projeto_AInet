import './adminkit';

// Gráfico de encomendas
document.addEventListener("DOMContentLoaded", function () {
    var orders = JSON.parse(document.getElementById('jsonClosedOrdersPerMonth').value);

    //ver se o ano é o atual
    var currentYear = new Date().getFullYear();
    if (document.getElementById('year').value == currentYear) {
        //remover os meses que ainda não passaram
        var currentMonth = new Date().getMonth() + 1;

        orders = orders.slice(0, currentMonth);
    }

    //console.log(orders);

    var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
    var gradient = ctx.createLinearGradient(0, 0, 0, 225);
    gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
    gradient.addColorStop(1, "rgba(215, 227, 244, 0)");
    // Line chart
    new Chart(document.getElementById("chartjs-dashboard-line"), {
        type: "line",
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Encomendas",
                fill: true,
                backgroundColor: gradient,
                borderColor: window.theme.primary,
                data: orders
            }]
        },
        options: {
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            tooltips: {
                intersect: false
            },
            hover: {
                intersect: true
            },
            plugins: {
                filler: {
                    propagate: false
                }
            },
            scales: {
                xAxes: [{
                    reverse: true,
                    gridLines: {
                        color: "rgba(0,0,0,0.0)"
                    }
                }],
                yAxes: [{
                    ticks: {
                        stepSize: 100
                    },
                    display: true,
                    borderDash: [3, 3],
                    gridLines: {
                        color: "rgba(0,0,0,0.0)"
                    }
                }]
            }
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    var orders = JSON.parse(document.getElementById('jsonOrdersPerMonth').value);

    //ver se o ano é o atual
    var currentYear = new Date().getFullYear();
    if (document.getElementById('year').value == currentYear) {
        //remover os meses que ainda não passaram
        var currentMonth = new Date().getMonth() + 1;

        orders = orders.slice(0, currentMonth);
    }

    var ctx = document.getElementById("line-chart").getContext("2d");
    var gradient = ctx.createLinearGradient(0, 0, 0, 225);
    gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
    gradient.addColorStop(1, "rgba(215, 227, 244, 1)");
    // Line chart
    new Chart(document.getElementById("line-chart"), {
        type: "bar",
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Encomendas",
                fill: true,
                backgroundColor: gradient,
                borderColor: window.theme.primary,
                data: orders
            }]
        },
        options: {
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            tooltips: {
                intersect: false
            },
            hover: {
                intersect: true
            },
            plugins: {
                filler: {
                    propagate: false
                }
            },
            scales: {
                xAxes: [{
                    reverse: true,
                    gridLines: {
                        color: "rgba(0,0,0,0.0)"
                    }
                }],
                yAxes: [{
                    ticks: {
                        stepSize: 100
                    },
                    display: true,
                    borderDash: [3, 3],
                    gridLines: {
                        color: "rgba(0,0,0,0.0)"
                    }
                }]
            }
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    var orders = JSON.parse(document.getElementById('jsonRevenuePerMonth').value);

    //ver se o ano é o atual
    var currentYear = new Date().getFullYear();
    if (document.getElementById('year').value == currentYear) {
        //remover os meses que ainda não passaram
        var currentMonth = new Date().getMonth() + 1;

        orders = orders.slice(0, currentMonth);
    }

    var ctx = document.getElementById("line-chart2").getContext("2d");
    var gradient = ctx.createLinearGradient(0, 0, 0, 225);
    gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
    gradient.addColorStop(1, "rgba(215, 227, 244, 0)");
    // Line chart
    new Chart(document.getElementById("line-chart2"), {
        type: "line",
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Encomendas",
                fill: true,
                backgroundColor: gradient,
                borderColor: window.theme.primary,
                data: orders
            }]
        },
        options: {
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            tooltips: {
                intersect: false
            },
            hover: {
                intersect: true
            },
            plugins: {
                filler: {
                    propagate: false
                }
            },
            scales: {
                xAxes: [{
                    reverse: true,
                    gridLines: {
                        color: "rgba(0,0,0,0.0)"
                    }
                }],
                yAxes: [{
                    ticks: {
                        stepSize: 100
                    },
                    display: true,
                    borderDash: [3, 3],
                    gridLines: {
                        color: "rgba(0,0,0,0.0)"
                    }
                }]
            }
        }
    });
});

// Tshirts mais vendidas
// TODO
