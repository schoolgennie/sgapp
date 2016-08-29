var Charts = function () {
    //function to initiate jQRangeSlider
    //There are plenty of options you can set to control the precise looks of your plot. 
    //You can control the ticks on the axes, the legend, the graph type, etc.
    //For more information, please visit http://www.flotcharts.org/
    var runCharts = function () {
           // Toggling Series 
      
        // hard-code color indices to prevent them from shifting as
        // countries are turned on/off
        var i = 0;
        $.each(datasets, function (key, val) {
            val.color = i;
            ++i;
        });
        // insert checkboxes
        var choiceContainer = $("#choices");
        $.each(datasets, function (key, val) {
            choiceContainer.append("<label for='id" + key + "' class='checkbox'><input type='checkbox' name='" + key + "' checked='checked' id='id" + key + "'>" + val.label + "</label>");
        });
        choiceContainer.find("input").iCheck({
            checkboxClass: 'icheckbox_minimal-grey',
            radioClass: 'iradio_minimal-grey',
            increaseArea: '10%' // optional
        }).on('ifClicked', function (event) {
            $(this).iCheck('toggle');
            plotAccordingToChoices();
        });

        function plotAccordingToChoices() {
            var data = [];
            choiceContainer.find("input:checked").each(function () {
                var key = $(this).attr("name");
                if (key && datasets[key]) {
                    data.push(datasets[key]);
                }
            });
            if (data.length > 0) {
                $.plot("#placeholder2", data, {
                    yaxis: {
                        min: 0
                    },
                    xaxis: {
                        tickDecimals: 0
                    }
                });
            }
        }
        plotAccordingToChoices();
      
     

        function labelFormatter(label, series) {
            return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
        }
    };
    return {
        //main function to initiate template pages
        init: function () {
            runCharts();
        }
    };
}();