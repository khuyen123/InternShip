@extends('admin.main')

@section('head')
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
@endsection

@section('content')
    <form action="" method="POST">
        <div class="card-body">
            <div class="form-group">
                <label for="name">Tên danh mục</label>
                <input type="text" value="{{$category->name}}" class="form-control" name="name" id="name" placeholder="Nhập tên danh mục">
            </div>
            <div class="form-group">
                <label for="category">Danh mục</label>
                <select class="form-control" name="parent_id">
                    <option value="0">Danh mục cha</option>
              
                    @foreach($categories as $categoryParent)
                        <option value="{{$categoryParent->id}}"  
                            {{$category->parent_id==$categoryParent->id ? 'selected': '' }}>
                            {{$categoryParent->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="description">Mô tả</label>
                <textarea id="description"  name="description" class="form-control">{{$category->description}}</textarea>
            </div>
            <div class="form-group">
                <label for="description">Nội dung</label>
                <textarea id="content"  name="content" class="form-control">{{$category->content}}</textarea>
            </div>
            <div class="form-group">
                <label for="description">Chức Năng Chính</label>
                <textarea id="function"  name="function" class="form-control">{{$category->function}}</textarea>
            </div>
            <div class="form-group">
                <label>Kích hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value=1 type="radio" id="active" name="status" 
                    {{$category->status==1 ? 'checked':''}}>
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value=0 type="radio" id="no_active" name="status"
                    {{$category->status==0 ? 'checked' : ''}}>
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div>

        </div>
        <!-- /.card-body -->
        <?php

use Illuminate\Support\Facades\Auth;

$role= Auth::user()->roles;
       if( $role == 1 or $role ==2)
        echo '<div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </div>';
        ?>
        @csrf
    </form>
@endsection

@section('footer')
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor 4
        // instance, using default configuration.
        CKEDITOR.replace( 'description' );
    </script>
@endsection
