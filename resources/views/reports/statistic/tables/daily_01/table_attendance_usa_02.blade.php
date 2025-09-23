<?php
$totalAttendanceUsa02 = [
    1 => 0,
    2 => 0,
    3 => 0,
    4 => 0,
    5 => 0,
    6 => 0,
    7 => 0,
    8 => 0,
    9 => 0,
    10 => 0,
];

$turns = ['morning', 'afternoon', 'night', 'extraNight'];

// Calculando os totais

foreach ($totalAttendanceUsa02 as $key => $value) {
    foreach ($turns as $turn) {
        $totalAttendanceUsa02[$key] += $report_bases_turn[$turn][$key]['attendance']['USA-02'];
    }
}
?>

<br>
<table>
    <thead>
        <tr class="table-header">
            <th colspan="11">ATENDIMENTOS USA 02</th>
        </tr>
        <tr class="tab-line">
            <th>EXTRA NOITE</th>
            <th>SR. DO BONFIM</th>
            <th>PINDOBAÇU</th>
            <th>CAMPO FORMOSO</th>
            <th>PONTO NOVO</th>
            <th>ITIUBA</th>
            <th>JAGUARARI</th>
            <th>ANDORINHA</th>
            <th>ANTONIO GONÇALVES</th>
            <th>FILADELFIA</th>
            <th>PILAR</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>(00:00 AS 07:00 h)</td>
            <td>{{ $report_bases_turn['extraNight'][1]['attendance']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['extraNight'][2]['attendance']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['extraNight'][3]['attendance']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['extraNight'][4]['attendance']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['extraNight'][5]['attendance']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['extraNight'][6]['attendance']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['extraNight'][7]['attendance']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['extraNight'][8]['attendance']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['extraNight'][9]['attendance']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['extraNight'][10]['attendance']['USA-02'] }}</td>
        </tr>
        @include('reports.statistic.tables.daily_01.line_blank', ['label' => "", "cols" => 11])
        @include('reports.statistic.tables.daily_01.line_blank', ['label' => "MANHÃ", "cols" => 11])
        <tr>
            <td>(07:00 AS 13:00)</td>
            <td>{{ $report_bases_turn['morning'][1]['attendance']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['morning'][2]['attendance']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['morning'][3]['attendance']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['morning'][4]['attendance']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['morning'][5]['attendance']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['morning'][6]['attendance']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['morning'][7]['attendance']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['morning'][8]['attendance']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['morning'][9]['attendance']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['morning'][10]['attendance']['USA-02'] }}</td>
        </tr>
        @include('reports.statistic.tables.daily_01.line_blank', ['label' => "", "cols" => 11])
        @include('reports.statistic.tables.daily_01.line_blank', ['label' => "TARDE", "cols" => 11])
        <tr>
            <td>(13:00 AS 19:00)</td>
            <td>{{ $report_bases_turn['afternoon'][1]['attendance']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['afternoon'][2]['attendance']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['afternoon'][3]['attendance']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['afternoon'][4]['attendance']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['afternoon'][5]['attendance']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['afternoon'][6]['attendance']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['afternoon'][7]['attendance']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['afternoon'][8]['attendance']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['afternoon'][9]['attendance']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['afternoon'][10]['attendance']['USA-02'] }}</td>
        </tr>
        @include('reports.statistic.tables.daily_01.line_blank', ['label' => "", "cols" => 11])
        @include('reports.statistic.tables.daily_01.line_blank', ['label' => "NOITE", "cols" => 11])
        <tr>
            <td>(19:00 AS 00:00)</td>
            <td>{{ $report_bases_turn['night'][1]['attendance']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['night'][2]['attendance']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['night'][3]['attendance']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['night'][4]['attendance']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['night'][5]['attendance']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['night'][6]['attendance']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['night'][7]['attendance']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['night'][8]['attendance']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['night'][9]['attendance']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['night'][10]['attendance']['USA-02'] }}</td>
        </tr>
        @include('reports.statistic.tables.daily_01.line_blank', ['label' => "", "cols" => 11])
        <tr class="tab-line2">
            <td class="tab-color2"><b>TOTAL</b></td>
            <td>{{ $totalAttendanceUsa02[1] }}</td>
            <td>{{ $totalAttendanceUsa02[2] }}</td>
            <td>{{ $totalAttendanceUsa02[3] }}</td>
            <td>{{ $totalAttendanceUsa02[4] }}</td>
            <td>{{ $totalAttendanceUsa02[5] }}</td>
            <td>{{ $totalAttendanceUsa02[6] }}</td>
            <td>{{ $totalAttendanceUsa02[7] }}</td>
            <td>{{ $totalAttendanceUsa02[8] }}</td>
            <td>{{ $totalAttendanceUsa02[9] }}</td>
            <td>{{ $totalAttendanceUsa02[10] }}</td>
        </tr>
    </tbody>
</table>