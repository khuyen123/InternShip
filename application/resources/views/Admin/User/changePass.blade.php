@extends('admin.main')

@section('head')

@endsection

@section('content')

    <form action="" method="POST">
        <div class="card-body">
            <div class="form-group">
                <label for="name">Mật khẩu mới</label>
                <input type="text" class="form-control" name="new_pass" id="new_pass" placeholder="Nhập mật khẩu mới">
            </div>
            <div class="form-group">
                <label for="name">Xác nhận mật khẩu mới</label>
                <input type="text" class="form-control" name="repeat_pass" id="repeat_pass" placeholder="Xác nhận mật khẩu mới">
            </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Thay đổi</button>
        </div>
        @csrf
    </form>
@endsection

@section('footer')

    <!-- Change date Formet to yyyy/mm/đ -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script> 
    <script> 
        $( document ).ready(function() {     
        $("#from-datepicker").datepicker({          
        format: 'yyyy-mm-dd' 
        });      
        });  
    </script> 
@endsection
