<?php
    $types = [
        "Traumático",
        "Caso Clínico",
        "Obstétrico",
        "Psiquiátrico",
    ];
?>
@foreach($types as $type)
<?php $totalG = 0; ?>
    @if(isset($report_global[$type]))
    @foreach($report_global[$type] as $ocorrencie => $values)
        <?php $totalG += $values['morning'] + $values['afternoon'] + $values['night'] + $values['extraNight']  ; ?>
    @endforeach
    @if($totalG > 0)
    <table>
        <caption class="tab-color"><strong>Tipo de Ocorrência: {{$type}}</strong></caption>
        <thead class="tab-line">
            <tr >
                <th colspan="6" rowspan="2">Ocorrência</th>
                <th colspan="4" rowspan="1">Turno</th>
                <th style="background-color:#af0808c9; font-weight:bold; color: #fff;" colspan="1" rowspan="2">Total</th>
            </tr>
            <tr >
                <th colspan="1">Manhã</th>
                <th colspan="1">Tarde</th>
                <th colspan="1">Noite</th>
                <th colspan="1">Extra Noite</th>
            </tr>
        </thead>
        <tbody>
                @foreach($report_global[$type] as $ocorrencie => $values)
                    <?php $total = $values['morning'] + $values['afternoon'] + $values['night'] + $values['extraNight']  ; ?>
                    @if($total > 0)
                        <tr>


                            <th colspan="6">
                                {{ $ocorrencie }}
                            </th>
                            <td>
                                {{$values['morning']}}
                            </td>
                            <td>
                                {{$values['afternoon']}}
                            </td>
                            <td>
                                {{$values['night']}}
                            </td>
                            <td>
                                {{$values['extraNight']}}
                            </td>
                            <td style="background-color:#af0808a1; font-weight:bold; color: #fff;">
                                {{ $total }}
                            </td>
                        </tr>
                    @endif 
                @endforeach
        </tbody>
    </table>
    @endif
    @endif
@endforeach

<?php $uniquesTypes = [
        "Abuso Sexual",
        "Violência Doméstica",
        "Orientação",
        "Não sabe"
    ]; 
?>

@foreach($uniquesTypes as $uType)
<?php $totalG = 0; ?>
@foreach($report_global[$uType] as $ocorrencie => $values)
    <?php $totalG += $values['morning'] + $values['afternoon'] + $values['night'] + $values['extraNight']  ; ?>
@endforeach
@if($totalG > 0)
<table>
    <caption class="tab-color"><strong>Tipo de Ocorrência: {{$uType}}</strong></caption>
    <thead class="tab-line">
        <tr>
            <th colspan="6" rowspan="2">Ocorrência</th>
            <th colspan="4" rowspan="1">Turno</th>
            <th style="background-color:#af0808c9; font-weight:bold; color: #fff;" colspan="1" rowspan="2">Total</th>
        </tr>
        <tr>
            <th colspan="1">Manhã</th>
            <th colspan="1">Tarde</th>
            <th colspan="1">Noite</th>
            <th colspan="1">Extra Noite</th>
        </tr>
    </thead>
    <tbody>
            @foreach($report_global[$uType] as $ocorrencie => $values)
                <?php $total = $values['morning'] + $values['afternoon'] + $values['night'] + $values['extraNight']  ; ?>
                @if($total > 0)
                    <tr>
                        <th colspan="6">
                            {{ $ocorrencie }}
                        </th>
                        <td>
                            {{$values['morning']}}
                        </td>
                        <td>
                            {{$values['afternoon']}}
                        </td>
                        <td>
                            {{$values['night']}}
                        </td>
                        <td>
                            {{$values['extraNight']}}
                        </td>
                        <td style="background-color:#af0808a1; font-weight:bold; color: #fff;">
                            {{ $total }}
                        </td>
                    </tr>
                @endif 
            @endforeach
    </tbody>
</table>
@endif
@endforeach



    



 