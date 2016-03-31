/*
* Note these functions should be used after the document has loaded
* successfully.
*/

// Gets the percentage value.
function to_percent(value, total) {
    return Math.round((value*100) / total);
}
// Initializes and sets up the chart.
function init_chart() {
    // Options for the chart.
    var options = {

    };

    // Data for the chart.
    var data = [];
    var colors = ["#F7464A", "#46BFBD", "#FDB45C", "#3D54D4", "#F27544",
        "#F24481", "3DD9D1"];
    var chart_info = document.getElementById('chart_info');

    // Gets the total violations reported, used to calculate percent of
    // the individual violation types.
    var total = window.type_stats.reduce( function(value, item) {
        return value + Number(item.report_count)
    }, 0);
    console.log(total + 1);
    // Add the violation stats to the data array. Also set the colors.
    for(var i=0; i<window.type_stats.length; ++i) {
        var item = {
            value: to_percent(window.type_stats[i].report_count, total),
            label: window.type_stats[i].violation_type,
            color: colors[i],
            highlight: colors[i]
        };
        data.push(item);

        var information = "<div class='chart_info'>";
        information += "<span class='color_info'";
        information += " style=\"background-color:" + colors[i] + ";\">";
        information += "</span>" + window.type_stats[i].violation_type;
        information += "</div>";

        chart_info.innerHTML += information;
    }

    var chart_canvas = document.getElementById('myChart').getContext('2d');
    var doughnut_chart = new Chart(chart_canvas).Doughnut(data, options);
}

init_chart();
