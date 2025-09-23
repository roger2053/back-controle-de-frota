<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15">
        <link rel="stylesheet" href="assets/css/report.css"> 
    </head>
    <body>
        <header>
            @include('reports.monthly.components.header_01')
        </header>
        <footer>
            @include('reports.monthly.components.footer')   
        </footer>

        <div class="container" style="margin-top: 1px;">
            <p><span style="font-size: 20px;">&#8226;</span> ATENDIMENTO PRE-HOSPITALAR MOVEL PELO SAMU 192: SUPORTE BASICO DE VIDA REALIZADO POR AMBULANCIA TIPO B </p>
            <table>
                <thead>
                    <tr>
                        <th colspan="3" rowspan="2">CÓDIGO</th>
                        <th colspan="3" rowspan="2">CBO</th>
                        <th colspan="31" rowspan="1">ANOTAÇÕES DIÁRIAS</th>
                        <th colspan="2" rowspan="2">TOTAL</th>
                    </tr>
                    <tr>
                        @for($i = 1 ; $i <= 31 ; $i++)
                            <th colspan="1">{{ $i }}</th>
                        @endfor
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="3" rowspan="2">0301030103</td>
                        <td colspan="3">Aux. Enfermagem 
                            322230</td>
                        @for($i = 1 ; $i <= 31 ; $i++)
                            <td colspan="1"></td>
                        @endfor
                        <td colspan="2">0</td>
                    </tr>
                    <tr>
                        <td colspan="3">Téc. Enfermagem 
                            322205</td>
                        @for($i = 1 ; $i <= 31 ; $i++)
                            <td colspan="1">
                                @if(isset($report['exits_usb01'][$i]))
                                    {{ $report['exits_usb01'][$i] }} 
                                @endif</td>
                        @endfor
                        <td colspan="2">{{ $report['exits_usb01']['total'] }}</td>
                    </tr>
                </tbody>
            </table>
            <!-- Nova página -->
            <br><br><br><br>

            @include('reports.monthly.components.header_02')
            <p><span style="font-size: 20px;">&#8226;</span> TRANSPORTE INTER-HOSPITALAR - SAMU 192: SUPORTE BASICO DE VIDA </p>
            <table>
                <thead>
                    <tr>
                        <th colspan="3" rowspan="2">CÓDIGO</th>
                        <th colspan="3" rowspan="2">CBO</th>
                        <th colspan="31" rowspan="1">ANOTAÇÕES DIÁRIAS</th>
                        <th colspan="2" rowspan="2">TOTAL</th>
                    </tr>
                    <tr>
                        @for($i = 1 ; $i <= 31 ; $i++)
                            <th colspan="1">{{ $i }}</th>
                        @endfor
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="3" rowspan="4">0301030189</td>
                        <td colspan="3">Aux. Enfermagem 
                            322230</td>
                        @for($i = 1 ; $i <= 31 ; $i++)
                            <td colspan="1"></td>
                        @endfor
                        <td colspan="2">0</td>
                    </tr>
                    <tr>
                        <td colspan="3">Téc. Enfermagem 
                            322205</td>
                            @for($i = 1 ; $i <= 31 ; $i++)
                            <td colspan="1">
                                @if(isset($report['transfer_usb01'][$i]))
                                    {{ $report['transfer_usb01'][$i] }} 
                                @endif</td>
                            @endfor
                        <td colspan="2">{{ $report['transfer_usb01']['total'] }}</td>
                    </tr>
                    <tr>
                        <td colspan="3">Enfermeiro 
                            223505</td>
                        @for($i = 1 ; $i <= 31 ; $i++)
                            <td colspan="1"></td>
                        @endfor
                        <td colspan="2">0</td>
                    </tr>
                    <tr>
                        <td colspan="3">Médico Clínico
                            225125</td>
                        @for($i = 1 ; $i <= 31 ; $i++)
                            <td colspan="1"></td>
                        @endfor
                        <td colspan="2">0</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>

</html>
