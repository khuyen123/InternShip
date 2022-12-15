@extends('admin.main')

@section('content')
    <div class="container-fluid">
        <button style="width:150px" type="button" class="btn btn-success" data-toggle="modal" data-target="#create_user_form">
            Thêm Người dùng
        </button>
        <button style="width:150px" type="button" class="btn btn-info" data-toggle="modal" id="selectall_user">
           Chọn hết
        </button>
        <button style="width:150px" type="button" class="btn btn-warning" data-toggle="modal" id="unselectall_user">
            Bỏ chọn hết
        </button>
        <button style="width:150px" type="button" class="btn btn-danger" data-toggle="modal" id="delete_all_user">
            Xóa hết
        </button>
        <button style="width:150px" type="button" class="btn btn-secondary" data-toggle="modal" id="search_user_button">
            <i class="fa fa-search" >Tìm kiếm</i>
        </button>
    </div>
<!-- Table of User List -->
    <table class="table" style="width:1000px">
        <thead>
            <tr>
                <th style="width: 10px">
                    <label style=" font-size:16px;">Chọn</label>
                </th>
                <th style="width: 50px">ID</th>
                <th>Họ tên</th>
                <th>Địa chỉ</th>
                <th>Số điện thoại</th>
                <th >Quyền truy cập</th>
                <th >Thao tác</th>
                
                <th style="width: 100px">&nbsp;</th>
            </tr>
        </thead>
        <tbody >
            {!! \App\Helpers\Helper::User($users) !!}
        </tbody>
    </table>
    <!-- End of Table -->
    <!-- Create User Form For Ajax start-->
    <div class="modal fade" id="create_user_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm mới người dùng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <form id="create_user" action="javascript: void(0) ">
                      
                            <div class="form-group">
                                <label for="name">Họ tên</label>

                                <input type="text"  class="form-control" name="name" id="name" placeholder="Nhập họ tên">
                            </div>
                            
                            <div class="form-group">
                                <label for="create_user_diachi">Địa chỉ</label>
                                <input value="{{old('DiaChi')}}" type="text" id="DiaChi"  name="DiaChi" class="form-control"></input>
                            </div>
                            <div class="form-group">
                                <label for="creat_user_SDT">Số điện thoại</label>
                                <input value="{{old('SDT')}}"id="SDT"  name="SDT" class="form-control"></input>
                            </div>
                            <div class="form-group">
                                <label for="description">Ngày sinh</label>
                                <input value="{{old('from-datepicker_create_user')}}" type="text" id="from-datepicker_create_user" name="NgaySinh" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label>Giới tính</label>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" value=1 type="radio" id="create_user_Nam" name="GioiTinh" checked="" />
                        
                                    <label for="create_user_Nam" class="custom-control-label">Nam</label>
                                </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" value=2 type="radio" id="Nu" name="GioiTinh"    />                 
                                    <label for="Nu" class="custom-control-label">Nữ</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description">Email</label>
                                <input  value="{{old('email')}}"  id="email" name="email" class="form-control"></input>
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
                                    <input class="custom-control-input" value=3 type="radio" id="client" name="roles" >
                                        
                                    <label for="client" class="custom-control-label">Khách hàng</label>
                                </div>
                        </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button type="submit" class="submit_create_user btn btn-primary">Thêm Mới</button>
                        </div>
                        @csrf
                    </form>
                </div>
            
            </div>
        </div>
        </div>
    <!-- Create User Form For Ajax End -->
    <!-- Edit User Form for Ajax start -->
    <div class="modal fade" id="edit_user_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa người dùng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <form id="edit_categories" >
                      
                            <div class="form-group">
                                <label for="name">Họ tên</label>
                                <input type="hidden" value="" name="edit_user_id" id="edit_user_id">
                                <input type="text"  class="form-control" name="edit_user_name" id="edit_user_name" placeholder="Nhập họ tên">
                            </div>
                            
                            <div class="form-group">
                                <label for="DiaChi">Địa chỉ</label>
                                <input type="text" id="edit_user_diachi"  name="edit_user_diachi" class="form-control"></input>
                            </div>
                            <div class="form-group">
                                <label for="DiaChi">Số điện thoại</label>
                                <input id="edit_user_SDT"  name="edit_user_SDT" class="form-control"></input>
                            </div>
                            <div class="form-group">
                                <label for="description">Ngày sinh</label>
                                <input value="" type="text" id="from-datepicker_edit_user" name="NgaySinh" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label>Giới tính</label>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" value=1 type="radio" id="edit_user_Nam" name="GioiTinh" />
                        
                                    <label for="edit_user_Nam" class="custom-control-label">Nam</label>
                                </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" value=2 type="radio" id="edit_user_Nu" name="GioiTinh"    />                 
                                    <label for="edit_user_Nu" class="custom-control-label">Nữ</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description">Email</label>
                                <input readonly  id="edit_user_email" name="edit_user_email" class="form-control"></input>
                            </div>
                            <div class="form-group">
                                <label for="password">Mật khẩu: </label>
                                <a style="color: #FFFFFF;" id="change_pass_button" class="btn btn-danger" >
                                    <i class="fa fa-key">&nbspThay đổi mật khẩu</i>
                                </a>
                            </div>
                            <div class="form-group">
                                <label>Quyền truy cập</label>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" value=2 type="radio" id="edit_user_employee" name="roles" >
                                       
                                    <label for="edit_user_employee" class="custom-control-label">Nhân viên</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" value=3 type="radio" id="edit_user_client" name="roles" >
                                        
                                    <label for="edit_user_client" class="custom-control-label">Khách hàng</label>
                                </div>
            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button type="submit" class="submit_edit_user btn btn-primary">Lưu</button>
                        </div>
                        @csrf
                    </form>
                </div>
            
            </div>
        </div>
        </div>
<!-- Edit User Form End -->
<!-- ChangePass Form Start -->

<div class="modal fade" id="change_password_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thay đổi mật khẩu người dùng:</h5>
                <input style="border-color: none;" readonly id="changepass_name" />
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <form id="change_password" action="javascript: void(0) ">
                    <div class="form-group">
                            <label for="name">Mật khẩu mới</label>
                            <input type="text" class="form-control" name="new_pass" id="new_pass" placeholder="Nhập mật khẩu mới">
                        </div>
                        <div class="form-group">
                            <label for="name">Xác nhận mật khẩu mới</label>
                            <input type="text" class="form-control" name="repeat_pass" id="repeat_pass" placeholder="Xác nhận mật khẩu mới">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button type="submit" class="change_pass_user btn btn-primary">Lưu</button>
                        </div>
                        @csrf
                    </form>
                </div>
            
            </div>
        </div>
        </div>
<!-- ChangePass Form End -->
<!-- Search Form Start -->
<div class="modal fade" id="search_user_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tìm kiếm người dùng:</h5>
                
            </div>
                <div class="modal-body">
                    <form id="search_user_form" action="{{route('search')}}" method="get">
                    <div class="form-group">
                            <label for="name">Nhập nội dung cần tìm</label>
                            <input type="text" class="form-control" name="search_string" id="search_user_string" placeholder="Tên hoặc số điện thoại">
                        </div>
                        <div class="form-group" >
                                <ul id="suggest_search_user" style="list-style:none;">

                                </ul>
                        </div>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button type="submit" class="search_user_submit btn btn-primary"><i class="fa fa-search" >Tìm kiếm</i></button>
                        </div>
                        @csrf
                    </form>
                </div>
            
            </div>
        </div>
        </div>
<!-- Search Form End -->
    {!! $users->links('pagination::bootstrap-4') !!}
    <script src="{{asset('backend/admin/js/user.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script> 
    <script> 
        $( document ).ready(function() {     
        $("#from-datepicker_edit_user").datepicker({          
        format: 'yyyy-mm-dd' 
        });      
        });  
    </script> 
     <script> 
        $( document ).ready(function() {     
        $("#from-datepicker_create_user").datepicker({          
        format: 'yyyy-mm-dd' 
        });      
        });  
    </script> 
@endsection
