<table style="table-layout: fixed; width: 710px;">
    <thead>
        <tr>
            @if(!empty($sheets->support_transport_place_usa))
                <td style="font-weight:bold;" colspan="3">Local:</td>
                <td colspan="3">{{ $sheets->support_transport_place_usa }}</td>
            @endif
            @if(!empty($sheets->support_transport_departure_from_location_usa))
                <td style="font-weight:bold;" colspan="3">Partida do Local:</td>
                <td colspan="3">{{ $sheets->support_transport_departure_from_location_usa }}</td>
            @endif
        </tr>
        <tr>
            @if(!empty($sheets->support_transport_destination_usa))
                <td style="font-weight:bold;" colspan="3">Destino:</td>
                <td colspan="3">{{ $sheets->support_transport_destination_usa }}</td>
            @endif
            <td style="font-weight:bold;" colspan="{{ $sheets->support_transport_return_usa ? 3 : 0 }}">{{ $sheets->support_transport_return_usa ? 'Retorno:' : '' }}</td>
            <td colspan="{{ $sheets->support_transport_return_usa ? 3 : 0 }}">{{ $sheets->support_transport_return_usa }}</td>
        </tr>
        <tr>
            @if(!empty($sheets->support_transport_base_usa))
                <td style="font-weight:bold;" colspan="3">Base Origem:</td>
                <td colspan="3">{{ $sheets->support_transport_base_usa }}</td>
            @endif
            @if(!empty($sheets->support_transport_doctor_usa))
                <td style="font-weight:bold;" colspan="3">Médico(a):</td>
                <td colspan="3">{{ $sheets->support_transport_doctor_usa }}</td>
            @endif
        </tr>
        <tr>
            @if(!empty($sheets->support_transport_nurse_usa))
                <td style="font-weight:bold;" colspan="3">Enfermeiro(a):</td>
                <td colspan="3">{{ $sheets->support_transport_nurse_usa }}</td>
            @endif
            <td style="font-weight:bold;" colspan="{{ $sheets->support_transport_technical_usa ? 3 : 0 }}">{{ $sheets->support_transport_technical_usa ? 'Técnico(a):' : '' }}</td>
            <td colspan="{{ $sheets->support_transport_technical_usa ? 3 : 0 }}">{{ $sheets->support_transport_technical_usa }}</td>
        </tr>
        <tr>
            @if (!empty($sheets->support_transport_tarm_usa))
                <td style="font-weight:bold;" colspan="3">TARM:</td>
                <td colspan="3">{{ $sheets->support_transport_tarm_usa }}</td>
            @endif
            <td style="font-weight:bold;" colspan="{{ $sheets->support_transport_radio_operator_usa ? 3 : 0}}">{{ $sheets->support_transport_radio_operator_usa ? 'Rádio Operador:' : ''}}</td>
            <td colspan="{{ $sheets->support_transport_radio_operator_usa ? 3 : 0}}">{{ $sheets->support_transport_radio_operator_usa }}</td>
        </tr>
        <tr>
            @if (!empty($sheets->support_transport_conductor_usa))
                <td style="font-weight:bold;" colspan="3">Condutor:</td>
                <td colspan="3">{{ $sheets->support_transport_conductor_usa }}</td>
            @endif
            @if (!empty($sheets->support_transport_other_situations_usa))
                <td style="font-weight:bold;" colspan="3">Demais Situações:</td>
                <td colspan="3">{{ $sheets->support_transport_other_situations_usa }}</td>
            @endif
        </tr>
    </thead>
</table>
