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
            
            <p><span style="font-size: 20px;">&#8226;</span> ATENDIMENTO A CHAMADAS RECEBIDAS PELO SAMU 192</p>
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
                        <td colspan="3" rowspan="2">0301030014</td>
                        <td colspan="3">Telefonista 
                            422205</td>
                        @for($i = 1 ; $i <= 31 ; $i++)
                            <td colspan="1">
                                @if(isset($report['all_calls'][$i]))
                                    {{ $report['all_calls'][$i] }} 
                                @endif</td>
                        @endfor
                        <td colspan="2">{{ $report['all_calls']['total'] }}</td>
                    </tr>
                    <tr>
                        <td colspan="3">Operador de Rádio-Chamadas
                            422220</td>
                        @for($i = 1 ; $i <= 31 ; $i++)
                            <td colspan="1">
                                @if(isset($report['transport_exits'][$i]))
                                    {{ $report['transport_exits'][$i] }} 
                                @endif</td>
                        @endfor
                        <td colspan="2">{{ $report['transport_exits']['total'] }}</td>
                    </tr>
                </tbody>
            </table>
            <br>
            <p><span style="font-size: 20px;">&#8226;</span> REGULACAO MEDICA DE URGENCIA DA CENTRAL SAMU 192 C/ ORIENTACAO </p>
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
                        <td colspan="3">0301030146</td>
                        <td colspan="3">Médico Clínico
                            225125</td>
                        @for($i = 1 ; $i <= 31 ; $i++)
                            <td colspan="1">
                                @if(isset($report['guidelines'][$i]))
                                    {{ $report['guidelines'][$i] }} 
                                @endif</td>
                        @endfor
                        <td colspan="2">{{ $report['guidelines']['total'] }}</td>
                    </tr>
                </tbody>
            </table>

            <!-- Nova página -->
            <br><br><br><br>

            @include('reports.monthly.components.header_02')
            <p><span style="font-size: 20px;">&#8226;</span> REGULACAO MEDICA DE URGENCIA DA CENTRAL SAMU 192 C/ ENVIO DE EQUIPE DE SUPORTE BASICO DE VIDA</p>
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
                        <td colspan="3">0301030138</td>
                        <td colspan="3">Médico Clínico
                            225125</td>
                        @for($i = 1 ; $i <= 31 ; $i++)
                            <td colspan="1">
                                @if(isset($report['usb_exit'][$i]))
                                    {{ $report['usb_exit'][$i] }} 
                                @endif
                            </td>
                        @endfor
                        <td colspan="2">{{ $report['usb_exit']['total'] }}</td>
                    </tr>
                </tbody>
            </table>
            <p><span style="font-size: 20px;">&#8226;</span> REGULACAO MEDICA DE URGENCIA DA CENTRAL SAMU 192 C/ ENVIO DE EQUIPE DE SUPORTE AVANCADO DE VIDA</p>
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
                        <td colspan="3">0301030120</td>
                        <td colspan="3">Médico Clínico
                            225125</td>
                        @for($i = 1 ; $i <= 31 ; $i++)
                            <td colspan="1">
                                @if(isset($report['usa_exit'][$i]))
                                    {{ $report['usa_exit'][$i] }} 
                                @endif
                            </td>
                        @endfor
                        <td colspan="2">{{ $report['usa_exit']['total'] }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>

</html>
