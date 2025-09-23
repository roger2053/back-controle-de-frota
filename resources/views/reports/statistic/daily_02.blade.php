<?php
$total = 0;
$total += $report_global['total']['better_1_age'];
$total += $report_global['total']['child_month'];
$total += $report_global['total']['1_11_age'];
$total += $report_global['total']['12_17_age'];
$total += $report_global['total']['18_40_age'];
$total += $report_global['total']['41_59_age'];
$total += $report_global['total']['60_79_age'];
$total += $report_global['total']['larger_80_age'];
$total += $report_global['total']['ignored_age'];
$total += $report_global['total']['not_informed_age'];
$total += $report_global['total']['m'];
$total += $report_global['total']['f'];
$total += $report_global['total']['ig'];
$total += $report_global['total']['ni'];
$total += $report_global['total']['UPA'];
$total += $report_global['total']['CAPS'];
$total += $report_global['total']['USF'];
$total += $report_global['total']['UBS'];
$total += $report_global['total']['Clínicas'];
$total += $report_global['total']['Hospital'];
$total += $report_global['total']['Domicílio'];
$total += $report_global['total']['Via Pública'];
$total += $report_global['total']['Estab. Comercial/Ensino'];
$total += $report_global['total']['Órgão Público'];
$total += $report_global['total']['Não Informado'];
?>

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

        @page {
            margin: 9rem 1rem;
            width: 1000px;
        }

        body {
            font-family: sans-serif;
            font-family: 'Source Sans Pro', sans-serif;
        }


        header {
            margin-top: 1rem;
            text-align: center;
            background-color: #eee;
            padding-bottom: 5px;
        }

        table {
            table-layout: auto;
            width: 100%;
            margin-top: 10px;
            /* border-collapse: collapse; */
            page-break-inside: avoid; 
        }

        table,
        th,
        td {
            border: 0.01px solid black;
            page-break-inside: avoid; 
        }

        th,
        td {
            line-height: 8px;
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
            margin-top: -10px;
        }

        .obs ul {
            margin-left: 1cm;
        }

        .obs ul li {
            font-size: 10pt;
        }

        th {
            font-size: 7pt;
        }


        a {
            font-size: 8pt;
        }

        .tab-color {
            color: #fff;
            background-color: #1976d2;
        }
    </style>
</head>

<body>
    <div class="container">
        <header class="tab-color">
            <div class="title">
                <h2><strong>Serviço de Atendimento<br />Móvel de Urgência</strong></h2>
            </div>
            <div class="desc">
                Samu Regional Senhor do Bonfim - BA
                <br />
                {{ $report_global['info']['type'] }}
                <br />
                {{ $report_global['info']['title'] }} | {{ $report_global['info']['initial_date'] }} até {{ $report_global['info']['final_date'] }}
            </div>
        </header>
        <table>
            <thead>
                <tr>
                    <th colspan="2" rowspan="2" class="tab-color"><strong>TURNO</strong></th>
                    <!-- TROCAR O COLSPAN DO "GRUPO ETÁRIO" PARA `8` SE O CAMPO "IG" FOR NECESSÁRIO -->
                    <th class="tab-color" colspan="11" rowspan="1"><strong>GRUPO ETÁRIO</strong></th>
                    <th style="color: #fff; background-color: #6086ab;" colspan="4" rowspan="1"><strong>SEXO</strong></th>
                    <th class="tab-color" colspan="22" rowspan="1"><strong>LOCAL</strong></th>
                </tr>
                <tr class="tab-color">
                    <!-- <th colspan="1" rowspan="1" ><strong>&#60; 1 ANO</strong></th> -->
                    <th colspan="1" rowspan="1"><strong>RN</strong></th>
                    <th colspan="2"><strong>C(Meses)</strong>

                    </th>
                    <th colspan="1" rowspan="1"><strong>01 A 11</strong></th>
                    <th colspan="1" rowspan="1"><strong>12 A 17</strong></th>
                    <th colspan="1" rowspan="1"><strong>18 A 40</strong></th>
                    <th colspan="1" rowspan="1"><strong>41 A 59</strong></th>
                    <th colspan="1" rowspan="1"><strong>60 A 79</strong></th>
                    <th colspan="1" rowspan="1"><strong>80+</strong></th>
                    <th colspan="1" rowspan="1"><strong>IG</strong></th>
                    <th colspan="1" rowspan="1"><strong>NI</strong></th>
                    <!--<th colspan="1" rowspan="1" ><strong>IG</strong></th>-->
                    <th colspan="1" rowspan="1" style="color: #fff; background-color: #6086ab;"><strong>M</strong></th>
                    <th colspan="1" rowspan="1" style="color: #fff; background-color: #6086ab;"><strong>F</strong></th>
                    <th colspan="1" rowspan="1" style="color: #fff; background-color: #6086ab;"><strong>IG</strong></th>
                    <th colspan="1" rowspan="1" style="color: #fff; background-color: #6086ab;"><strong>NI</strong></th>
                    <th colspan="1" rowspan="1"><strong>UPA</strong></th>
                    <th colspan="1" rowspan="1"><strong>CAPS</strong></th>
                    <th colspan="1" rowspan="1"><strong>USF</strong></th>
                    <th colspan="1" rowspan="1"><strong>UBS</strong></th>
                    <th colspan="2" rowspan="1"><strong>Clínicas</strong></th>
                    <th colspan="2" rowspan="1"><strong>Hospital</strong></th>
                    <th colspan="2" rowspan="1"><strong>Domicílio</strong></th>
                    <th colspan="2" rowspan="1"><strong>Via Pública</strong></th>
                    <th colspan="4" rowspan="1"><strong>Estab.<br />Comercial/Ensino</strong></th>
                    <th colspan="3" rowspan="1"><strong>*Orgão Público</strong></th>
                    <th colspan="3" rowspan="1"><strong>Não Informado</strong></th>
                </tr>
            </thead>
            <tbody>
                <tr style="background-color:#70a3d599">
                    <td colspan="2" class="tab-color"><a><strong>EXTRA NOITE</strong><br /><small>(Das 00:00 às 07:00 h)</small></a></td>
                    <td colspan="1">{{ $report_global['extraNight']['better_1_age'] }}</td>
                    <td colspan="2">{{ $report_global['extraNight']['child_month'] }}</td>
                    <td colspan="1">{{ $report_global['extraNight']['1_11_age'] }}</td>
                    <td colspan="1">{{ $report_global['extraNight']['12_17_age'] }}</td>
                    <td colspan="1">{{ $report_global['extraNight']['18_40_age'] }}</td>
                    <td colspan="1">{{ $report_global['extraNight']['41_59_age'] }}</td>
                    <td colspan="1">{{ $report_global['extraNight']['60_79_age'] }}</td>
                    <td colspan="1">{{ $report_global['extraNight']['larger_80_age'] }}</td>
                    <td colspan="1">{{ $report_global['extraNight']['ignored_age'] }}</td>
                    <td colspan="1">{{ $report_global['extraNight']['not_informed_age'] }}</td>
                    <!--<td colspan="1"></td>-->
                    <td colspan="1">{{ $report_global['extraNight']['m'] }}</td>
                    <td colspan="1">{{ $report_global['extraNight']['f'] }}</td>
                    <td colspan="1">{{ $report_global['extraNight']['ig'] }}</td>
                    <td colspan="1">{{ $report_global['extraNight']['ni'] }}</td>
                    <td colspan="1">{{ $report_global['extraNight']['UPA'] }}</td>
                    <td colspan="1">{{ $report_global['extraNight']['CAPS'] }}</td>
                    <td colspan="1">{{ $report_global['extraNight']['USF'] }}</td>
                    <td colspan="1">{{ $report_global['extraNight']['UBS'] }}</td>
                    <td colspan="2">{{ $report_global['extraNight']['Clínicas'] }}</td>
                    <td colspan="2">{{ $report_global['extraNight']['Hospital'] }}</td>
                    <td colspan="2">{{ $report_global['extraNight']['Domicílio'] }}</td>
                    <td colspan="2">{{ $report_global['extraNight']['Via Pública'] }}</td>
                    <td colspan="4">{{ $report_global['extraNight']['Estab. Comercial/Ensino'] }}</td>
                    <td colspan="3">{{ $report_global['extraNight']['Órgão Público'] }}</td>
                    <td colspan="3">{{ $report_global['extraNight']['Não Informado'] }}</td>
                </tr>
                <tr>
                    <td colspan="2" class="tab-color"><a><strong>MANHÃ</strong><br /><small>(Das 07:00 às 13:00 h)</small></a></td>
                    <td colspan="1">{{ $report_global['morning']['better_1_age'] }}</td>
                    <td colspan="2">{{ $report_global['morning']['child_month'] }}</td>
                    <td colspan="1">{{ $report_global['morning']['1_11_age'] }}</td>
                    <td colspan="1">{{ $report_global['morning']['12_17_age'] }}</td>
                    <td colspan="1">{{ $report_global['morning']['18_40_age'] }}</td>
                    <td colspan="1">{{ $report_global['morning']['41_59_age'] }}</td>
                    <td colspan="1">{{ $report_global['morning']['60_79_age'] }}</td>
                    <td colspan="1">{{ $report_global['morning']['larger_80_age'] }}</td>
                    <td colspan="1">{{ $report_global['morning']['ignored_age'] }}</td>
                    <td colspan="1">{{ $report_global['morning']['not_informed_age'] }}</td>
                    <!--<td colspan="1"></td>-->
                    <td colspan="1">{{ $report_global['morning']['m'] }}</td>
                    <td colspan="1">{{ $report_global['morning']['f'] }}</td>
                    <td colspan="1">{{ $report_global['morning']['ig'] }}</td>
                    <td colspan="1">{{ $report_global['morning']['ni'] }}</td>
                    <td colspan="1">{{ $report_global['morning']['UPA'] }}</td>
                    <td colspan="1">{{ $report_global['morning']['CAPS'] }}</td>
                    <td colspan="1">{{ $report_global['morning']['USF'] }}</td>
                    <td colspan="1">{{ $report_global['morning']['UBS'] }}</td>
                    <td colspan="2">{{ $report_global['morning']['Clínicas'] }}</td>
                    <td colspan="2">{{ $report_global['morning']['Hospital'] }}</td>
                    <td colspan="2">{{ $report_global['morning']['Domicílio'] }}</td>
                    <td colspan="2">{{ $report_global['morning']['Via Pública'] }}</td>
                    <td colspan="4">{{ $report_global['morning']['Estab. Comercial/Ensino'] }}</td>
                    <td colspan="3">{{ $report_global['morning']['Órgão Público'] }}</td>
                    <td colspan="3">{{ $report_global['morning']['Não Informado'] }}</td>
                </tr>
                <tr style="background-color:#70a3d599">
                    <td colspan="2" class="tab-color"><a><strong>TARDE</strong><br /><small>(Das 13:00 às 19:00 h)</small></a></td>
                    <td colspan="1">{{ $report_global['afternoon']['better_1_age'] }}</td>
                    <td colspan="2">{{ $report_global['afternoon']['child_month'] }}</td>
                    <td colspan="1">{{ $report_global['afternoon']['1_11_age'] }}</td>
                    <td colspan="1">{{ $report_global['afternoon']['12_17_age'] }}</td>
                    <td colspan="1">{{ $report_global['afternoon']['18_40_age'] }}</td>
                    <td colspan="1">{{ $report_global['afternoon']['41_59_age'] }}</td>
                    <td colspan="1">{{ $report_global['afternoon']['60_79_age'] }}</td>
                    <td colspan="1">{{ $report_global['afternoon']['larger_80_age'] }}</td>
                    <td colspan="1">{{ $report_global['afternoon']['ignored_age'] }}</td>
                    <td colspan="1">{{ $report_global['afternoon']['not_informed_age'] }}</td>
                    <!--<td colspan="1"></td>-->
                    <td colspan="1">{{ $report_global['afternoon']['m'] }}</td>
                    <td colspan="1">{{ $report_global['afternoon']['f'] }}</td>
                    <td colspan="1">{{ $report_global['afternoon']['ig'] }}</td>
                    <td colspan="1">{{ $report_global['afternoon']['ni'] }}</td>
                    <td colspan="1">{{ $report_global['afternoon']['UPA'] }}</td>
                    <td colspan="1">{{ $report_global['afternoon']['CAPS'] }}</td>
                    <td colspan="1">{{ $report_global['afternoon']['USF'] }}</td>
                    <td colspan="1">{{ $report_global['afternoon']['UBS'] }}</td>
                    <td colspan="2">{{ $report_global['afternoon']['Clínicas'] }}</td>
                    <td colspan="2">{{ $report_global['afternoon']['Hospital'] }}</td>
                    <td colspan="2">{{ $report_global['afternoon']['Domicílio'] }}</td>
                    <td colspan="2">{{ $report_global['afternoon']['Via Pública'] }}</td>
                    <td colspan="4">{{ $report_global['afternoon']['Estab. Comercial/Ensino'] }}</td>
                    <td colspan="3">{{ $report_global['afternoon']['Órgão Público'] }}</td>
                    <td colspan="3">{{ $report_global['afternoon']['Não Informado'] }}</td>
                </tr>
                <tr>
                    <td colspan="2" class="tab-color"><a><strong>NOITE</strong><br /><small>(Das 19:00 às 00:00 h)</small></a></td>
                    <td colspan="1">{{ $report_global['night']['better_1_age'] }}</td>
                    <td colspan="2">{{ $report_global['night']['child_month'] }}</td>
                    <td colspan="1">{{ $report_global['night']['1_11_age'] }}</td>
                    <td colspan="1">{{ $report_global['night']['12_17_age'] }}</td>
                    <td colspan="1">{{ $report_global['night']['18_40_age'] }}</td>
                    <td colspan="1">{{ $report_global['night']['41_59_age'] }}</td>
                    <td colspan="1">{{ $report_global['night']['60_79_age'] }}</td>
                    <td colspan="1">{{ $report_global['night']['larger_80_age'] }}</td>
                    <td colspan="1">{{ $report_global['night']['ignored_age'] }}</td>
                    <td colspan="1">{{ $report_global['night']['not_informed_age'] }}</td>
                    <!--<td colspan="1"></td>-->
                    <td colspan="1">{{ $report_global['night']['m'] }}</td>
                    <td colspan="1">{{ $report_global['night']['f'] }}</td>
                    <td colspan="1">{{ $report_global['night']['ig'] }}</td>
                    <td colspan="1">{{ $report_global['night']['ni'] }}</td>
                    <td colspan="1">{{ $report_global['night']['UPA'] }}</td>
                    <td colspan="1">{{ $report_global['night']['CAPS'] }}</td>
                    <td colspan="1">{{ $report_global['night']['USF'] }}</td>
                    <td colspan="1">{{ $report_global['night']['UBS'] }}</td>
                    <td colspan="2">{{ $report_global['night']['Clínicas'] }}</td>
                    <td colspan="2">{{ $report_global['night']['Hospital'] }}</td>
                    <td colspan="2">{{ $report_global['night']['Domicílio'] }}</td>
                    <td colspan="2">{{ $report_global['night']['Via Pública'] }}</td>
                    <td colspan="4">{{ $report_global['night']['Estab. Comercial/Ensino'] }}</td>
                    <td colspan="3">{{ $report_global['night']['Órgão Público'] }}</td>
                    <td colspan="3">{{ $report_global['night']['Não Informado'] }}</td>
                </tr>
                <tr style="background-color:#af0808a1; font-weight:bold; color: #fff;">
                    <td colspan="2" style="background-color:#af0808c9; font-weight:bold; color: #fff;"><strong>TOTAL</strong><br />{{"(".$total.")"}}</td>
                    <td colspan="1">{{ $report_global['total']['better_1_age'] }}</td>
                    <td colspan="2">{{ $report_global['total']['child_month'] }}</td>
                    <td colspan="1">{{ $report_global['total']['1_11_age'] }}</td>
                    <td colspan="1">{{ $report_global['total']['12_17_age'] }}</td>
                    <td colspan="1">{{ $report_global['total']['18_40_age'] }}</td>
                    <td colspan="1">{{ $report_global['total']['41_59_age'] }}</td>
                    <td colspan="1">{{ $report_global['total']['60_79_age'] }}</td>
                    <td colspan="1">{{ $report_global['total']['larger_80_age'] }}</td>
                    <td colspan="1">{{ $report_global['total']['ignored_age'] }}</td>
                    <td colspan="1">{{ $report_global['total']['not_informed_age'] }}</td>
                    <!--<td colspan="1"></td>-->
                    <td colspan="1">{{ $report_global['total']['m'] }}</td>
                    <td colspan="1">{{ $report_global['total']['f'] }}</td>
                    <td colspan="1">{{ $report_global['total']['ig'] }}</td>
                    <td colspan="1">{{ $report_global['total']['ni'] }}</td>
                    <td colspan="1">{{ $report_global['total']['UPA'] }}</td>
                    <td colspan="1">{{ $report_global['total']['CAPS'] }}</td>
                    <td colspan="1">{{ $report_global['total']['USF'] }}</td>
                    <td colspan="1">{{ $report_global['total']['UBS'] }}</td>
                    <td colspan="2">{{ $report_global['total']['Clínicas'] }}</td>
                    <td colspan="2">{{ $report_global['total']['Hospital'] }}</td>
                    <td colspan="2">{{ $report_global['total']['Domicílio'] }}</td>
                    <td colspan="2">{{ $report_global['total']['Via Pública'] }}</td>
                    <td colspan="4">{{ $report_global['total']['Estab. Comercial/Ensino'] }}</td>
                    <td colspan="3">{{ $report_global['total']['Órgão Público'] }}</td>
                    <td colspan="3">{{ $report_global['total']['Não Informado'] }}</td>
                </tr>
            </tbody>
        </table>
        <div class="obs">
            <h4><strong>OBSERVAÇÕES:</strong></h4>
            <ul>
                <li><strong>Orgão Público</strong> - (Atendimentos realizados no Complexo Policial, Fórum, Prefeitura, Bancos etc).;</li>
                <li><strong>C(Meses)</strong> - Crianças registradas com Meses de vida;</li>
                <li><strong>C(Anos)</strong> - Crianças registradas com Anos de vida;</li>
                <li><strong>IG</strong> - Ignorados;</li>
                <li><strong>NI</strong> - Não Informados;</li>
                <li>(Atendimentos realizados em Lar de convivência ou Lar de idosos são considerados atendimentos em clínicas).;</li>
            </ul>
        </div>
    </div>
</body>

</html>