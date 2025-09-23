<table style="table-layout: fixed; width: 710px;">
    <thead>
        <tr>
            <td style="font-weight: bold;" colspan="12">{{ $sheets->incident_canceled ? 'Acidente Cancelado' : '' }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;" colspan="12">{{ $sheets->incident_outside ? 'Não se Encontrava no Local do Acidente' : '' }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;" colspan="12">{{ $sheets->incident_removed_third_party ? 'Removido por Terceiros' : '' }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;" colspan="12">{{ $sheets->incident_refused_hospitalization ? 'Recusou Hospitalização' : '' }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;" colspan="12">{{ $sheets->incident_death_in_place ? 'Obto no Local' : '' }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;" colspan="12">{{ $sheets->incident_death_in_transport ? 'Obto no Transporte' : '' }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;" colspan="12">{{ $sheets->incident_refused_service ? 'Recusou Atendimento' : '' }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;" colspan="12">{{ $sheets->another_details ? 'Outros' : '' }}</td>
        </tr>
    </thead>
</table>
