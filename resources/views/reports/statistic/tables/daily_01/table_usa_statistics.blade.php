<table>
    <thead class="table-header" >
        <tr >
            <th colspan="6" rowspan="1" style="margin:0; padding:0;">Estatística</th>
            <th colspan="1" rowspan="1" class="tab-color2">Total</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 0; ?>
        @foreach($report_global['report'] as $estatistica => $values)
        <tr class="{{($i%2==0)?'tab-line':''}}">
            @if(str_contains($estatistica, 'Attendance USA-01') || str_contains($estatistica, 'Attendance USA-02')
            || str_contains($estatistica, 'Transfer USA-01' ) || str_contains($estatistica, 'Transfer USA-02' )
            || str_contains($estatistica, 'Transport USA-01')|| str_contains($estatistica, 'Transport USA-02') )
            @if(str_contains($estatistica, 'Attendance'))
            <td colspan="6">{{ str_replace('Attendance','Atendimento',$estatistica) }}</td>
            @elseif(str_contains($estatistica, 'Transfer'))
            <td colspan="6">{{ str_replace('Transfer','Tranferência',$estatistica) }}</td>
            @elseif(str_contains($estatistica, 'Transport'))
            <td colspan="6">{{ str_replace('Transport','Transporte',$estatistica) }}</td>
            @endif

            <!-- <td>{{ $values['morning'] }}</td>
            <td>{{ $values['afternoon'] }}</td>
            <td>{{ $values['night'] }}</td>
            <td>{{ $values['extraNight'] }}</td>
            <td><strong> {{ $values['total'] }} </strong></td> -->
            <td colspan="1" class="{{($i%2==0)?'tab-line2':'tab-line3'}}">{{ $report_global['report'][$estatistica]['extraNight']+$report_global['report'][$estatistica]['morning']+$report_global['report'][$estatistica]['afternoon']+$report_global['report'][$estatistica]['night'] }}</td>
            @endif
        </tr>

        <?php $i++; ?>

        @endforeach
    </tbody>

</table>