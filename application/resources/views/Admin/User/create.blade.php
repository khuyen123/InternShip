@extends('admin.main')

@section('head')

@endsection

@section('content')

    <form action="" method="POST">
        <div class="card-body">
            <div class="form-group">
                <label for="name">Họ tên</label>
                <input type="text" value="{{old('name')}}" class="form-control" name="name" id="name" placeholder="Nhập họ tên">
            </div>
           
            <div class="form-group">
                <label for="DiaChi">Địa chỉ</label>
                <input type="text" id="DiaChi" value="{{old('DiaChi')}}" name="DiaChi" class="form-control"></input>
            </div>
            <div class="form-group">
                <label for="DiaChi">Số điện thoại</label>
                <input id="SDT" value="{{old('SDT')}}" name="SDT" class="form-control"></input>
            </div>
            <div class="form-group">
                <label>Giới tính</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value=1 type="radio" id="Nam" name="GioiTinh" checked="">
                    <label for="Nam" class="custom-control-label">Nam</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value=2 type="radio" id="Nu" name="GioiTinh" checked="">
                    <label for="Nu" class="custom-control-label">Nữ</label>
                </div>
            </div>
            <div class="form-group">
                <label for="description">Ngày sinh</label>
                <input value="{{old('NgaySinh')}}" type="text" id="from-datepicker" name="NgaySinh" class="form-control"/>
            </div>
            <div class="form-group">
                <label for="description">Email</label>
                <input value="{{old('email')}}" id="email" name="email" class="form-control"></input>
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu</label>
                <input id="password"  name="password" class="form-control"></input>
            </div>
            <div class="form-group">
                <label for="repeat_password">Nhập lại Mật khẩu</label>
                <input id="repeat_password"  name="repeat_password" class="form-control"></input>
            </div>
            <div class="form-group">
                <label>Quyền truy cập</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value=2 type="radio" id="employee" name="roles" checked="">
                    <label for="employee" class="custom-control-label">Nhân viên</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value=3 type="radio" id="client" name="roles" checked="">
                    <label for="client" class="custom-control-label">Khách hàng</label>
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Thêm Mới</button>
        </div>
        @csrf
    </form>
@endsection

@section('footer')

    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script> 
    <script> 
        $( document ).ready(function() {     
        $("#from-datepicker").datepicker({          
        format: 'yyyy-mm-dd' //can also use format: 'dd-mm-yyyy'     
        });      
        });  
    </script> 
@endsection
