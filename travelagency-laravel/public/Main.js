$("#btn-show").click(function() {
    $("#hot-banner").fadeIn(1000);
    $("#btn-show").hide();
});

$("#btn-close").click(function() {
    $("#hot-banner").fadeOut(1);
    $("#btn-show").show();
});

$("#special-toggle").click(function() {
    var $body = $("#special-body");
    var $header = $(".special-header");
    var $arrow = $("#arrow");

    if ($body.is(":visible")) {
        $arrow.text("▼");
        $body.slideUp(1000, function() {
            $header.css({
                borderBottomLeftRadius: 10,
                borderBottomRightRadius: 10
            });
        });
    } else {
        $arrow.text("▲");
        $header.css({
            borderBottomLeftRadius: 0,
            borderBottomRightRadius: 0
        });
        $body.slideDown(300);
    }
});

$(".btn-teal, .btn-yellow, .btn-orange").hover(
    function() {
        $(this).stop().animate({
            opacity: 0.6
        }, 200);
    },
    function() {
        $(this).stop().animate({
            opacity: 1
        }, 200);
    }
);

$(".tour-card").hover(
    function() {
        $(this).stop().fadeTo(300, 0.8);
    },
    function() {
        $(this).stop().fadeTo(300, 1);
    }
);

$("#btn-show").click(function() {
    $(".hot-card").each(function(index) {
        $(this).delay(index * 100).animate({
            opacity: 1,
            marginTop: "0px"
        }, 500);
    });
});

$(".hot-card").css({
    opacity: 0,
    marginTop: "100px"
});




var ctx = document.getElementById('barChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Turkey', 'Greece', 'Egypt', 'Italy', 'Norway'],
        datasets: [
            {
            label: 'Bookings',
            data: [120, 58, 87, 95, 54],
            backgroundColor: [
                'orange',
                'yellow',
                'lightblue',
                'blue',
                'green'
            ]}]
    },
    options: {
        scales: {
            yAxes: [{
                ticks : {
                    beginAtZero: true
                }
            }]
        }
    }
});




var ctx2 = document.getElementById('pieChart');

new Chart(ctx2, {
    type: 'pie',
    data: {
        labels: ['Children', 'Young', 'Adult', 'Old people'],
        datasets: [{
            data: [20, 35, 35, 10],
            backgroundColor: [
                'orange',
                'red',
                'brown',
                'darkred'
            ]
        }]
    }
});

var ctx3 = document.getElementById('doughnut')

new Chart(ctx3, {
    type: 'doughnut',
    data: {
        labels: ['Beach', 'Adventure', 'Cultural', 'Mountain'],
        datasets: [{
            data: [45, 25, 20, 10],
            backgroundColor: [
                'lightblue',
                'red',
                'yellow',
                'green'
            ]
        }]
    }
});

var ctx4 = document.getElementById('polarArea');

new Chart(ctx4, {
    type: 'polarArea',
    data: {
        labels: ['Morning (6-12)', 'Afternoon (12-18)', 'Evening (18-24)', 'Night (0-6)'],
        datasets: [{
            label: 'Bookings by Time',
            data: [85, 150, 210, 25],
            backgroundColor: [
                'rgba(255, 193, 7, 1)',
                'rgba(255, 107, 53, 1)',
                'rgba(103, 58, 183, 1)',
                'rgba(33, 150, 243, 1)'
            ]
        }]
    },
    options: {
        scales: {
            r: {
                beginAtZero: true,
                ticks: {
                }
            }
        }
    }
});


var ctx5 = document.getElementById('line');

new Chart(ctx5, {
    type: 'line',
    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June'],
        datasets: [{
            label: 'Monthly Revenue ($)',
            data: [15000, 18000, 50000, 28000, 35000, 35000],
            borderColor: '#2bb5c8',
            backgroundColor: 'rgba(43, 181, 200, 0.2)',
            tension: 0.4,
            fill: true
        }]
    },
    options: {
        scales: {
            y: {
                ticks: {
                    beginAtZero: true
                    }
                }
            }
        }

});











