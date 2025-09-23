<?php

$transports = [
    'Attendance USB-01',
    'Attendance USB-RT-01',
    'Attendance USB-02',
    'Attendance USB-03',
    'Attendance USB-04',
    'Attendance USB-05',
    'Attendance USB-06',
    'Attendance USB-07',
    'Attendance USB-08',
    'Attendance USB-09',
    'Attendance USB-10',
    'Attendance USB-11',
];
$turns = ["extraNight", "morning", "afternoon", "night"];

$total = [
    'Attendance USB-01' => 0,
    'Attendance USB-RT-01' => 0,
    'Attendance USB-02' => 0,
    'Attendance USB-03' => 0,
    'Attendance USB-04' => 0,
    'Attendance USB-05' => 0,
    'Attendance USB-06' => 0,
    'Attendance USB-07' => 0,
    'Attendance USB-08' => 0,
    'Attendance USB-09' => 0,
    'Attendance USB-10' => 0,
    'Attendance USB-11' => 0,
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
            <th colspan="13">ATENDIMENTOS USB POR BASE DESCENTRALIZADAS</th>
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
            <td>{{ $report_global['report']['Attendance USB-01']['extraNight'] }}</td>
            <td>{{ $report_global['report']['Attendance USB-RT-01']['extraNight'] }}</td>
            <td>{{ $report_global['report']['Attendance USB-02']['extraNight'] }}</td>
            <td>{{ $report_global['report']['Attendance USB-03']['extraNight'] }}</td>
            <td>{{ $report_global['report']['Attendance USB-04']['extraNight'] }}</td>
            <td>{{ $report_global['report']['Attendance USB-05']['extraNight'] }}</td>
            <td>{{ $report_global['report']['Attendance USB-06']['extraNight'] }}</td>
            <td>{{ $report_global['report']['Attendance USB-07']['extraNight'] }}</td>
            <td>{{ $report_global['report']['Attendance USB-08']['extraNight'] }}</td>
            <td>{{ $report_global['report']['Attendance USB-09']['extraNight'] }}</td>
            <td>{{ $report_global['report']['Attendance USB-10']['extraNight'] }}</td>
            <td>{{ $report_global['report']['Attendance USB-11']['extraNight'] }}</td>
        </tr>
        @include('reports.statistic.tables.daily_01.line_blank', ['label' => "", "cols" => 13])
        @include('reports.statistic.tables.daily_01.line_blank', ['label' => "MANHÃ", "cols" => 13])
        <tr>
            <td>(07:00 AS 13:00)</td>
            <td>{{ $report_global['report']['Attendance USB-01']['morning'] }}</td>
            <td>{{ $report_global['report']['Attendance USB-RT-01']['morning'] }}</td>
            <td>{{ $report_global['report']['Attendance USB-02']['morning'] }}</td>
            <td>{{ $report_global['report']['Attendance USB-03']['morning'] }}</td>
            <td>{{ $report_global['report']['Attendance USB-04']['morning'] }}</td>
            <td>{{ $report_global['report']['Attendance USB-05']['morning'] }}</td>
            <td>{{ $report_global['report']['Attendance USB-06']['morning'] }}</td>
            <td>{{ $report_global['report']['Attendance USB-07']['morning'] }}</td>
            <td>{{ $report_global['report']['Attendance USB-08']['morning'] }}</td>
            <td>{{ $report_global['report']['Attendance USB-09']['morning'] }}</td>
            <td>{{ $report_global['report']['Attendance USB-10']['morning'] }}</td>
            <td>{{ $report_global['report']['Attendance USB-11']['morning'] }}</td>
        </tr>
        @include('reports.statistic.tables.daily_01.line_blank', ['label' => "", "cols" => 13])
        @include('reports.statistic.tables.daily_01.line_blank', ['label' => "TARDE", "cols" => 13])
        <tr>
            <td>(13:00 AS 19:00)</td>
            <td>{{ $report_global['report']['Attendance USB-01']['afternoon'] }}</td>
            <td>{{ $report_global['report']['Attendance USB-RT-01']['afternoon'] }}</td>
            <td>{{ $report_global['report']['Attendance USB-02']['afternoon'] }}</td>
            <td>{{ $report_global['report']['Attendance USB-03']['afternoon'] }}</td>
            <td>{{ $report_global['report']['Attendance USB-04']['afternoon'] }}</td>
            <td>{{ $report_global['report']['Attendance USB-05']['afternoon'] }}</td>
            <td>{{ $report_global['report']['Attendance USB-06']['afternoon'] }}</td>
            <td>{{ $report_global['report']['Attendance USB-07']['afternoon'] }}</td>
            <td>{{ $report_global['report']['Attendance USB-08']['afternoon'] }}</td>
            <td>{{ $report_global['report']['Attendance USB-09']['afternoon'] }}</td>
            <td>{{ $report_global['report']['Attendance USB-10']['afternoon'] }}</td>
            <td>{{ $report_global['report']['Attendance USB-11']['afternoon'] }}</td>
        </tr>
        @include('reports.statistic.tables.daily_01.line_blank', ['label' => "", "cols" => 13])
        @include('reports.statistic.tables.daily_01.line_blank', ['label' => "NOITE", "cols" => 13])
        <tr>
            <td>(19:00 AS 00:00)</td>
            <td>{{ $report_global['report']['Attendance USB-01']['night'] }}</td>
            <td>{{ $report_global['report']['Attendance USB-RT-01']['night'] }}</td>
            <td>{{ $report_global['report']['Attendance USB-02']['night'] }}</td>
            <td>{{ $report_global['report']['Attendance USB-03']['night'] }}</td>
            <td>{{ $report_global['report']['Attendance USB-04']['night'] }}</td>
            <td>{{ $report_global['report']['Attendance USB-05']['night'] }}</td>
            <td>{{ $report_global['report']['Attendance USB-06']['night'] }}</td>
            <td>{{ $report_global['report']['Attendance USB-07']['night'] }}</td>
            <td>{{ $report_global['report']['Attendance USB-08']['night'] }}</td>
            <td>{{ $report_global['report']['Attendance USB-09']['night'] }}</td>
            <td>{{ $report_global['report']['Attendance USB-10']['night'] }}</td>
            <td>{{ $report_global['report']['Attendance USB-11']['night'] }}</td>
        </tr>
        @include('reports.statistic.tables.daily_01.line_blank', ['label' => "", "cols" => 13])
        <tr class="tab-line2">
            <td class="tab-color2"><b>TOTAL</b></td>
            <td>{{ $total['Attendance USB-01'] }}</td>
            <td>{{ $total['Attendance USB-RT-01'] }}</td>
            <td>{{ $total['Attendance USB-02'] }}</td>
            <td>{{ $total['Attendance USB-03'] }}</td>
            <td>{{ $total['Attendance USB-04'] }}</td>
            <td>{{ $total['Attendance USB-05'] }}</td>
            <td>{{ $total['Attendance USB-06'] }}</td>
            <td>{{ $total['Attendance USB-07'] }}</td>
            <td>{{ $total['Attendance USB-08'] }}</td>
            <td>{{ $total['Attendance USB-09'] }}</td>
            <td>{{ $total['Attendance USB-10'] }}</td>
            <td>{{ $total['Attendance USB-11'] }}</td>
        </tr>
        <!-- @include('reports.statistic.tables.daily_01.line_blank', ['label' => "", "cols" => 11]) -->
    </tbody>
</table>