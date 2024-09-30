<div class="row">
    <div class="col-md-6" id="user_chart_one" style="height:400px;"></div>
    <div class="col-md-6" id="user_chart_two" style="height:400px;"></div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        //chart one
        const chart = Highcharts.chart('user_chart_one', {
            chart: {
                type: 'pie',
                custom: {},
                events: {
                    render() {
                        const chart = this,
                            series = chart.series[0];
                        let customLabel = chart.options.chart.custom.label;

                        if (!customLabel) {
                            customLabel = chart.options.chart.custom.label =
                                chart.renderer.label(
                                    'Total<br/>' +
                                    '<strong>2 877 820</strong>'
                                )
                                .css({
                                    color: '#000',
                                    textAnchor: 'middle'
                                })
                                .add();
                        }

                        const x = series.center[0] + chart.plotLeft,
                            y = series.center[1] + chart.plotTop -
                            (customLabel.attr('height') / 2);

                        customLabel.attr({
                            x,
                            y
                        });
                        // Set font size based on chart diameter
                        customLabel.css({
                            fontSize: `${series.center[2] / 12}px`
                        });
                    }
                }
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            title: {
                text: '2023 Norway car registrations'
            },
            credits: {
                enabled: false // Disable credits
            },
            subtitle: {
                text: 'Source: <a href="https://www.ssb.no/transport-og-reiseliv/faktaside/bil-og-transport">SSB</a>'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.0f}%</b>'
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    borderRadius: 8,
                    dataLabels: [{
                        enabled: true,
                        distance: 20,
                        format: '{point.name}'
                    }, {
                        enabled: true,
                        distance: -15,
                        format: '{point.percentage:.0f}%',
                        style: {
                            fontSize: '0.9em'
                        }
                    }],
                    showInLegend: true
                }
            },
            series: [{
                name: 'Registrations',
                colorByPoint: true,
                innerSize: '75%',
                data: [{
                    name: 'EV',
                    y: 23.9
                }, {
                    name: 'Hybrids',
                    y: 12.6
                }, {
                    name: 'Diesel',
                    y: 37.0
                }, {
                    name: 'Petrol',
                    y: 26.4
                }]
            }]
        });
        //chart two
        const chart2 = Highcharts.chart('user_chart_two', {
            chart: {
                type: 'cylinder',
                options3d: {
                    enabled: true,
                    alpha: 15,
                    beta: 15,
                    depth: 50,
                    viewDistance: 25
                }
            },
            title: {
                text: 'Number of confirmed COVID-19'
            },
            credits: {
                enabled: false // Disable credits
            },
            subtitle: {
                text: 'Source: ' +
                    '<a href="https://www.fhi.no/en/id/infectious-diseases/coronavirus/daily-reports/daily-reports-COVID19/"' +
                    'target="_blank">FHI</a>'
            },
            xAxis: {
                categories: [
                    '0-9', '10-19', '20-29', '30-39', '40-49', '50-59', '60-69',
                    '70-79', '80-89', '90+'
                ],
                title: {
                    text: 'Age groups'
                },
                labels: {
                    skew3d: true
                }
            },
            yAxis: {
                title: {
                    margin: 20,
                    text: 'Reported cases'
                },
                labels: {
                    skew3d: true
                }
            },
            tooltip: {
                headerFormat: '<b>Age: {point.x}</b><br>'
            },
            plotOptions: {
                series: {
                    depth: 25,
                    colorByPoint: true
                }
            },
            series: [{
                data: [
                    95321, 169339, 121105, 136046, 106800, 58041, 26766, 14291,
                    7065, 3283
                ],
                name: 'Cases',
                showInLegend: false
            }]
        });
    });
</script>
