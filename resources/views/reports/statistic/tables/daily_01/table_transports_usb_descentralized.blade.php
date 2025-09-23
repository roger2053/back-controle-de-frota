<?php

$transports = [
    'Transport USB-01',
    'Transport USB-RT-01',
    'Transport USB-02',
    'Transport USB-03',
    'Transport USB-04',
    'Transport USB-05',
    'Transport USB-06',
    'Transport USB-07',
    'Transport USB-08',
    'Transport USB-09',
    'Transport USB-10',
    'Transport USB-11'
];
$turns = ["extraNight", "morning", "afternoon", "night"];

$total = [
    'Transport USB-01' => 0,
    'Transport USB-RT-01' => 0,
    'Transport USB-02' => 0,
    'Transport USB-03' => 0,
    'Transport USB-04' => 0,
    'Transport USB-05' => 0,
    'Transport USB-06' => 0,
    'Transport USB-07' => 0,
    'Transport USB-08' => 0,
    'Transport USB-09' => 0,
    'Transport USB-10' => 0,
    'Transport USB-11' => 0,
];

foreach ($transports as $transport) {
    foreach ($turns as $turn) {
        $total[$transport] += $report_global['report'][$transport][$turn];
    }
}

?>

<br>
<table>
    <thead>
        <tr class="table-header">
            <th colspan="13">TRANSPORTES USB POR BASE DESCENTRALIZADAS</th>
        </tr>
        <tr class="tab-line">
            <th>EXTRA NOITE</th>
            <th>USB 01</th>
            <th>USB RT</th>
            <th>USB 02</th>
            <th>USB 03</th>
            <th>USB 04</th>
            <th>USB 05</th>
            <th>USB 06</th>
            <th>USB 07</th>
            <th>USB 08</th>
            <th>USB 09</th>
            <th>USB 10</th>
            <th>USB 11</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>(00:00 AS 07:00 h)</td>
            <td>{{ $report_global['report']['Transport USB-01']['extraNight'] }}</td>
            <td>{{ $report_global['report']['Transport USB-RT-01']['extraNight'] }}</td>
            <td>{{ $report_global['report']['Transport USB-02']['extraNight'] }}</td>
            <td>{{ $report_global['report']['Transport USB-03']['extraNight'] }}</td>
            <td>{{ $report_global['report']['Transport USB-04']['extraNight'] }}</td>
            <td>{{ $report_global['report']['Transport USB-05']['extraNight'] }}</td>
            <td>{{ $report_global['report']['Transport USB-06']['extraNight'] }}</td>
            <td>{{ $report_global['report']['Transport USB-07']['extraNight'] }}</td>
            <td>{{ $report_global['report']['Transport USB-08']['extraNight'] }}</td>
            <td>{{ $report_global['report']['Transport USB-09']['extraNight'] }}</td>
            <td>{{ $report_global['report']['Transport USB-10']['extraNight'] }}</td>
            <td>{{ $report_global['report']['Transport USB-11']['extraNight'] }}</td>
        </tr>
        @include('reports.statistic.tables.daily_01.line_blank', ['label' => "", "cols" => 13])
        @include('reports.statistic.tables.daily_01.line_blank', ['label' => "MANHÃ", "cols" => 13])
        <tr>
            <td>(07:00 AS 13:00)</td>
            <td>{{ $report_global['report']['Transport USB-01']['morning'] }}</td>
            <td>{{ $report_global['report']['Transport USB-RT-01']['morning'] }}</td>
            <td>{{ $report_global['report']['Transport USB-02']['morning'] }}</td>
            <td>{{ $report_global['report']['Transport USB-03']['morning'] }}</td>
            <td>{{ $report_global['report']['Transport USB-04']['morning'] }}</td>
            <td>{{ $report_global['report']['Transport USB-05']['morning'] }}</td>
            <td>{{ $report_global['report']['Transport USB-06']['morning'] }}</td>
            <td>{{ $report_global['report']['Transport USB-07']['morning'] }}</td>
            <td>{{ $report_global['report']['Transport USB-08']['morning'] }}</td>
            <td>{{ $report_global['report']['Transport USB-09']['morning'] }}</td>
            <td>{{ $report_global['report']['Transport USB-10']['morning'] }}</td>
            <td>{{ $report_global['report']['Transport USB-11']['morning'] }}</td>
        </tr>
        @include('reports.statistic.tables.daily_01.line_blank', ['label' => "", "cols" => 13])
        @include('reports.statistic.tables.daily_01.line_blank', ['label' => "TARDE", "cols" => 13])
        <tr>
            <td>(13:00 AS 19:00)</td>
            <td>{{ $report_global['report']['Transport USB-01']['afternoon'] }}</td>
            <td>{{ $report_global['report']['Transport USB-RT-01']['afternoon'] }}</td>
            <td>{{ $report_global['report']['Transport USB-02']['afternoon'] }}</td>
            <td>{{ $report_global['report']['Transport USB-03']['afternoon'] }}</td>
            <td>{{ $report_global['report']['Transport USB-04']['afternoon'] }}</td>
            <td>{{ $report_global['report']['Transport USB-05']['afternoon'] }}</td>
            <td>{{ $report_global['report']['Transport USB-06']['afternoon'] }}</td>
            <td>{{ $report_global['report']['Transport USB-07']['afternoon'] }}</td>
            <td>{{ $report_global['report']['Transport USB-08']['afternoon'] }}</td>
            <td>{{ $report_global['report']['Transport USB-09']['afternoon'] }}</td>
            <td>{{ $report_global['report']['Transport USB-10']['afternoon'] }}</td>
            <td>{{ $report_global['report']['Transport USB-11']['afternoon'] }}</td>
        </tr>
        @include('reports.statistic.tables.daily_01.line_blank', ['label' => "", "cols" => 13])
        @include('reports.statistic.tables.daily_01.line_blank', ['label' => "NOITE", "cols" => 13])
        <tr>
            <td>(19:00 AS 00:00)</td>
            <td>{{ $report_global['report']['Transport USB-01']['night'] }}</td>
            <td>{{ $report_global['report']['Transport USB-RT-01']['night'] }}</td>
            <td>{{ $report_global['report']['Transport USB-02']['night'] }}</td>
            <td>{{ $report_global['report']['Transport USB-03']['night'] }}</td>
            <td>{{ $report_global['report']['Transport USB-04']['night'] }}</td>
            <td>{{ $report_global['report']['Transport USB-05']['night'] }}</td>
            <td>{{ $report_global['report']['Transport USB-06']['night'] }}</td>
            <td>{{ $report_global['report']['Transport USB-07']['night'] }}</td>
            <td>{{ $report_global['report']['Transport USB-08']['night'] }}</td>
            <td>{{ $report_global['report']['Transport USB-09']['night'] }}</td>
            <td>{{ $report_global['report']['Transport USB-10']['night'] }}</td>
            <td>{{ $report_global['report']['Transport USB-11']['night'] }}</td>
        </tr>
        @include('reports.statistic.tables.daily_01.line_blank', ['label' => "", "cols" => 13])
        <tr class="tab-line2">
            <td class="tab-color2"><b>TOTAL</b></td>
            <td>{{ $total['Transport USB-01'] }}</td>
            <td>{{ $total['Transport USB-RT-01'] }}</td>
            <td>{{ $total['Transport USB-02'] }}</td>
            <td>{{ $total['Transport USB-03'] }}</td>
            <td>{{ $total['Transport USB-04'] }}</td>
            <td>{{ $total['Transport USB-05'] }}</td>
            <td>{{ $total['Transport USB-06'] }}</td>
            <td>{{ $total['Transport USB-07'] }}</td>
            <td>{{ $total['Transport USB-08'] }}</td>
            <td>{{ $total['Transport USB-09'] }}</td>
            <td>{{ $total['Transport USB-10'] }}</td>
            <td>{{ $total['Transport USB-11'] }}</td>
        </tr>
        <!-- @include('reports.statistic.tables.daily_01.line_blank', ['label' => "", "cols" => 11]) -->
    </tbody>
</table>