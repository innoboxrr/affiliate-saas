<table>
    <thead>
        <tr>
            @foreach($exportCols as $col)
                <th>{{ $col }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($affiliates as $affiliate)
            <tr>
                @foreach($exportCols as $col)
                    <td>{{ $affiliate->$col }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>