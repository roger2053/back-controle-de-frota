    <div class="table-div">

        <table>
            <caption><strong>Tipos de Ocorrência</strong></caption>
            <thead class="tab-line">
                <tr>
                    <th colspan="6" rowspan="2">Ocorrência</th>
                    <th colspan="4" rowspan="1">Turno</th>
                    <th class="total-tab" colspan="1" rowspan="2">Total</th>
                </tr>
                <tr>
                    <th colspan="1">Manhã</th>
                    <th colspan="1">Tarde</th>
                    <th colspan="1">Noite</th>
                    <th colspan="1">Extra Noite</th>
                </tr>
            </thead>
            <tbody>
                <?php $total = array("morning" => 0, "afternoon" => 0, "night" => 0, "extraNight" => 0 ) ?>
                @foreach($report_global['ocorrenciesTotal'] as $ocorrencieName => $values)
                @if($values['total'] > 0)
                    <tr>
                        <th colspan="6">{{ $ocorrencieName }}</th>
                        <td>{{ $values['morning'] }} </td> <?php $total['morning'] += $values["morning"] ?>
                        <td>{{ $values['afternoon'] }}</td> <?php $total['afternoon'] += $values["afternoon"] ?>
                        <td>{{ $values['night'] }}</td> <?php $total['night'] += $values["night"] ?>
                        <td>{{ $values['extraNight'] }}</td> <?php $total['extraNight'] += $values["extraNight"] ?>
                        <td class="total">{{ $values['total'] }}</td>
                    </tr>
                @endif
                @endforeach
                <tr class="total">
                    <th class="total-tab"colspan="6">TOTAL GERAL</th>
                    <td><strong>{{ $total["morning"] }}</strong></td>
                    <td><strong>{{ $total["afternoon"] }}</strong></td>
                    <td><strong>{{ $total["night"] }}</strong></td>
                    <td><strong>{{ $total['extraNight'] }}</strong></td>
                    <td><strong>{{ intval( $total["morning"] + $total["afternoon"] + $total["night"] + $total["extraNight"] ) }}</strong></td>
                </tr>                
            </tbody>
        </table>

    </div>