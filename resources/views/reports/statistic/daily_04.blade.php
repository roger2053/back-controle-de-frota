<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15">
    <style type="text/css">
        @page {
            margin: 20px 50px;
        }

        body {
            font-family: sans-serif;
            font-family: 'Source Sans Pro', sans-serif;
        }

        p,
        h1 {
            font-size: .80em;
            background: #eee;
            padding: 1em;
        }

        table {
            width: 100%;
            page-break-inside: avoid;
        }

        .md-top-70 {
            margin-top: 60px;
            padding-bottom: 10px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            text-align: center;
            page-break-inside: avoid;
        }

        caption {
            background-color: #1976d2;
            font-weight: bold;
            color: #fff;
            margin-top: 40px;
            width: 100%;
            border: 1px solid black;

        }
        .table-div{
            page-break-inside: avoid;
        }

        .total-tab {
            background-color: #af0808c9;
            font-weight: bold;
            color: #fff;
        }

        .total-cell {
            background-color: #af080856;
            font-weight: bold;
            color: #fff;
        }

        .total {
            background-color: #af0808a1;
            font-weight: bold;
            color: #fff;
        }

        .tab-color {
            color: #fff;
            background-color: #1976d2;
        }

        .tab-color2 {
            color: #fff;
            background-color: #1976d2;
        }

        .tab-line {
            background-color: #70a3d599;
        }

        .title {
            text-align: center;
        }

        .desc {
            text-align: center;
        }
    </style>
</head>

<body>
    <header class="tab-color">
        <div class="title">
            <h2><strong>Serviço de Atendimento Móvel de Urgência</strong></h2>
        </div>
        <div class="desc">
            Samu Regional Senhor do Bonfim - BA
            <br />
            {{ $report_global['info']['type'] }}
            <br />
            {{ $report_global['info']['title'] }} | {{ $report_global['info']['initial_date'] }} até {{ $report_global['info']['final_date'] }}
        </div>
    </header>

    <main>
        <div class="report-div">
            <div class="mt-90"></div>
            @include('reports.statistic.tables.daily_04.table_ocorrencies')
            @include('reports.statistic.tables.daily_04.table_transports')
            {{-- @include('reports.statistic.tables.daily_04.table_transfer') --}}
            @include('reports.statistic.tables.daily_04.table_death')
            @include('reports.statistic.tables.daily_04.table_transfer_details')
        </div>
    </main>

</body>

</html>
