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
            
            <p><span style="font-size: 20px;">&#8226;</span> ATENDIMENTO PRÉ-HOSPITALAR MOVEL REALIZADO PELA EQUIPE DE SUPORTE BASICO DE VIDA TERRESTRE (USB) </p>
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
                        <td colspan="3">Téc. Enfermagem 
                            322205</td>
                        @for($i = 1 ; $i <= 31 ; $i++)
                            <td colspan="1">
                                @if(isset($report['reserve_exits'][$i]))
                                    {{ $report['reserve_exits'][$i] }} 
                                @endif</td>
                        @endfor
                        <td colspan="2">{{ $report['reserve_exits']['total'] }}</td>
                    </tr>
                    <tr>
                        <td colspan="3"><br><br><br></td>
                        @for($i = 1 ; $i <= 31 ; $i++)
                            <td colspan="1"></td>
                        @endfor
                        <td colspan="2">0</td>
                    </tr>
                </tbody>
            </table>
            <!-- Nova página -->
            <br><br><br><br>

            @include('reports.monthly.components.header_02')
            <p><span style="font-size: 20px;">&#8226;</span> TRANSPORTE INTER-HOSPITALAR PELA UNIDADE DE SUPORTE BASICO DE VIDA TERRESTRE (USB)</p>
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
                        <td colspan="3">Téc. Enfermagem 
                            322205</td>
                        @for($i = 1 ; $i <= 31 ; $i++)
                            <td colspan="1">
                                @if(isset($report['reserve_transfer'][$i]))
                                    {{ $report['reserve_transfer'][$i] }} 
                                @endif</td>
                        @endfor
                        <td colspan="2">{{ $report['reserve_transfer']['total'] }}</td>
                    </tr>
                    <tr>
                        <td colspan="3"><br><br></td>
                        @for($i = 1 ; $i <= 31 ; $i++)
                            <td colspan="1"></td>
                        @endfor
                        <td colspan="2">0</td>
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
                        <td colspan="3"><br><br></td>
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
