<table class="table table-striped nowrap table-bordered"
    @if ($id) id="{{ $id }}" @endif>
    <thead>
        <tr>
            <th class="text-start"></th>
            @foreach ($headers as $header)
                <th class="text-start">{{ $header }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($rows as $row)
            <tr>
                <td class="text-start"></td>
                <td class="text-start">{{ $row['nik'] }}</td>
                <td class="text-start">{{ $row['nama'] }}</td>
                <td class="text-start">{{ $row['jabatan'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
