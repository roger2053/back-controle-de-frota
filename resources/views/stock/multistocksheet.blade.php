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
        .obs {
            .desc,
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

        .wrap {
            overflow-wrap: break-word;
            word-wrap: break-word;
        }

        .min50 {
            min-height: 50px;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <header class="table-header">
            <div class="title">
                <h2><strong>Controle De Consumo<br />De Materiais</strong></h2>
            </div>
            <div class="desc">
                Samu Regional Senhor do Bonfim - BA
                <br />
                {{ $params['now'] }}
                <br />
            </div>
        </header>
        {{--
        <table>
            <thead class="tab-color">
                <tr class="table-header">
                    <th colspan="8" rowspan="1">Material</th>
                    <th colspan="4" rowspan="1">Quantidade Anterior</th>
                    <th colspan="4" rowspan="1">Quantidade Posterior</th>
                    <th colspan="4" rowspan="1">Quantidade Solicitada</th>
                </tr>
            </thead>
            <tbody>
                <tr >
                    <th colspan="8" height="50">{{ $params->product }}</th>
                    <th colspan="4" height="50">{{ $params->quantity_before }}</th>
                    <th colspan="4" height="50">{{ $params->quantity_updated }}</th>
                    <th colspan="4" height="50">{{ $params->quantity_withdrawn }}</th>
                </tr>
            </tbody>
        </table> --}}
        <table>
            <thead class="tab-color">
                <tr>
                    <th class="tab-color2" colspan="16"> Materiais </th>
                </tr>
                <tr class="table-header">
                <tr>
                    <th colspan="4"> Código </th>
                    <th colspan="4"> Produto </th>
                    <th colspan="4"> Lote </th>
                    <th colspan="4" class="tab-color2"> Quantidade </th>
                </tr>


                </tr>
            </thead>
            <tbody>
                @foreach ($params['resp'] as $item)
                    <tr>
                        <td colspan="4" class="wrap">{{ $item->stock->id }}</td>
                        <td colspan="4" class="wrap">{{ $item->stock->product_name }}</td>
                        <td colspan="4" class="wrap">{{ $item->batch }}</td>
                        <td colspan="4" class="wrap">{{ $item->quantity_withdrawn }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <table>
            <thead class="tab-color">
                <tr class="table-header">
                    <th colspan="4" height="20" class="tab-color2">Destino</th>
                    @if (!empty($params['obs']))
                        <th colspan="8" height="20">Observação</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                <tr>
                    @if (!empty($params['obs']))
                        <td colspan="4" height="200" align="center">
                        @else
                        <td colspan="4" height="20" align="center">
                    @endif
                    {{ !empty($params['destination']) ? $params['destination'] : '' }}</th>
                    </td>

                    @if (!empty($params['obs']))
                        <td colspan="8" height="200">
                            <p>{{ $params['obs'] }}</p>
                        </td>
                    @endif
                </tr>
            </tbody>
        </table>

        <table>
            <thead class="tab-color">
                <tr class="table-header">
                    <th colspan="8" height="20" class="tab-color2">Assinatura</th>
                    <th colspan="4" height="20">Responsável</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th colspan="8" height="200">
                        @if (!empty($params['sign']))
                            <img width='400' height="200" src="{{ $params['sign'] }}" alt="">
                        @endif
                    </th>
                    <th colspan="4" height="200">
                        {{ !empty($params['name']) ? $params['name'] : '' }} <br> <span
                            style="padding-right: 5px">CPF:
                            {{ !empty($params['cpf']) ? $params['cpf'] : '' }}</span>
                    </th>
                </tr>
            </tbody>
        </table>
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
