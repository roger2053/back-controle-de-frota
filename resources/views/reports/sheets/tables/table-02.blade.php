
@foreach($victims as $victim)
<table style="table-layout: fixed; width:100%; margin-bottom:2px; border-bottom:1px solid #ccc;">
    <thead>
        <tr>
            <td style="font-weight:bold;"><strong>Nome da vítima: </strong>{{$victim->name}}</td>
            <td style="font-weight:bold;"><strong> Informações Básicas</td>
        </tr>
    </thead>
</table>
<table>
    <thead>
        <tr>
            <td style="font-weight:bold;" colspan="3">T. Ocorrencia:</td>
            <td colspan="3">{{ $victim->emergency ?? 'Não Informado' }}</td>
            <td style="font-weight:bold;" colspan="3">Gravidade:</td>
            <td colspan="3">{{ $victim->severity ?? 'Não Informado' }}</td>
        </tr>
        <tr>
            <td style="font-weight:bold;" colspan="3">Cel. paciente:</td>
            <td colspan="3">{{ $victim->contact ?? 'Não Informado' }}</td>
            <td style="font-weight:bold;" colspan="3">Idade:</td>
            <td colspan="3">{{ $victim->age ?? 'Não Informado' }}</td>
        </tr>
        <tr>
            <td style="font-weight:bold;" colspan="3">Traumato:</td>
            <td colspan="3">{{ $victim->emergency_type ?? 'Não Informado' }}</td>
            <td style="font-weight:bold;" colspan="3">Grupo:</td>
            <td colspan="3">{{ $victim->age_group ?? 'Não Informado' }}</td>
           
        </tr>
        <tr>
            <td style="font-weight:bold;" colspan="3"></td>
            <td colspan="3"></td>
            <td style="font-weight:bold;" colspan="3">Gênero:</td>
            <td colspan="3">{{ $victim->gender ?? 'Não Informado' }}</td>
        </tr>
        <tr>
            <td style="font-weight:bold;" colspan="3">Queixa:</td>
            <td colspan="5">
                @if($victim->complaint_medical) {{ $victim->complaint_medical }}
                @else
                    {{ $victim->complaint ?? 'Não informado' }}
                @endif 
            </td>
            
        </tr>
    </thead>
</table>
<table style="table-layout: fixed; width:100%; margin-bottom:2px; border-bottom:1px solid #ccc;">
    <thead>
        <tr>
            <td style="font-weight:bold;">Avaliação do Estado da vítima</td>
        </tr>
    </thead>
</table>
<table style="table-layout: fixed; width: 710px;">
    <thead>
        <tr>
            <td style="font-weight:bold; background-color: #e9e9e9;" colspan="3">Médico Regulador:</td>
            <td style="background-color: #e9e9e9;" colspan="3">{{ $sheets->doctor ?? 'Não Informado' }}</td>
            <td style="font-weight:bold;" colspan="2">Estado de:</td>
            <td colspan="4">{{ $victim->estate ?? 'Não Informado' }}</td>
        </tr>
        <tr>
            <td style="font-weight:bold;" colspan="2">Respiração:</td>
            <td colspan="4">{{ $victim->respiratory_frequency ?? 'Não Informado' }}</td>
            <td style="font-weight:bold;" colspan="2">Pulso:</td>
            <td colspan="4">{{ $victim->pulse ?? 'Não Informado' }}</td>
        </tr>
        <tr>
            <td style="font-weight:bold;" colspan="2">Agressivo?:</td>
            <td colspan="4">{{ $victim->aggressive ?? 'Não Informado' }}</td>
            <td style="font-weight:bold;" colspan="2">Dor aguda:</td>
            <td colspan="4">{{ $victim->acute_pain ?? 'Não Informado' }}</td>
        </tr>
        <tr>
            <td style="font-weight:bold;" colspan="2">Idade Gest.:</td>
            <td colspan="4">{{ $victim->pregnant_gestational_age ?? 'Não Informado' }}</td>
            <td style="font-weight:bold;" colspan="2">Medicamento:</td>
            <td colspan="4">{{ $victim->remedy_consult ?? 'Não Informado' }}</td>
        </tr>
        <tr>
            <td style="font-weight:bold;" colspan="2">Escala Glasgow:</td>
            <td colspan="4">{{ $victim->eye_opening + $victim->verbal_response + $victim->motor_response ?? 'Não Informado' }}</td>
            <td style="font-weight:bold;" colspan="2">Quanto tempo:</td>
            <td colspan="4">{{ $victim->how_much_time . ' hora(s)' ?? 'Não Informado' }}</td>
        </tr>
        <tr>
            <td style="font-weight:bold;" colspan="2">Observações:</td>
            <td colspan="4">{{ $victim->observations ?? 'Não Informado' }}</td>
        </tr>
    </thead>
</table>
<div>
    <strong>Evolução Médica:</strong>
    <br>
        {{ $victim->evolution }}
    <br>
    <hr>
</div>
@endforeach
@if($sheets->doctor_signature)
<div style="text-align: center; display:flex; flex-direction: row;">
    <b>Assinatura do Médico:</b><br>
    <b style="font-size: 9px;">{{ $sheets->doctor }} @if($sheets->doctor_crm) - CRM: {{ $sheets->doctor_crm }} @endif</b><br>
    <img width="200" src="{{ $sheets->doctor_signature }}" />
</div>
@endif