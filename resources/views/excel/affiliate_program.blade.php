<table>
    <thead>
        <tr>
            @foreach($exportCols as $col)
                <th>{{ $col }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($affiliate_programs as $affiliate_program)
            <tr>
                @foreach($exportCols as $col)
                    <td>{{ $affiliate_program->$col }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>