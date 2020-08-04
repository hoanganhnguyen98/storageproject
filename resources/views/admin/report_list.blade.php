@extends('app')

@section('content')
<div class="row col">
    <h4>Report List</h4>
</div>
<table class="table">
    <thead class="thead-light">
        <tr>
            <th scope="col">Number</th>
            <th scope="col">Title</th>
            <th scope="col">Sign Date</th>
            <th scope="col">Type</th>
            <th scope="col">Detail</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reports as $report)
        <tr>
            <td>{{ $report->report_number }}</td>
            <td>{{ $report->title }}</td>
            <td>{{ $report->sign_date }}</td>
            <td>{{ $report->type }}</td>
            <td><a href="/report-detail-{{ $report->id }}" target="_blank">More detail</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection