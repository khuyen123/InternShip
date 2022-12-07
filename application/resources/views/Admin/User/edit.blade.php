@extends('admin.main')

@section('head')

@endsection

@section('content')

    <form action="" method="POST">
        <div class="card-body">
            <div class="form-group">
                <label for="name">Họ tên</label>
                <input type="hidden" value="{{$user->id}}" name="id">
                <input type="text" value="{{$user->name}}" class="form-control" name="name" id="name" placeholder="Nhập họ tên">
            </div>
           
            <div class="form-group">
                <label for="DiaChi">Địa chỉ</label>
                <input type="text" id="DiaChi" value="{{$user->DiaChi}}" name="DiaChi" class="form-control"></input>
            </div>
            <div class="form-group">
                <label for="DiaChi">Số điện thoại</label>
                <input id="SDT" value="{{$user->SDT}}" name="SDT" class="form-control"></input>
            </div>
            <div class="form-group">
                <label>Giới tính</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value=1 type="radio" id="Nam" name="GioiTinh" 
                    {{$user->GioiTinh == 1 ? 'checked':''}}>
                    <label for="Nam" class="custom-control-label">Nam</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value=2 type="radio" id="Nu" name="GioiTinh" 
                    {{$user->GioiTinh == 2 ? 'checked':''}}>
                    <label for="Nu" class="custom-control-label">Nữ</label>
                </div>
            </div>
            <div class="form-group">
                <label for="description">Ngày sinh</label>
                <input value="{{$user->NgaySinh}}" type="text" id="from-datepicker" name="NgaySinh" class="form-control"/>
            </div>
            <div class="form-group">
                <label for="description">Email</label>
                <input readonly value="{{$user->email}}" id="email" name="email" class="form-control"></input>
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu: </label>
                <a class="btn btn-danger" href="changePass/{{$user->id}}">
                    <i class="fas fa-password">Thay đổi mật khẩu</i>
                </a>
            </div>
            <div class="form-group">
                <label>Quyền truy cập</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value=2 type="radio" id="employee" name="roles" 
                    {{$user->roles == 2 ? 'checked':''}}>
                    <label for="employee" class="custom-control-label">Nhân viên</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value=3 type="radio" id="client" name="roles" 
                    {{$user->roles == 3 ? 'checked':''}}>
                    <label for="client" class="custom-control-label">Khách hàng</label>
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Chỉnh sửa</button>
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
