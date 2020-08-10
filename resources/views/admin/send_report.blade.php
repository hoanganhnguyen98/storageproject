@extends('app')

@section('content')
<!-- thông báo thành công -->
@if(Session::has('success'))
    <div class="alert alert-success">
        {!! Session::get('success') !!}
    </div>
@endif

<!-- thông báo nếu có lỗi xảy ra không liên quan đến dữ liệu đầu vào -->
@if(Session::has('error'))
    <div class="alert alert-danger">
        {!! Session::get('error') !!}
    </div>
@endif

<!-- in ra các lỗi của Validator -->
@if($errors->any())
    <ul class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form method="POST" action="{{ route('send-report') }}" enctype="multipart/form-data">
    @csrf
    <div class="row col">
        <h4>Send report for users</h4>
    </div>

    <!-- Report information -->
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label>Report Number</label>
                <input type="text" name="report_number" class="form-control" placeholder="Enter report number" required>
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
            <small id="total_receivers" class="text-danger font-weight-bold"></small>
            <!-- Chọn tất cả -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="select-all">
                <label class="form-check-label">
                    Select all
                </label>
            </div>

            <!-- Hiển thị danh sách người nhận báo cáo -->
            @foreach($users as $user)
            <div class="form-check">
                <input class="form-check-input receiver-checkbox" name="receiver_id[]" type="checkbox" value="{{ $user->id }}">
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
</form>
@endsection

@section('custom_js')
<!-- Chức năng chọn tất cả -->
<script type="text/javascript">
    // tìm trong code mục có id = select-all
    document.getElementById('select-all').onclick = function() {
        // khi click vào ô, tìm tất cả các có name = receiver_id[] và chọn hết tất cả
        var checkboxes = document.getElementsByName('receiver_id[]');

        // và ngược lại, nếu bỏ chọn ô select all thì cũng bỏ chọn tất cả các ô
        for (var checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
    }
</script>

<!-- Hiển thị số lượng người nhận đã chọn -->
<script type="text/javascript">
    // khi người dùng click vào 1 ô checkbox bất kì
    $(".form-check-input").click(function(){
        // đếm số lượng các ô được chọn, trừ ô Select all
        var x = $(".receiver-checkbox:checked").length;

        // hiển thị số lượng ra màn hình
        $("#total_receivers").empty();
        $("#total_receivers").append(x + " selected");
    })
</script>
@endsection