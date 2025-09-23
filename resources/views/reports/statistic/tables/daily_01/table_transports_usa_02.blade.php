<?php 
    $totalTransportsUsa02 = [
        6 => 0,
        2 => 0,
        3 => 0,
        9 => 0,
        7 => 0,
        4 => 0,
        5 => 0,
        10 => 0,
        8 => 0
    ]; 

    $turns = ['morning', 'afternoon', 'night', 'extraNight'];

    // Calculando os totais

    foreach($totalTransportsUsa02 as $key => $value){
        foreach($turns as $turn){
            $totalTransportsUsa02[$key] += $report_bases_turn[$turn][$key]['transport']['USA-02'];
        }
    }
?>

<br>
<table>
    <thead>
        <tr class="table-header">
            <th colspan="10">TRANSPORTES USA 02</th>
        </tr>
        <tr class="tab-line">
            <th >EXTRA NOITE</th>
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
            <td>{{ $report_bases_turn['extraNight'][2]['transport']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['extraNight'][3]['transport']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['extraNight'][4]['transport']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['extraNight'][5]['transport']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['extraNight'][6]['transport']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['extraNight'][7]['transport']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['extraNight'][10]['transport']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['extraNight'][9]['transport']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['extraNight'][8]['transport']['USA-02'] }}</td>
        </tr>
        @include('reports.statistic.tables.daily_01.line_blank', ['label' => "", "cols" => 10])
        @include('reports.statistic.tables.daily_01.line_blank', ['label' => "MANHÃ", "cols" => 10])
        <tr>
            <td>(07:00 AS 13:00)</td>
            <td>{{ $report_bases_turn['morning'][2]['transport']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['morning'][3]['transport']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['morning'][4]['transport']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['morning'][5]['transport']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['morning'][6]['transport']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['morning'][7]['transport']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['morning'][10]['transport']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['morning'][9]['transport']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['morning'][8]['transport']['USA-02'] }}</td>
        </tr>
        @include('reports.statistic.tables.daily_01.line_blank', ['label' => "", "cols" => 10])
        @include('reports.statistic.tables.daily_01.line_blank', ['label' => "TARDE", "cols" => 10])
        <tr>
            <td>(13:00 AS 19:00)</td>
            <td>{{ $report_bases_turn['afternoon'][2]['transport']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['afternoon'][3]['transport']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['afternoon'][4]['transport']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['afternoon'][5]['transport']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['afternoon'][6]['transport']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['afternoon'][7]['transport']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['afternoon'][10]['transport']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['afternoon'][9]['transport']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['afternoon'][8]['transport']['USA-02'] }}</td>
        </tr>
        @include('reports.statistic.tables.daily_01.line_blank', ['label' => "", "cols" => 10])
        @include('reports.statistic.tables.daily_01.line_blank', ['label' => "NOITE", "cols" => 10])
        <tr>
            <td>(19:00 AS 00:00)</td>
            <td>{{ $report_bases_turn['night'][2]['transport']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['night'][3]['transport']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['night'][4]['transport']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['night'][5]['transport']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['night'][6]['transport']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['night'][7]['transport']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['night'][10]['transport']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['night'][9]['transport']['USA-02'] }}</td>
            <td>{{ $report_bases_turn['night'][8]['transport']['USA-02'] }}</td>
        </tr>
        @include('reports.statistic.tables.daily_01.line_blank', ['label' => "", "cols" => 10])
        <tr class="tab-line2">
            <td class="tab-color2"><b>TOTAL</b></td>
            <td>{{ $totalTransportsUsa02[2]; }}</td>
            <td>{{ $totalTransportsUsa02[3]; }}</td>
            <td>{{ $totalTransportsUsa02[4]; }}</td>
            <td>{{ $totalTransportsUsa02[5]; }}</td>
            <td>{{ $totalTransportsUsa02[6]; }}</td>
            <td>{{ $totalTransportsUsa02[7]; }}</td>
            <td>{{ $totalTransportsUsa02[10]; }}</td>
            <td>{{ $totalTransportsUsa02[9]; }}</td>
            <td>{{ $totalTransportsUsa02[8]; }}</td>
        </tr>
    </tbody>
</table>
