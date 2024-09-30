<div class="container">
    <div class="row">
        <div class="input-section d-flex justify-content-end m-4">
            <div class="col-md-4">
                <select class="form-select p-2" name="" id="">
                    <option value="">Select Component</option>
                    <option value="users">Users</option>
                    <option value="activities">Activities</option>
                    <option value="departments">Departments</option>
                    <option value="employees">Employees</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6" id="user_chart_pie" style="height:400px;"></div>
        <div class="col-md-6" id="user_chart_cylinder" style="height:400px;"></div>
    </div>
    <div class="row">
        <div class="col-md-6" id="user_chart_area"></div>
        <div class="col-md-6" id="user_chart_radial"></div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        //chart one
        const chart_pie = Highcharts.chart('user_chart_pie', {
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
                                    '<strong>{{ $total_users }}</strong>'
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
                text: 'Registered Users'
            },
            credits: {
                enabled: false // Disable credits
            },
            subtitle: {
                text: 'Active & In-active'
                // text: 'Source: <a href="https://www.ssb.no/transport-og-reiseliv/faktaside/bil-og-transport">SSB</a>'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.0f}%</b>'
            },
            legend: {
                enabled: true
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
                innerSize: '70%',
                data: [{
                    name: 'Active',
                    y: 50
                }, {
                    name: 'In-active',
                    y: 12.0
                }, {
                    name: 'Deleted',
                    y: 30.0
                }, {
                    name: 'Pending',
                    y: 25.0
                }]
            }]
        });
        //chart two
        const chart_cylinder = Highcharts.chart('user_chart_cylinder', {
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
                text: 'Monthly User registrations'
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
        //chart three
        const chart_area = Highcharts.chart('user_chart_area', {
            chart: {
                type: 'area'
            },
            accessibility: {
                description: 'Image description: An area chart compares the nuclear ' +
                    'stockpiles of the USA and the USSR/Russia between 1945 and ' +
                    '2024. The number of nuclear weapons is plotted on the Y-axis ' +
                    'and the years on the X-axis. The chart is interactive, and the ' +
                    'year-on-year stockpile levels can be traced for each country. ' +
                    'The US has a stockpile of 2 nuclear weapons at the dawn of the ' +
                    'nuclear age in 1945. This number has gradually increased to 170 ' +
                    'by 1949 when the USSR enters the arms race with one weapon. At ' +
                    'this point, the US starts to rapidly build its stockpile ' +
                    'culminating in 31,255 warheads by 1966 compared to the USSR’s 8,' +
                    '400. From this peak in 1967, the US stockpile gradually ' +
                    'decreases as the USSR’s stockpile expands. By 1978 the USSR has ' +
                    'closed the nuclear gap at 25,393. The USSR stockpile continues ' +
                    'to grow until it reaches a peak of 40,159 in 1986 compared to ' +
                    'the US arsenal of 24,401. From 1986, the nuclear stockpiles of ' +
                    'both countries start to fall. By 2000, the numbers have fallen ' +
                    'to 10,577 and 12,188 for the US and Russia, respectively. The ' +
                    'decreases continue slowly after plateauing in the 2010s, and in ' +
                    '2024 the US has 3,708 weapons compared to Russia’s 4,380.'
            },
            title: {
                text: 'Gender of Users'
            },
            credits: {
                enabled: false // Disable credits
            },
            subtitle: {
                text: 'Source: <a href="https://fas.org/issues/nuclear-weapons/status-world-nuclear-forces/" ' +
                    'target="_blank">Gender</a>'
            },
            xAxis: {
                allowDecimals: false,
                accessibility: {
                    rangeDescription: 'Previous Month.'
                }
            },
            yAxis: {
                title: {
                    text: 'Current Month'
                }
            },
            tooltip: {
                pointFormat: '{series.name} had stockpiled <b>{point.y:,.0f}</b><br/>' +
                    'warheads in {point.x}'
            },
            plotOptions: {
                area: {
                    pointStart: 1940,
                    marker: {
                        enabled: false,
                        symbol: 'circle',
                        radius: 2,
                        states: {
                            hover: {
                                enabled: true
                            }
                        }
                    }
                }
            },
            series: [{
                name: 'USA',
                data: [
                    null, null, null, null, null, 2, 9, 13, 50, 170, 299, 438, 841,
                    1169, 1703, 2422, 3692, 5543, 7345, 12298, 18638, 22229, 25540,
                    28133, 29463, 31139, 31175, 31255, 29561, 27552, 26008, 25830,
                    26516, 27835, 28537, 27519, 25914, 25542, 24418, 24138, 24104,
                    23208, 22886, 23305, 23459, 23368, 23317, 23575, 23205, 22217,
                    21392, 19008, 13708, 11511, 10979, 10904, 11011, 10903, 10732,
                    10685, 10577, 10526, 10457, 10027, 8570, 8360, 7853, 5709, 5273,
                    5113, 5066, 4897, 4881, 4804, 4717, 4571, 4018, 3822, 3785, 3805,
                    3750, 3708, 3708, 3708, 3708
                ]
            }, {
                name: 'USSR/Russia',
                data: [
                    null, null, null, null, null, null, null, null, null,
                    1, 5, 25, 50, 120, 150, 200, 426, 660, 863, 1048, 1627, 2492,
                    3346, 4259, 5242, 6144, 7091, 8400, 9490, 10671, 11736, 13279,
                    14600, 15878, 17286, 19235, 22165, 24281, 26169, 28258, 30665,
                    32146, 33486, 35130, 36825, 38582, 40159, 38107, 36538, 35078,
                    32980, 29154, 26734, 24403, 21339, 18179, 15942, 15442, 14368,
                    13188, 12188, 11152, 10114, 9076, 8038, 7000, 6643, 6286, 5929,
                    5527, 5215, 4858, 4750, 4650, 4600, 4500, 4490, 4300, 4350, 4330,
                    4310, 4495, 4477, 4489, 4380
                ]
            }]
        });
        //chart four
        const chart_radial = Highcharts.chart('user_chart_radial', {
            colors: ['#FFD700', '#C0C0C0', '#CD7F32'],
            chart: {
                type: 'column',
                inverted: true,
                polar: true
            },
            title: {
                text: 'Ages of Users',
                align: 'center'
            },
            credits: {
                enabled: false // Disable credits
            },
            subtitle: {
                text: 'Source: ' +
                    '<a href="https://en.wikipedia.org/wiki/All-time_Olympic_Games_medal_table"' +
                    'target="_blank">Users ages</a>',
                align: 'left'
            },
            tooltip: {
                outside: true
            },
            pane: {
                size: '85%',
                innerSize: '20%',
                endAngle: 270
            },
            xAxis: {
                tickInterval: 1,
                labels: {
                    align: 'right',
                    useHTML: true,
                    allowOverlap: true,
                    step: 1,
                    y: 3,
                    style: {
                        fontSize: '13px'
                    }
                },
                lineWidth: 0,
                gridLineWidth: 0,
                categories: [
                    'Norway <span class="f16"><span id="flag" class="flag no">' +
                    '</span></span>',
                    'United States <span class="f16"><span id="flag" class="flag us">' +
                    '</span></span>',
                    'Germany <span class="f16"><span id="flag" class="flag de">' +
                    '</span></span>',
                    'Austria <span class="f16"><span id="flag" class="flag at">' +
                    '</span></span>',
                    'Canada <span class="f16"><span id="flag" class="flag ca">' +
                    '</span></span>'
                ]
            },
            yAxis: {
                lineWidth: 0,
                tickInterval: 25,
                reversedStacks: false,
                endOnTick: true,
                showLastLabel: true,
                gridLineWidth: 0
            },
            plotOptions: {
                column: {
                    stacking: 'normal',
                    borderWidth: 0,
                    pointPadding: 0,
                    groupPadding: 0.15,
                    borderRadius: '50%'
                }
            },
            series: [{
                name: 'Gold medals',
                data: [148, 113, 104, 71, 77]
            }, {
                name: 'Silver medals',
                data: [113, 122, 98, 88, 72]
            }, {
                name: 'Bronze medals',
                data: [124, 95, 65, 91, 76]
            }]
        });
    });
</script>
