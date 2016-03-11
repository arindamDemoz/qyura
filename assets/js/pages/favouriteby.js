/*-- Date Picker --*/
$('#date-1').datepicker();

$('#date-2').datepicker();

$('.pickDate').datepicker()
    .on('changeDate', function (ev) {
        $('.pickDate').datepicker('hide');
    });


var hideKeyboard = function () {
    document.activeElement.blur();
    $(".pickDate").blur();
};

/* -- Revenue Generation Chart --*/

! function ($) {
    "use strict";

    var ChartJs = function () {};

    ChartJs.prototype.respChart = function respChart(selector, type, data, options) {
            // get selector by context
            var ctx = selector.get(0).getContext("2d");
            // pointing parent container to make chart js inherit its width
            var container = $(selector).parent();

            // enable resizing matter
            $(window).resize(generateChart);

            // this function produce the responsive Chart JS
            function generateChart() {
                // make chart width fit with its container
                var ww = selector.attr('width', $(container).width());
                switch (type) {
                case 'Line':
                    new Chart(ctx).Line(data, options);
                    break;
                case 'Doughnut':
                    new Chart(ctx).Doughnut(data, options);
                    break;
                case 'Pie':
                    new Chart(ctx).Pie(data, options);
                    break;
                case 'Bar':
                    new Chart(ctx).Bar(data, options);
                    break;
                case 'Radar':
                    new Chart(ctx).Radar(data, options);
                    break;
                case 'PolarArea':
                    new Chart(ctx).PolarArea(data, options);
                    break;
                }
                // Initiate new chart or Redraw

            };
            // run function - render chart at first load
            generateChart();
        },
        //init
        ChartJs.prototype.init = function () {

            //barchart
            var data3 = {
                labels: ["January", "February", "March", "April", "May", "June"],
                datasets: [
                    {
                        fillColor: "#6F8CD8",
                        strokeColor: "#6F8CD8",
                        data: [65, 59, 90, 81, 56, 55]
                        }
                    ]
            }
            this.respChart($("#like_trend"), 'Bar', data3);


        },
        $.ChartJs = new ChartJs, $.ChartJs.Constructor = ChartJs

}(window.jQuery),

//initializing 
function ($) {
    "use strict";
    $.ChartJs.init()
}(window.jQuery);