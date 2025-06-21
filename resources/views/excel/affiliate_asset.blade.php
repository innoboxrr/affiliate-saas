<table>
    <thead>
        <tr>
            @foreach($exportCols as $col)
                <th>{{ $col }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($affiliate_assets as $affiliate_asset)
            <tr>
                @foreach($exportCols as $col)
                    <td>{{ $affiliate_asset->$col }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>