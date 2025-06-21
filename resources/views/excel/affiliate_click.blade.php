<table>
    <thead>
        <tr>
            @foreach($exportCols as $col)
                <th>{{ $col }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($affiliate_clicks as $affiliate_click)
            <tr>
                @foreach($exportCols as $col)
                    <td>{{ $affiliate_click->$col }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>