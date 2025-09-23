<table style="table-layout: fixed; width: 710px;">
    <thead>
        <tr>
            @if($sheets->support_fireplace == "sim")
                <td colspan="3">Corpo de Bombeiros</td>
            @endif
            @if($sheets->support_military_police == "sim")
                <td colspan="3">Polícia Militar</td>
            @endif
        </tr>
    </thead>
</table>
