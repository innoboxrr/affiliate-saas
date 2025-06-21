<table>
    <thead>
        <tr>
            @foreach($exportCols as $col)
                <th>{{ $col }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($affiliate_links as $affiliate_link)
            <tr>
                @foreach($exportCols as $col)
                    <td>{{ $affiliate_link->$col }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>