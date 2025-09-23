    <div class="table-div">
        <table>
            <caption><strong>Obitos</strong></caption>
            <thead>
                <tr class="tab-line">
                    <th colspan="6" rowspan="2">No local + Em transporte</th>
                    <th colspan="4" rowspan="1">Turno</th>
                    <th class="total-tab" colspan="1" rowspan="2">Total</th>
                </tr>
                <tr class="tab-line">
                    <th colspan="1">Manhã</th>
                    <th colspan="1">Tarde</th>
                    <th colspan="1">Noite</th>
                    <th colspan="1">Extra Noite</th>
                </tr>
            </thead>
            <tbody>
                <?php $total = array("morning" => 0, "afternoon" => 0, "night" => 0, "extraNight" => 0 ) ?>
                    <tr>
                        <th colspan="6">Obitos</th>
                        <td>{{ $report_global['morning']['deaths'] }} </td> <?php $total['morning'] += $report_global["morning"]['deaths'] ?>
                        <td>{{ $report_global['afternoon']['deaths'] }}</td> <?php $total['afternoon'] += $report_global["afternoon"]['deaths'] ?>
                        <td>{{ $report_global['night']['deaths'] }}</td> <?php $total['night'] += $report_global["night"]['deaths'] ?>
                        <td>{{ $report_global['extraNight']['deaths'] }}</td> <?php $total['extraNight'] += $report_global["extraNight"]['deaths'] ?>
                        <td class="total">{{ intval( $total["morning"] + $total["afternoon"] + $total["night"] + $total["extraNight"] ) }}</td>
                    </tr>              
            </tbody>
        </table>
    </div>




 