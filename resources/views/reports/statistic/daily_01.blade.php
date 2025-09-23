<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15">
    <style type="text/css">
        @font-face {
            font-family: 'Source Sans Pro';
            font-style: normal;
            font-weight: normal;
            src: local('Source Sans Pro'),
                local('SourceSansPro-Regular'),
                url(http://themes.googleusercontent.com/static/fonts/sourcesanspro/v7/ODelI1aHBYDBqgeIAH2zlNzbP97U9sKh0jjxbPbfOKg.ttf) format('truetype');
        }

        @font-face {
            font-family: 'Source Sans Pro';
            font-style: normal;
            font-weight: bold;
            src:
                local('Source Sans Pro Bold'), local('SourceSansPro-Bold'),
                url(http://themes.googleusercontent.com/static/fonts/sourcesanspro/v7/toadOcfmlt9b38dHJxOBGLsbIrGiHa6JIepkyt5c0A0.ttf) format('truetype');
        }

        @font-face {
            font-family: 'Source Sans Pro';
            font-style: italic;
            font-weight: normal;
            src:
                local('Source Sans Pro Italic'), local('SourceSansPro-It'),
                url(http://themes.googleusercontent.com/static/fonts/sourcesanspro/v7/M2Jd71oPJhLKp0zdtTvoM0DauxaEVho0aInXGvhmB4k.ttf) format('truetype');
        }

        @font-face {
            font-family: 'Source Sans Pro';
            font-style: italic;
            font-weight: bold;
            src:
                local('Source Sans Pro Bold Italic'), local('SourceSansPro-BoldIt'),
                url(http://themes.googleusercontent.com/static/fonts/sourcesanspro/v7/fpTVHK8qsXbIeTHTrnQH6Edtd7Dq2ZflsctMEexj2lw.ttf) format('truetype');
        }

        @page {
            margin: 180px 30px;
        }

        body {
            font-family: sans-serif;
            font-family: 'Source Sans Pro',
                sans-serif;
        }

        header {
            text-align: center;
            background-color: #eee;
            padding-bottom: 5px;
        }

        table {
            table-layout:
                fixed;
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
            border: 1px solid black;
            page-break-inside: avoid; 
        }

        
        th,
        td {
            border: 0.1px solid black;
            page-break-inside: avoid; 
        }

        th,
        td {
            line-height: 12px;
            font-size: 9pt;
            text-align: center;
        }

        small {
            font-size: 8pt;
        }

        .container {
            width: 100%;
            height: 100%;
            margin-top: -4cm;
            margin-bottom: -3.5cm;
        }

        .title,
        .desc,
        .obs {
            line-height: 1;
        }

        .obs {
            margin-top:
                -10px;
        }

        .obs ul {
            margin-left: 1cm;
        }

        .obs ul li {
            font-size: 10pt;
        }

        th {
            font-size: 9pt;
        }

        a {
            font-size: 8pt;
        }

        .tab-color {
            color: #fff;
            background-color: #1976d2;
        }

        .tab-line {
            background-color: #70a3d599;
        }

        .tab-color2 {
            background-color: #af0808c9;
            font-weight: bold;
            color: #fff;
        }

        .tab-line2 {
            background-color: #af0808a1;
            font-weight: bold;
            color: #fff;
        }

        .tab-line3 {
            background-color: #af080854;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <header class="table-header">
            <div class="title">
                <h2><strong>Serviço de Atendimento<br />Móvel de Urgência</strong></h2>
            </div>
            <div class="desc">
                Samu Regional Senhor do Bonfim - BA
                <br />
                {{ $report_global['info']['type'] }}
                <br />
                {{ $report_global['info']['title'] }} | {{ $report_global['info']['initial_date'] }} até {{
                $report_global['info']['final_date'] }}
            </div>
        </header>
        <table>
            <thead class="tab-color">
                <tr class="table-header">
                    <th colspan="6" rowspan="2">Estatística</th>
                    <th colspan="4" rowspan="1">Turno</th>
                    <th colspan="1" rowspan="2" class="tab-color2">Total</th>
                </tr>
                <tr class="table-subheader">
                    <th colspan="1">Manhã</th>
                    <th colspan="1">Tarde</th>
                    <th colspan="1">Noite</th>
                    <th colspan="1">Extra Noite</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                ?>

                @foreach($report_global['report'] as $estatistica => $values)

                <tr class="{{($i%2==0)?'tab-line':''}}">
                    @if(!str_contains($estatistica, 'Attendance') && !str_contains($estatistica, 'Transfer') &&
                    !str_contains($estatistica, 'Transport') )
                    <th colspan="6">{{ $estatistica }}</th>
                    <td>{{ $values['morning'] }}</td>
                    <td>{{ $values['afternoon'] }}</td>
                    <td>{{ $values['night'] }}</td>
                    <td>{{ $values['extraNight'] }}</td>
                    <td class="{{($i%2==0)?'tab-line2':'tab-line3'}}"><strong> {{ $values['total'] }} </strong></td>
                    <?php
                    $i++;
                    ?>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Estatisticas da USA 01 e 02 -->
        @include('reports.statistic.tables.daily_01.table_usa_statistics')

        <!-- Atendimentos USA 01 -->
        @include('reports.statistic.tables.daily_01.table_attendance_usa_01')

        <!-- Atendimentos USA 02 -->
        @include('reports.statistic.tables.daily_01.table_attendance_usa_02')

        <!-- Atendimentos USB Base Descentralizadas -->
        @include('reports.statistic.tables.daily_01.table_attendance_usb_descentralized')

        <!-- Transferências USA 01 -->
        @include('reports.statistic.tables.daily_01.table_transfers_usa_01')

        <!-- Transferências USA 02 -->
        @include('reports.statistic.tables.daily_01.table_transfers_usa_02')

        <!-- Transferências USB Base Descentralizadas -->
        @include('reports.statistic.tables.daily_01.table_transfer_usb_descentralized')

        <!-- Transportes USA 01 -->
        @include('reports.statistic.tables.daily_01.table_transports_usa_01')

        <!-- Transportes USA 02 -->
        @include('reports.statistic.tables.daily_01.table_transports_usa_02')

        <!-- Transportes USB Base Descentralizadas -->
        @include('reports.statistic.tables.daily_01.table_transports_usb_descentralized')

    </div>
</body>

<style>
    .table-header {
        color: #fff;
        background-color: #1976d2;
    }

    .table-header th {
        color: #fff;
    }

    .table-subheader {
        background-color: #1976d2;
    }

    .table-content {
        background-color: #70a3d599;
    }
</style>

</html>