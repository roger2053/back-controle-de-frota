<table style="table-layout: fixed; width: 710px;">
    <thead>
        <tr>
            <td style="font-weight:bold;" colspan="3">Base:</td>
            <td colspan="3">{{ $sheets->transport_base ?? 'Não Informado' }}</td>
            <td style="font-weight:bold;" colspan="3">Local:</td>
            <td colspan="3">{{ $sheets->transport_local ?? 'Não Informado' }}</td>
        </tr>
        <tr>
            <td style="font-weight:bold;" colspan="3">Partida do local:</td>
            <td colspan="3">{{ $sheets->transport_origin ?? 'Não Informado' }}</td>
            <td style="font-weight:bold;" colspan="3">Destino:</td>
            <td colspan="3">{{ $sheets->transport_destination ?? 'Não Informado' }}</td>
        </tr>
        <tr>
            <td style="font-weight:bold;" colspan="3">Retorno:</td>
            <td colspan="3">{{ $sheets->transport_return ?? 'Não Informado' }}</td>
            <td style="font-weight:bold;" colspan="3">Enfermeiro(a):</td>
            <td colspan="3">{{ $sheets->transport_nurse ?? 'Não Informado' }}</td>
        </tr>
        <tr>
            <td style="font-weight:bold;" colspan="3">Técnico(a):</td>
            <td colspan="3">{{ $sheets->transport_technical ?? 'Não Informado' }}</td>
            <td style="font-weight:bold;" colspan="3">TARM:</td>
            <td colspan="3">{{ $sheets->transport_tarm ?? 'Não Informado' }}</td>
        </tr>
        <tr>
            <td style="font-weight:bold;" colspan="3">Rádio oper.:</td>
            <td colspan="3">{{ $sheets->transport_radio_operator ?? 'Não Informado' }}</td>
            <td style="font-weight:bold;" colspan="3">Condutor:</td>
            <td colspan="3">{{ $sheets->transport_conductor ?? 'Não Informado' }}</td>
        </tr>
        <tr>
            <td style="font-weight:bold;" colspan="3">Demais sit.:</td>
            <td colspan="3">{{ $sheets->transport_other_situations ?? 'Não Informado' }}</td>
        </tr>
    </thead>
</table>
