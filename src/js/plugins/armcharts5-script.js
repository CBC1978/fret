am5.ready(function () {
    // Create root element
    // https://www.amcharts.com/docs/v5/getting-started/#Root_element
    var root = am5.Root.new("chartdiv");
    root._logo.dispose();

    // Set themes
    // https://www.amcharts.com/docs/v5/concepts/themes/
    root.setThemes([am5themes_Animated.new(root)]);

    // Create chart
    // https://www.amcharts.com/docs/v5/charts/xy-chart/
    var chart = root.container.children.push(
        am5xy.XYChart.new(root, {
            panX: false,
            panY: false,
            layout: root.verticalLayout,
            pinchZoomX: false
        })
    );

    // Add cursor
    // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
    var cursor = chart.set(
        "cursor",
        am5xy.XYCursor.new(root, {
            behavior: "none"
        })
    );
    cursor.lineY.set("visible", false);

    // The data
    var data = [
        {
            month: "01",
            offres: 60,
            postulés: 50,
            Contrat: 12
        },
        {
            month: "02",
            offres: 40,
            postulés: 60,
            Contrat: 20
        },
        {
            month: "03",
            offres: 50,
            postulés: 70,
            Contrat: 30
        },
        {
            month: "04",
            offres: 70,
            postulés: 70,
            Contrat: 40
        },
        {
            month: "05",
            offres: 77,
            postulés: 80,
            Contrat: 11
        },
        {
            month: "06",
            offres: 90,
            postulés:80,
            Contrat: 20
        },
        {
            month: "07",
            offres: 90,
            postulés: 80,
            Contrat: 19
        },
        {
            month: "08",
            offres: 15,
            postulés: 115,
            Contrat: 11
        },
        {
            month: "09",
            offres: 82,
            postulés: 75,
            Contrat: 71
        },
        {
            month: "10",
            offres: 81,
            postulés: 15,
            Contrat: 81
        },
        {
            month: "11",
            offres: 81,
            postulés: 75,
            Contrat: 21
        },
        {
            month: "12",
            offres: 50,
            postulés: 65,
            Contrat: 51
        }
    ];

    // Create axes
    // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
    var xAxis = chart.xAxes.push(
        am5xy.CategoryAxis.new(root, {
            categoryField: "month",
            startLocation: 0,
            endLocation: 0,
            renderer: am5xy.AxisRendererX.new(root, {}),
            tooltip: am5.Tooltip.new(root, {})
        })
    );

    xAxis.data.setAll(data);

    var yAxis = chart.yAxes.push(
        am5xy.ValueAxis.new(root, {
            calculateTotals: true,
            type: "value",
            numberFormat: "#",
            renderer: am5xy.AxisRendererY.new(root, {})
        })
    );

    // Add series
    // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
    function createSeries(name, field, color) {
        var series = chart.series.push(
            am5xy.LineSeries.new(root, {
                name: name,
                stacked: true,
                hideCredits: false,
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: field,
                categoryXField: "month",
                strokeDasharray: 1,
                strokeDashoffset: 1,
                legendValueText: "{valueY}",
                tooltip: am5.Tooltip.new(root, {
                    pointerOrientation: "horizontal",
                    labelText: "[bold]{name}[/]\n{categoryX}: {valueY.formatNumber('#')}"
                })
            })
        );

        series.fills.template.setAll({
            fillOpacity: 0.5,
            fill: color,
            visible: true
        });
        series.bullets.push(function (root) {
            return am5.Bullet.new(root, {
                sprite: am5.Circle.new(root, {
                    radius: 4,
                    fill: "#ffffff",
                    stroke: color
                })
            });
        });
        series.data.setAll(data);
        series.appear(1000);
    }

    createSeries("Contrat", "Contrat", "#3AAB67");
    createSeries("offres", "offres", "#F58A3C");
    createSeries("postulés", "postulés", "#3C65F5");
    // Add legend
    // https://www.amcharts.com/docs/v5/charts/xy-chart/legend-xy-series/
    var legend = chart.children.push(
        am5.Legend.new(root, {
            // centerX: am5.p50,
            x: 30,
            y: am5.percent(97)
        })
    );

    legend.data.setAll(chart.series.values);

    // Make stuff animate on load
    // https://www.amcharts.com/docs/v5/concepts/animations/
    chart.appear(1000, 100);
}); // end am5.ready()
