<table style="table-layout: fixed; width: 100%;">
    <thead>
        <tr>
            <td>Solicitante</td>
        </tr>
        <tr>
            <td style="font-weight:bold;" colspan="1">Nome:</td>
            <td colspan="5">{{ $sheets->requester_name ?? 'Não Informado' }}</td>
            <td style="font-weight:bold;" colspan="3">Contato:</td>
            <td colspan="3">{{ $sheets->requester_contact ?? 'Não Informado' }}</td>
        </tr>
        <tr>
            <td>Endereço</td>
        </tr>
        <tr>
            <td style="font-weight:bold;" colspan="1">Rua:</td>
            <td colspan="5">{{ $sheets->patient_address ?? 'Não Informado' }}</td>
            <td style="font-weight:bold;" colspan="3">Número:</td>
            <td colspan="3">{{ $sheets->patient_number ?? 'Não Informado' }}</td>
        </tr>
        <tr>
            <td style="font-weight:bold;" colspan="1">Bairro:</td>
            <td colspan="5">{{ $sheets->patient_district ?? 'Não Informado' }}</td>
            <td style="font-weight:bold;" colspan="3">Cidade:</td>
            <td colspan="3">{{ $sheets->patient_city ?? 'Não Informado' }}</td>
        </tr>
        <tr>
            <td style="font-weight:bold;" colspan="1">Estado:</td>
            <td colspan="5">{{ $sheets->patient_state ?? 'Não Informado' }}</td>
        </tr>
    </thead>
</table>
