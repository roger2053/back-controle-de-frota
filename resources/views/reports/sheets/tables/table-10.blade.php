<table style="table-layout: fixed; width: 710px;">
    <thead>
        <tr>
            @if(!empty($sheets->support_transport_place_usb))
                <td style="font-weight:bold;" colspan="3">Local:</td>
                <td colspan="3">{{ $sheets->support_transport_place_usb }}</td>
            @endif
            @if(!empty($sheets->support_transport_departure_from_location_usb))
                <td style="font-weight:bold;" colspan="3">Partida do Local:</td>
                <td colspan="3">{{ $sheets->support_transport_departure_from_location_usb }}</td>
            @endif
        </tr>
        <tr>
            @if(!empty($sheets->support_transport_destination_usb))
                <td style="font-weight:bold;" colspan="3">Destino:</td>
                <td colspan="3">{{ $sheets->support_transport_destination_usb }}</td>
            @endif
            <td style="font-weight:bold;" colspan="{{ $sheets->support_transport_return_usb ? 3 : 0 }}">{{ $sheets->support_transport_return_usb ? 'Retorno:' : '' }}</td>
            <td colspan="{{ $sheets->support_transport_return_usb ? 3 : 0 }}">{{ $sheets->support_transport_return_usb }}</td>
        </tr>
        <tr>
            @if(!empty($sheets->support_transport_base_usb))
                <td style="font-weight:bold;" colspan="3">Base Origem:</td>
                <td colspan="3">{{ $sheets->support_transport_base_usb }}</td>
            @endif
            @if(!empty($sheets->support_transport_doctor_usb))
                <td style="font-weight:bold;" colspan="3">Médico(a):</td>
                <td colspan="3">{{ $sheets->support_transport_doctor_usb }}</td>
            @endif
        </tr>
        <tr>
            @if(!empty($sheets->support_transport_nurse_usb))
                <td style="font-weight:bold;" colspan="3">Enfermeiro(a):</td>
                <td colspan="3">{{ $sheets->support_transport_nurse_usb }}</td>
            @endif
            <td style="font-weight:bold;" colspan="{{ $sheets->support_transport_technical_usb ? 3 : 0 }}">{{ $sheets->support_transport_technical_usb ? 'Técnico(a):' : '' }}</td>
            <td colspan="{{ $sheets->support_transport_technical_usb ? 3 : 0 }}">{{ $sheets->support_transport_technical_usb }}</td>
        </tr>
        <tr>
            @if (!empty($sheets->support_transport_tarm_usb))
                <td style="font-weight:bold;" colspan="3">TARM:</td>
                <td colspan="3">{{ $sheets->support_transport_tarm_usb }}</td>
            @endif
            <td style="font-weight:bold;" colspan="{{ $sheets->support_transport_radio_operator_usb ? 3 : 0}}">{{ $sheets->support_transport_radio_operator_usb ? 'Rádio Operador:' : ''}}</td>
            <td colspan="{{ $sheets->support_transport_radio_operator_usb ? 3 : 0}}">{{ $sheets->support_transport_radio_operator_usb }}</td>
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
