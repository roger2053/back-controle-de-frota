<table style="table-layout: fixed; width: 710px;">
    <thead>
        <tr>
            <td style="font-weight:bold;" colspan="3">Transporte:</td>
            <td colspan="3">{{ $sheets->used_transport ?? 'Não Informado' }}</td>
            <td style="font-weight:bold;" colspan="3">Equipe:</td>
            <td colspan="3">{{ $sheets->used_transport_team ?? 'Não Informado' }}</td>
        </tr>
        <tr>
            <td style="font-weight:bold;" colspan="3">Comunicação:</td>
            <td colspan="3">{{ $sheets->used_transport_comunication ?? 'Não Informado' }}</td>
            <td style="font-weight:bold;" colspan="3">Partida:</td>
            <td colspan="3">{{ $sheets->used_transport_start ?? 'Não Informado' }}</td>
        </tr>
    </thead>
</table>
