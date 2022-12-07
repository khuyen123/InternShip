@extends('admin.main')

@section('content')
    <div class="container-fluid">
        <button style="width:150px" type="button" class="btn btn-success" data-toggle="modal" data-target="#create_categories_js">
            Thêm danh mục
        </button>
        <button style="width:150px" type="button" class="btn btn-warning" data-toggle="modal" id="unselectall_categories">
            Bỏ chọn hết
        </button>
        <button style="width:150px" type="button" class="btn btn-danger" data-toggle="modal" id="delete_all_categories">
            Xóa hết
        </button>
    </div>
<!-- Form Create Categories_ Ajax -->
        <div class="modal fade" id="create_categories_js" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm danh mục</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <form id="create_categories" action="javascript: void(0) ">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Tên danh mục</label>
                                <input type="text" value="{{old('name')}}" class="form-control" name="name" id="name" placeholder="Nhập tên danh mục">
                            </div>
                            <div class="form-group">
                                <label for="category">Danh mục</label>
                                <select class="form-control" name="parent_id">
                                    <option value="0">Danh mục cha</option>
                                    @foreach($categories_parent as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="description">Mô tả</label>
                                <input id="description" value="{{old('description')}}" name="description" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="description">Nội dung</label>
                                <input id="content" value="{{old('content')}}" name="content" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="description">Chức Năng Chính</label>
                                <input id="function" value="{{old('function')}}" name="function" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label>Kích hoạt</label>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" value=1 type="radio" id="active" name="active" checked="">
                                    <label for="active" class="custom-control-label">Có</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" value=0 type="radio" id="no_active" name="active">
                                    <label for="no_active" class="custom-control-label">Không</label>
                                </div>
                            </div>

        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button type="submit" id="add_button" class="btn btn-primary">Thêm danh mục</button>
                        </div>
                        @csrf
                    </form>
                </div>
            
            </div>
        </div>
        </div>
        <!-- Update Categories Form _ Ajax -->
        <div class="modal fade" id="update_categories_js" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa danh mục</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <form id="create_categories" >
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Tên danh mục</label>
                                <input type="text" value="{{old('name')}}" class="form-control" name="name" id="name" placeholder="Nhập tên danh mục">
                            </div>
                            <div class="form-group">
                                <label for="category">Danh mục</label>
                                <select class="form-control" name="parent_id">
                                    <option value="0">Danh mục cha</option>
                                    @foreach($categories_parent as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="description">Mô tả</label>
                                <input id="description" value="{{old('description')}}" name="description" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="description">Nội dung</label>
                                <input id="content" value="{{old('content')}}" name="content" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="description">Chức Năng Chính</label>
                                <input id="function" value="{{old('function')}}" name="function" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label>Kích hoạt</label>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" value=1 type="radio" id="active" name="active" checked="">
                                    <label for="active" class="custom-control-label">Có</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" value=0 type="radio" id="no_active" name="active">
                                    <label for="no_active" class="custom-control-label">Không</label>
                                </div>
                            </div>

                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary">Thêm danh mục</button>
                        </div>
                        @csrf
                    </form>
                </div>
            
            </div>
        </div>
        </div>
        
        <!-- List Categories -->
    <table class="table" style="width:1000px">
        <thead>
            <tr>
                <th style="width: 150px">
                    <input type="checkbox" id="select_all_categories"/><label style="font-size:16px;"for="select_all_categories">Chọn hết</label>
                </th>
                <th style="width: 50px">ID</th>
                <th>Tên danh mục</th>
                <th>Kích hoạt</th>
                <th >Chức Năng</th>
                <th >&nbsp;</th>
                <th >Thao tác</th>
                
                <th style="width: 100px">&nbsp;</th>
            </tr>
        </thead>
        <tbody id='list_cate'>
        
            <!-- {!! \App\Helpers\Helper::Categories($categories) !!} -->
        </tbody>
        <!-- End of list categories  using ajax -->
        <!-- start of Edit Categories Form -->
        <div class="modal fade" id="edit_categories" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa danh mục</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <form id="edit_categories" >
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Tên danh mục</label>
                                <input type="text"  class="name form-control" name="name" id="edit_name" placeholder="Nhập tên danh mục">
                                <input type="hidden" id="edit_id"/>
                            </div>
                            <div class="form-group">
                                <label for="category">Danh mục</label>
                                <select class="form-control" id="edit_parent" name="parent_id">
                                    <option value="0">Danh mục cha</option>
                                    @foreach($categories_parent as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="description form-group">
                                <label for="description">Mô tả</label>
                                <input id="edit_description" name="description" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="description">Nội dung</label>
                                <input   id="edit_content" name="content" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="description">Chức Năng Chính</label>
                                <input   id="edit_function" name="function" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label>Kích hoạt</label>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" value=1 type="radio" id="edit_active" name="active" >
                                  
                                    <label for="edit_active" class="custom-control-label">Có</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" value=0 type="radio" id="edit_no_active" name="active">
                                   
                                    <label for="edit_no_active" class="custom-control-label">Không</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button type="submit" class="edit_categories_js btn btn-primary">Lưu</button>
                        </div>
                        @csrf
                    </form>
                </div>
            
            </div>
        </div>
        </div>


        <!-- End of Edit Categories Form -->

    </table>
    
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="{{asset('backend/admin/js/category.js')}}"></script>
<script>
    
</script>


    <!-- {!! $categories->links('pagination::bootstrap-4') !!} -->
@endsection
