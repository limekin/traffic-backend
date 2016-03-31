// Used to for showing doughnuts for each of the reports.

// Gets the percentage value.
function to_percent(value, total) {
    return Math.round((value*100) / total);
}

// Initializes the charts for the page.
function init_stat_chart() {
    // The colors for chart.
    var colors = ["#F7464A", "#46BFBD", "#FDB45C", "#3D54D4", "#F27544",
        "#F24481", "#3DD9D1"];


    // For all the data in window.stats, show the pie chart.
    for(var i=0; i<window.stats.length; ++i) {
        var data = [];
        var options = {};
        var type_stats = window.stats[i];

        // Calculates the total for the reports.
        var total = type_stats.reduce( function(value, item) {
            return value + Number(item.report_count)
        }, 0);
        console.log(total);

        for( var j=0; j<type_stats.length; ++j) {
            data.push({
                value: to_percent(type_stats[j].report_count, total),
                color: colors[j],
                label: type_stats[j].violation_type,
                highlight: colors[j]
            });
        }
        var chart_canvas = document.getElementById(i + "_canvas").getContext('2d');
        console.log(chart_canvas);
        var chart = new Chart(chart_canvas).Pie(data, options);
    }
}

init_stat_chart();
