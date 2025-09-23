<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15">
    <style type="text/css">
        @font-face {
            font-family: 'Source Sans Pro';
            font-style: normal;
            font-weight: normal;
            src: local('Source Sans Pro'), local('SourceSansPro-Regular'), url(http://themes.googleusercontent.com/static/fonts/sourcesanspro/v7/ODelI1aHBYDBqgeIAH2zlNzbP97U9sKh0jjxbPbfOKg.ttf) format('truetype');
        }

        @font-face {
            font-family: 'Source Sans Pro';
            font-style: normal;
            font-weight: bold;
            src: local('Source Sans Pro Bold'), local('SourceSansPro-Bold'), url(http://themes.googleusercontent.com/static/fonts/sourcesanspro/v7/toadOcfmlt9b38dHJxOBGLsbIrGiHa6JIepkyt5c0A0.ttf) format('truetype');
        }

        @font-face {
            font-family: 'Source Sans Pro';
            font-style: italic;
            font-weight: normal;
            src: local('Source Sans Pro Italic'), local('SourceSansPro-It'), url(http://themes.googleusercontent.com/static/fonts/sourcesanspro/v7/M2Jd71oPJhLKp0zdtTvoM0DauxaEVho0aInXGvhmB4k.ttf) format('truetype');
        }

        @font-face {
            font-family: 'Source Sans Pro';
            font-style: italic;
            font-weight: bold;
            src: local('Source Sans Pro Bold Italic'), local('SourceSansPro-BoldIt'), url(http://themes.googleusercontent.com/static/fonts/sourcesanspro/v7/fpTVHK8qsXbIeTHTrnQH6Edtd7Dq2ZflsctMEexj2lw.ttf) format('truetype');
        }

        @page{ margin: 180px 50px; }

        body {
            font-family: sans-serif;
            font-family: 'Source Sans Pro', sans-serif;
        }

        p,
        h1 {
            font-size: .80em;
            background: #eee;
            padding: 1em;
            font-family: 'Source Sans Pro', sans-serif;
        }

        header {
            position: fixed;
            left: 0px;
            top: -120px;
            right: 0px;
            text-align: center;
        }

        table {
            table-layout: fixed;
            width: 710px;
        }

        #footer {
            background: #eee;
            position: fixed;
            bottom: -120px;
            left: 0px;
            right: 0px;
            height: 50px;
            margin-bottom: 0px;
            padding-bottom: 5px;
            text-align: center;
        }

    </style>
</head>

<body>

    <header>
        <h1 style="margin-top:0px;padding:5px;text-align:center"> TransSaúde - Itiuba - BA <br />
            {{ $sheets->protocol ?? '' }} | Ficha de atendimento
            <br/>
            {{ $sheets->status ? 'Status da Ficha: ' . $sheets->status : '' }}
            <br/>
            {{ $sheets->stopwatch ? 'Duração: ' . $sheets->stopwatch : '' }}

        </h1>

        <table style="table-layout: fixed; width:100%; margin-bottom:2px; border-bottom:1px solid #ccc;">
            <thead>

            </thead>
        </table>
    </header>

    <!-- Informações Gerais -->
    <h3 style="margin:0px;border-bottom:1px solid #ccc;margin-top:10px; background-color: #ccc;color: #000;padding-left:5px;">INFORMAÇÕES DA OCORRENCIA</h3>
    @include('reports.sheets.tables.table-01')

    <h3 style="margin:0px;border-bottom:1px solid #ccc;margin-top:10px; background-color: #ccc;color: #000;padding-left:5px;">VITIMAS</h3>
    @include('reports.sheets.tables.table-02')

    <!--<h3 style="margin:0px;border-bottom:1px solid #ccc;margin-top:10px; background-color: #ccc;color: #000;padding-left:5px;">AVALIAÇÃO DO ESTADO DO PACIENTE</h3> -->

    <h3 style="margin:0px;border-bottom:1px solid #ccc;margin-top:10px; background-color: #ccc;color: #000;padding-left:5px;">TRANSPORTE</h3>
    @include('reports.sheets.tables.table-03')

    <h3 style="margin:0px;border-bottom:1px solid #ccc;margin-top:10px; background-color: #ccc;color: #000;padding-left:5px; page-break-before: always;">CÓDIGO DE TRANSFERÊNCIA</h3>
    @include('reports.sheets.tables.table-04')

    <h3 style="margin:0px;border-bottom:1px solid #ccc;margin-top:10px; background-color: #ccc;color: #000;padding-left:5px;">TRANSPORTE UTILIZADO</h3>
    @include('reports.sheets.tables.table-05')

    <h3 style="margin:0px;border-bottom:1px solid #ccc;margin-top:10px; background-color: #ccc;color: #000;padding-left:5px;">DESTINO DO PACIENTE</h3>
    @include('reports.sheets.tables.table-07')

    <h3 style="margin:0px;border-bottom:1px solid #ccc;margin-top:10px; background-color: #ccc;color: #000;padding-left:5px;">APOIO</h3>
    @include('reports.sheets.tables.table-08')

    @if ($sheets->support_transport_usa == true)
        <h3 style="margin:0px;border-bottom:1px solid #ccc;margin-top:10px; background-color: #ccc;color: #000;padding-left:5px; {{ $sheets->support_transport_usa ? 'page-break-before: always;' : ''}} {{ $sheets->support_transport_usb ? 'page-break-before: always;' : ''}} {{ $sheets->support_transport_motolancia ? 'page-break-before: always;' : ''}}">APOIO USA</h3>
        @include('reports.sheets.tables.table-09')
    @endif

    @if ($sheets->support_transport_usb == true)
        <h3 style="margin:0px;border-bottom:1px solid #ccc;margin-top:10px; background-color: #ccc;color: #000;padding-left:5px;">APOIO USB</h3>
        @include('reports.sheets.tables.table-10')
    @endif

    @if ($sheets->support_transport_motolancia == true)
        <h3 style="margin:0px;border-bottom:1px solid #ccc;margin-top:10px; background-color: #ccc;color: #000;padding-left:5px;">APOIO MOTOLÂNCIA</h3>
        @include('reports.sheets.tables.table-11')
    @endif

    <h3 style="margin:0px;border-bottom:1px solid #ccc;margin-top:10px; background-color: #ccc;color: #000;padding-left:5px; @if($sheets->support_transport_usa || !$sheets->support_transport_usb || !$sheets->support_transport_motolancia)  @else page-break-before: always; @endif">INCIDENTES</h3>
    @include('reports.sheets.tables.table-12')

    <h3 style="margin:0px;border-bottom:1px solid #ccc; background-color: #ccc;color: #000;padding-left:5px;">OUTROS DETALHES</h3>
    @include('reports.sheets.tables.table-13')

    <div id="footer">
        Emitido com base nos dados inseridos no sistema <br /> SAMULIFE em
        {{ $sheets->checkin }}
    </div>

</body>

</html>
