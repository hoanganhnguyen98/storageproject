@extends('app')

@section('content')
<div class="row">
    <div class="col-3">
        <a href="/send-report" type="button" class="btn btn-outline-secondary" target="_blank">
            Send Report/Gửi báo cáo
        </a>
    </div>
    <div class="col-3">
        <a href="/report-list" type="button" class="btn btn-outline-secondary" target="_blank">
            Report List/Danh sách báo cáo
        </a>
    </div>
    <div class="col-3">
        <a href="" type="button" class="btn btn-outline-secondary" target="_blank">
            New Report/Báo cáo mới
            @if($total_new_reports != 0)
                <span class="badge badge-danger">{{ $total_new_reports }}</span>
            @endif
        </a>
    </div>
    <div class="col-3">
        <a href="" type="button" class="btn btn-outline-secondary" target="_blank">
            Reply List/Danh sách phản hồi
        </a>
    </div>
</div>
@endsection