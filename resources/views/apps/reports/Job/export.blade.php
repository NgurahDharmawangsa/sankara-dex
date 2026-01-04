<table>
    <tr>
        <th colspan="7" style="text-align: center; font-size: 20px;"><strong>JOBS REPORT</strong></th>
    </tr>
    <tr>
        <th colspan="7" style="text-align: center;"><strong>{{ $from }} - {{ $to }}</strong></th>
    </tr>
    <tr>
        <th colspan="7"></th>
    </tr>
    <tr>
        <th style="border: 1px solid #000; text-align: center;"><strong>No</strong></th>
        <th style="border: 1px solid #000; text-align: center;"><strong>Date</strong></th>
        <th style="border: 1px solid #000; text-align: center;"><strong>User</strong></th>
        <th style="border: 1px solid #000; text-align: center;"><strong>Detail</strong></th>
        <th style="border: 1px solid #000; text-align: center;"><strong>Kategori</strong></th>
        <th style="border: 1px solid #000; text-align: center;"><strong>SubKategori</strong></th>
        <th style="border: 1px solid #000; text-align: center;"><strong>Duration (Minute)</strong></th>
    </tr>
    @if(count($jobs) > 0)
        @foreach($jobs as $key => $job)
            <tr>
                <td style="border: 1px solid #000; text-align: center;">{{ $key+1 }}</td>
                <td style="border: 1px solid #000;">{{ $job->created_at->format('Y-m-d') }}</td>
                <td style="border: 1px solid #000;">{{ $job->user->name }}</td>
                <td style="border: 1px solid #000; width: 90px;" class="text-wrap">{{ $job->title }}</td>
                <td style="border: 1px solid #000;">{{ $job->subcategory->category->name}}</td>
                <td style="border: 1px solid #000;">{{ $job->subcategory->name }}</td>
                <td style="border: 1px solid #000;">{{ $job->duration }}</td>
            </tr>
        @endforeach
    @endif
</table>
