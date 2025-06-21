<table>
    <thead>
        <tr>
            @foreach($exportCols as $col)
                <th>{{ $col }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($affiliate_payouts as $affiliate_payout)
            <tr>
                @foreach($exportCols as $col)
                    <td>{{ $affiliate_payout->$col }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>