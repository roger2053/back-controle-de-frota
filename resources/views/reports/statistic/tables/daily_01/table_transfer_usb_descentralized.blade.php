<?php

    $transports = ['Transfer USB-01', 'Transfer USB-RT-01', 'Transfer USB-02', 'Transfer USB-03', 'Transfer USB-04', 'Transfer USB-05', 'Transfer USB-06','Transfer USB-07', 'Transfer USB-08','Transfer USB-09'];
    $turns = ["extraNight", "morning", "afternoon", "night"];

    $total = [
        'Transfer USB-01' => 0, 
        'Transfer USB-RT-01' => 0, 
        'Transfer USB-02' => 0, 
        'Transfer USB-03'=> 0, 
        'Transfer USB-04'=> 0, 
        'Transfer USB-05'=> 0, 
        'Transfer USB-06' => 0, 
        'Transfer USB-07' => 0, 
        'Transfer USB-08' => 0, 
        'Transfer USB-09' => 0
    ];

    foreach($transports as $transport){
        foreach($turns as $turn){
            $total[$transport] += $report_global['report'][$transport][$turn];
        }
    }

?>

<br>
<table>
    <thead>
        <tr class="table-header">
            <th colspan="11">TRANSFERÊNCIAS USB POR BASE DESCENTRALIZADAS</th>
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
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>(00:00 AS 07:00 h)</td>
            <td>{{ $report_global['report']['Transfer USB-01']['extraNight'] }}</td>
            <td>{{ $report_global['report']['Transfer USB-RT-01']['extraNight'] }}</td>
            <td>{{ $report_global['report']['Transfer USB-02']['extraNight'] }}</td>
            <td>{{ $report_global['report']['Transfer USB-03']['extraNight'] }}</td>
            <td>{{ $report_global['report']['Transfer USB-04']['extraNight'] }}</td>
            <td>{{ $report_global['report']['Transfer USB-05']['extraNight'] }}</td>
            <td>{{ $report_global['report']['Transfer USB-06']['extraNight'] }}</td>
            <td>{{ $report_global['report']['Transfer USB-07']['extraNight'] }}</td>
            <td>{{ $report_global['report']['Transfer USB-08']['extraNight'] }}</td>
            <td>{{ $report_global['report']['Transfer USB-09']['extraNight'] }}</td>
        </tr>
        @include('reports.statistic.tables.daily_01.line_blank', ['label' => "", "cols" => 11])
        @include('reports.statistic.tables.daily_01.line_blank', ['label' => "MANHÃ", "cols" => 11])
        <tr>
            <td>(07:00 AS 13:00)</td>
            <td>{{ $report_global['report']['Transfer USB-01']['morning'] }}</td>
            <td>{{ $report_global['report']['Transfer USB-RT-01']['morning'] }}</td>
            <td>{{ $report_global['report']['Transfer USB-02']['morning'] }}</td>
            <td>{{ $report_global['report']['Transfer USB-03']['morning'] }}</td>
            <td>{{ $report_global['report']['Transfer USB-04']['morning'] }}</td>
            <td>{{ $report_global['report']['Transfer USB-05']['morning'] }}</td>
            <td>{{ $report_global['report']['Transfer USB-06']['morning'] }}</td>
            <td>{{ $report_global['report']['Transfer USB-07']['morning'] }}</td>
            <td>{{ $report_global['report']['Transfer USB-08']['morning'] }}</td>
            <td>{{ $report_global['report']['Transfer USB-09']['morning'] }}</td>
        </tr>
        @include('reports.statistic.tables.daily_01.line_blank', ['label' => "", "cols" => 11])
        @include('reports.statistic.tables.daily_01.line_blank', ['label' => "TARDE", "cols" => 11])
        <tr>
            <td>(13:00 AS 19:00)</td>
            <td>{{ $report_global['report']['Transfer USB-01']['afternoon'] }}</td>
            <td>{{ $report_global['report']['Transfer USB-RT-01']['afternoon'] }}</td>
            <td>{{ $report_global['report']['Transfer USB-02']['afternoon'] }}</td>
            <td>{{ $report_global['report']['Transfer USB-03']['afternoon'] }}</td>
            <td>{{ $report_global['report']['Transfer USB-04']['afternoon'] }}</td>
            <td>{{ $report_global['report']['Transfer USB-05']['afternoon'] }}</td>
            <td>{{ $report_global['report']['Transfer USB-06']['afternoon'] }}</td>
            <td>{{ $report_global['report']['Transfer USB-07']['afternoon'] }}</td>
            <td>{{ $report_global['report']['Transfer USB-08']['afternoon'] }}</td>
            <td>{{ $report_global['report']['Transfer USB-09']['afternoon'] }}</td>
        </tr>
        @include('reports.statistic.tables.daily_01.line_blank', ['label' => "", "cols" => 11])
        @include('reports.statistic.tables.daily_01.line_blank', ['label' => "NOITE", "cols" => 11])
        <tr>
            <td>(19:00 AS 00:00)</td>
            <td>{{ $report_global['report']['Transfer USB-01']['night'] }}</td>
            <td>{{ $report_global['report']['Transfer USB-RT-01']['night'] }}</td>
            <td>{{ $report_global['report']['Transfer USB-02']['night'] }}</td>
            <td>{{ $report_global['report']['Transfer USB-03']['night'] }}</td>
            <td>{{ $report_global['report']['Transfer USB-04']['night'] }}</td>
            <td>{{ $report_global['report']['Transfer USB-05']['night'] }}</td>
            <td>{{ $report_global['report']['Transfer USB-06']['night'] }}</td>
            <td>{{ $report_global['report']['Transfer USB-07']['night'] }}</td>
            <td>{{ $report_global['report']['Transfer USB-08']['night'] }}</td>
            <td>{{ $report_global['report']['Transfer USB-09']['night'] }}</td>
        </tr>
        @include('reports.statistic.tables.daily_01.line_blank', ['label' => "", "cols" => 11])
        <tr class="tab-line2">
            <td class="tab-color2"><b>TOTAL</b></td>
            <td>{{ $total['Transfer USB-01'] }}</td>
            <td>{{ $total['Transfer USB-RT-01'] }}</td>
            <td>{{ $total['Transfer USB-02'] }}</td>
            <td>{{ $total['Transfer USB-03'] }}</td>
            <td>{{ $total['Transfer USB-04'] }}</td>
            <td>{{ $total['Transfer USB-05'] }}</td>
            <td>{{ $total['Transfer USB-06'] }}</td>
            <td>{{ $total['Transfer USB-07'] }}</td>
            <td>{{ $total['Transfer USB-08'] }}</td>
            <td>{{ $total['Transfer USB-09'] }}</td>
        </tr>
        <!-- @include('reports.statistic.tables.daily_01.line_blank', ['label' => "", "cols" => 11]) -->
    </tbody>
</table>
