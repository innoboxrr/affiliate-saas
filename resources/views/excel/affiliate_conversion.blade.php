<table>
    <thead>
        <tr>
            @foreach($exportCols as $col)
                <th>{{ $col }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($affiliate_conversions as $affiliate_conversion)
            <tr>
                @foreach($exportCols as $col)
                    <td>{{ $affiliate_conversion->$col }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>