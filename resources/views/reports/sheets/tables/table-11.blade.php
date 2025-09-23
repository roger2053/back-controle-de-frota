<table style="table-layout: fixed; width: 710px;">
    <thead>
        <tr>
            @if(!empty($sheets->support_transport_place_motolancia))
                <td style="font-weight:bold;" colspan="3">Local:</td>
                <td colspan="3">{{ $sheets->support_transport_place_motolancia }}</td>
            @endif
            @if(!empty($sheets->support_transport_departure_from_location_motolancia))
                <td style="font-weight:bold;" colspan="3">Partida do Local:</td>
                <td colspan="3">{{ $sheets->support_transport_departure_from_location_motolancia }}</td>
            @endif
        </tr>
        <tr>
            @if(!empty($sheets->support_transport_destination_motolancia))
                <td style="font-weight:bold;" colspan="3">Destino:</td>
                <td colspan="3">{{ $sheets->support_transport_destination_motolancia }}</td>
            @endif
            <td style="font-weight:bold;" colspan="{{ $sheets->support_transport_return_motolancia ? 3 : 0 }}">{{ $sheets->support_transport_return_motolancia ? 'Retorno:' : '' }}</td>
            <td colspan="{{ $sheets->support_transport_return_motolancia ? 3 : 0 }}">{{ $sheets->support_transport_return_motolancia }}</td>
        </tr>
        <tr>
            @if(!empty($sheets->support_transport_base_motolancia))
                <td style="font-weight:bold;" colspan="3">Base Origem:</td>
                <td colspan="3">{{ $sheets->support_transport_base_motolancia }}</td>
            @endif
            @if(!empty($sheets->support_transport_doctor_motolancia))
                <td style="font-weight:bold;" colspan="3">Médico(a):</td>
                <td colspan="3">{{ $sheets->support_transport_doctor_motolancia }}</td>
            @endif
        </tr>
        <tr>
            @if(!empty($sheets->support_transport_nurse_motolancia))
                <td style="font-weight:bold;" colspan="3">Enfermeiro(a):</td>
                <td colspan="3">{{ $sheets->support_transport_nurse_motolancia }}</td>
            @endif
            <td style="font-weight:bold;" colspan="{{ $sheets->support_transport_technical_motolancia ? 3 : 0 }}">{{ $sheets->support_transport_technical_motolancia ? 'Técnico(a):' : '' }}</td>
            <td colspan="{{ $sheets->support_transport_technical_motolancia ? 3 : 0 }}">{{ $sheets->support_transport_technical_motolancia }}</td>
        </tr>
        <tr>
            @if (!empty($sheets->support_transport_tarm_motolancia))
                <td style="font-weight:bold;" colspan="3">TARM:</td>
                <td colspan="3">{{ $sheets->support_transport_tarm_motolancia }}</td>
            @endif
            <td style="font-weight:bold;" colspan="{{ $sheets->support_transport_radio_operator_motolancia ? 3 : 0}}">{{ $sheets->support_transport_radio_operator_motolancia ? 'Rádio Operador:' : ''}}</td>
            <td colspan="{{ $sheets->support_transport_radio_operator_motolancia ? 3 : 0}}">{{ $sheets->support_transport_radio_operator_motolancia }}</td>
        </tr>
        <tr>
            @if (!empty($sheets->support_transport_conductor_usb))
                <td style="font-weight:bold;" colspan="3">Condutor:</td>
                <td colspan="3">{{ $sheets->support_transport_conductor_usb }}</td>
            @endif
            @if (!empty($sheets->support_transport_other_situations_usb))
                <td style="font-weight:bold;" colspan="3">Demais Situações:</td>
                <td colspan="3">{{ $sheets->support_transport_other_situations_usb }}</td>
            @endif
        </tr>
    </thead>
</table>
