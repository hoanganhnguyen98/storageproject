@extends('app')

@section('content')
@if(Session::has('success'))
    <div class="alert alert-success">
        {!! Session::get('success') !!}
    </div>
@endif

@if(Session::has('error'))
    <div class="alert alert-danger">
        {!! Session::get('error') !!}
    </div>
@endif
<form method="POST" action="{{ route('send_report') }}" enctype="multipart/form-data">
    @csrf
    <div class="container">
        <div class="row col">
            <h4>Send report for users</h4>
        </div>

        <!-- Report information -->
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Report Number</label>
                    <input type="text" name="report_name" class="form-control" placeholder="Enter report number" required>
                </div>
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Title" required>
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <label>Sign date</label>
                    <input type="date" name="sign_date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Choose report type</label>
                    <select name="type" class="btn-outline-secondary form-control" required>
                        <option value="a">Type A</option>
                        <option value="b">Type B</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Receivers -->
        <div class="row col">
            <div class="form-group">
                <label>Receivers list</label>
                <!-- Hiển thị danh sách người nhận báo cáo -->
                @foreach($users as $user)
                <div class="form-check">
                    <input class="form-check-input" name="receiver_id[]" type="checkbox" value="{{ $user->id }}">
                    <label class="form-check-label">
                        {{ $user->name }}
                    </label>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Files -->
        <div class="row col">
            <div class="form-group">
                <label>Sign file</label>
                <input type="file" name="sign_file" class="btn-outline-secondary form-control" required>
            </div>
        </div>
        <div class="row col">
            <div class="form-group">
                <label>Attach file</label>
                <input type="file" name="attach_file[]" class="btn-outline-secondary form-control" multiple required>
            </div>
        </div>


        <!-- Send button -->
        <div class="row col">
            <button type="submit" class="btn btn-secondary">Send</button>
        </div>
    </div>
</form>
@endsection