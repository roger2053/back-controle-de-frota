<?php
$hospitals = $report_global['hospitals'];
$hospitalKeys = [];
$OriginHospital = [];
$DestinyHospital = [];

foreach ($report_global['transferDetails'] as $detail) {
    $hospitalKeys[$detail->transfer_destiny] = true;
    $hospitalKeys[$detail->transfer_origin] = true;
}

//FILTRAR OS HOSPITAIS QUE TEM VALORES
foreach ($hospitals as $key => $hospital) {
    if (!isset($hospitalKeys[$key])) {
        unset($hospitals[$key]);
    }
}

//FILTRAR OS HOSPITAIS DE ORIGEM
foreach ($hospitals as $key => $hospital) {
    foreach ($report_global['transferDetails'] as $detail) {
        if ($detail->transfer_origin == $key) {
            $OriginHospital[$key] = $hospital;
        }
        if ($detail->transfer_destiny == $key) {
            $DestinyHospital[$key] = $hospital;
        }
    }
}
?>
<div class="table-div">
    <table style="width: 100%;">
        <caption><strong>Detalhe de transferências<br>
                {{ $report_global['info']['initial_date'] }} até
                {{ $report_global['info']['final_date'] }}
            </strong></caption>
        <thead>
            <tr class="tab-line">
                <td class="total-tab">
                    Origem
                </td>

                @foreach ($DestinyHospital as $key => $hospital)
                    <td>{{ $hospital }}</td>
                @endforeach

                <td class="total-tab">
                    Total
                </td>
            </tr>
        </thead>
        <tbody>
            @foreach ($OriginHospital as $row => $origin)
                <?php $rowTotal = 0; ?>
                <tr>
                    <td class="tab-line">{{ $origin }}</td>
                    @foreach ($DestinyHospital as $collumn => $destiny)
                        <?php
                        $total = 0;
                        $has_transfer = false;
                        foreach ($report_global['transferDetails'] as $detail) {
                            if ($detail->transfer_origin == $row && $detail->transfer_destiny == $collumn) {
                                $total = $detail->total;
                                $has_transfer = true;
                                $rowTotal += $total;
                                break;
                            }
                        }
                        ?>
                        <td class="{{ $has_transfer ? 'total-cell' : '' }}">{{ $total }}</td>
                    @endforeach
                    <td class="total">{{ $rowTotal }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
