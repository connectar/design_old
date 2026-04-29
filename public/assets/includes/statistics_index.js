$(function () {

    'use strict';
    var chart = AmCharts.makeChart("chartdiv31", {
        "type": "serial",
        "theme": "light",
        "dataProvider": [{
            "name": "محمود",
            "points": 46000,
            "color": "#7F8DA9",
            "bullet": "https://www.amcharts.com/lib/images/faces/A04.png"
        }, {
            "name": "Damon",
            "points": 40000,
            "color": "#FEC514",
            "bullet": "https://www.amcharts.com/lib/images/faces/C02.png"
        }, {
            "name": "Patrick",
            "points": 45724,
            "color": "#DB4C3C",
            "bullet": "https://www.amcharts.com/lib/images/faces/D02.png"
        }, {
            "name": "Mark",
            "points": 13654,
            "color": "#DAF0FD",
            "bullet": "https://www.amcharts.com/lib/images/faces/E01.png"
        }],
        "valueAxes": [{
            "maximum": 50000,
            "minimum": 0,
            "axisAlpha": 0,
            "dashLength": 4,
            "position": "left"
        }],
        "startDuration": 1,
        "graphs": [{
            "balloonText": "<span style='font-size:13px;'>[[category]]: <b>[[value]]</b></span>",
            "bulletOffset": 10,
            "bulletSize": 52,
            "colorField": "color",
            "cornerRadiusTop": 8,
            "customBulletField": "bullet",
            "fillAlphas": 0.8,
            "lineAlpha": 0,
            "type": "column",
            "valueField": "points"
        }],
        "marginTop": 0,
        "marginRight": 0,
        "marginLeft": 30,
        "marginBottom": 0,
        "autoMargins": true,
        "categoryField": "name",
        "categoryAxis": {
            "axisAlpha": 0,
            "gridAlpha": 0,
            "inside": true,
            "tickLength": 0
        },
        "export": {
            "enabled": false
        }
    });

    /*
     * Flot Interactive Chart
     * -----------------------
     */
    // We use an inline data source in the example, usually data would
    // be fetched from a server
    var data = [],
        totalPoints = 1000

    function getRandomData() {

        if (data.length > 0)
            data = data.slice(1)

        // Do a random walk
        while (data.length < totalPoints) {

            var prev = data.length > 0 ? data[data.length - 1] : 50,
                y = prev + Math.random() * 10 - 5

            if (y < 0) {
                y = 0
            } else if (y > 200) {
                y = 200
            }

            data.push(y)
        }

        // Zip the generated y values with the x values
        var res = []
        for (var i = 0; i < data.length; ++i) {
            res.push([i, data[i]])
        }

        return res
    }

    var interactive_plot = $.plot('#interactive', [getRandomData()], {
        grid: {
            color: "#AFAFAF",
            hoverable: true,
            borderWidth: 0,
            backgroundColor: 'rgba(255, 255, 255, 0)'
        },
        series: {
            shadowSize: 0, // Drawing is faster without shadows
            color: '#689f38'
        },
        tooltip: true,
        lines: {
            fill: false, //Converts the line chart to area chart
            color: '#689f38'
        },
        tooltipOpts: {
            content: "Visit: %y",
            defaultTheme: false
        },
        yaxis: {
            min: 0,
            max: 200,
            show: true
        },
        xaxis: {
            show: true
        }
    })

    var updateInterval = 30 //Fetch data ever x milliseconds
    var realtime = 'on' //If == to on then fetch data every x seconds. else stop fetching
    function update() {

        interactive_plot.setData([getRandomData()])

        // Since the axes don't change, we don't need to call plot.setupGrid()
        interactive_plot.draw()
        if (realtime === 'on')
            setTimeout(update, updateInterval)
    }
    //INITIALIZE REALTIME DATA FETCHING
    if (realtime === 'on') {
        update()
    }
    /*
     * END INTERACTIVE CHART
     */
    //sparkline chart
    $("#sparkline0").sparkline([1, 4, 8, 4, 6, 8, 5, 7, 2, 7, 4, 1], {
        type: 'line',
        width: '100%',
        height: '80',
        lineColor: '#e739a5',
        fillColor: '#e739a573',
        minSpotColor: '#e0bc00',
        maxSpotColor: '#e0bc00',
        highlightLineColor: 'rgba(0, 0, 0, 0.2)',
        highlightSpotColor: '#4f4f4f'
    });
    $("#sparkline1").sparkline([1, 2, 3, 4, 3, 6, 3, 5, 3, 8, 4, 2], {
        type: 'line',
        width: '100%',
        height: '80',
        lineColor: '#FF0066',
        fillColor: '#FF00667d',
        minSpotColor: '#FF0066',
        maxSpotColor: '#FF0066',
        highlightLineColor: 'rgba(0, 0, 0, 0.2)',
        highlightSpotColor: '#FF0066'
    });
    $("#sparkline2").sparkline([0, 3, 6, 3, 4, 2, 6, 1, 8, 4, 4, 2], {
        type: 'line',
        width: '100%',
        height: '80',
        lineColor: '#2575fc',
        fillColor: '#2575fc94',
        minSpotColor: '#2575fc',
        maxSpotColor: '#2575fc',
        highlightLineColor: 'rgba(0, 0, 0, 0.2)',
        highlightSpotColor: '#2575fc'
    });
    $("#sparkline3").sparkline([2, 4, 7, 3, 5, 3, 6, 3, 4, 3, 2, 1, 2], {
        type: 'line',
        width: '100%',
        height: '80',
        lineColor: '#f9d423',
        fillColor: '#f9d4235c',
        minSpotColor: '#f9d423',
        maxSpotColor: '#f9d423',
        highlightLineColor: 'rgba(0, 0, 0, 0.2)',
        highlightSpotColor: '#f9d423'
    });

    /* jQueryKnob */

    $(".knob").knob({
        /*change : function (value) {
         //console.log("change : " + value);
         },
         release : function (value) {
         console.log("release : " + value);
         },
         cancel : function () {
         console.log("cancel : " + this.value);
         },*/
        draw: function () {

            // "tron" case
            if (this.$.data('skin') == 'tron') {

                var a = this.angle(this.cv) // Angle
                    ,
                    sa = this.startAngle // Previous start angle
                    ,
                    sat = this.startAngle // Start angle
                    ,
                    ea // Previous end angle
                    , eat = sat + a // End angle
                    ,
                    r = true;

                this.g.lineWidth = this.lineWidth;

                this.o.cursor &&
                    (sat = eat - 0.3) &&
                    (eat = eat + 0.3);

                if (this.o.displayPrevious) {
                    ea = this.startAngle + this.angle(this.value);
                    this.o.cursor &&
                        (sa = ea - 0.3) &&
                        (ea = ea + 0.3);
                    this.g.beginPath();
                    this.g.strokeStyle = this.previousColor;
                    this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
                    this.g.stroke();
                }

                this.g.beginPath();
                this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
                this.g.stroke();

                this.g.lineWidth = 2;
                this.g.beginPath();
                this.g.strokeStyle = this.o.fgColor;
                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                this.g.stroke();

                return false;
            }
        }
    });
    /* END JQUERY KNOB */

});
