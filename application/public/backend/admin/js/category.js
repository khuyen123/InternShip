$(document).ready(function(){
    fetchCate();
})
//get current-checked in localstorage
var selectedChecked = [];
var allid=[];
var currentChecked=[]
var a = localStorage.getItem('arraytoChecked');
if(a!=null){
var current=a.split(',');
$.each(current, function(key,item){
    currentChecked.push(parseInt(item));
})
}
//Get All Categories
function fetchCate(){
    
    $('#loading').css('opacity','1');
    var status;
    $.ajax({
        type: "GET",
        url: "/admin/categories/fetchCate",
        dataType: "json",
        success: function(response){
        setTimeout(function(){
            $('#loading').css('opacity','0');
        }, 1000);
        //Get the table to ''
        $('#list_cate').html('');
        //print the categories list
        $.each(response.categories.data, function(key,item){
            allid.push(item.id);
            selected(item.id);
            if (item.status == 1) {
                status='<span style="font-size:16px;" class="badge badge-success">Có</span>'
            } else { 
                status='<span style="font-size:16px;" class="badge badge-danger btn-sm">Không</span>'
            }
            $('#list_cate').append('<tr id="'+item.id+'">\
                <td><input class="checkbox-category"  type="checkbox" id="key'+item.id+'" /></td>\
                <td>'+item.id+'</td>\
                <td>'+item.name+'</td>\
                <td>'+status+'</td>\
                <td>'+item.function+'<td>\
                <td><button value="'+item.id+'" class="edit_cate btn btn-primary btn-sm"><i class="fas fa-edit"></i></button></td>\
                <td><button value="'+item.id+'" class="delete_cate btn btn-danger btn-sm"><i class="fas fa-trash"></i></button></td>\
            </tr>');
            if(currentChecked.includes(item.id))
                $('#key'+item.id).prop('checked',true);
        });
        
        if(currentChecked.length==allid.length || currentChecked.length==allid.length+1)
            $('#select_all_categories').prop('checked',true);
        }
    });
} 
//Thêm
$(document).on('click', '#add_button', function(){
    $.ajax({
        type: "POST",
        url: "/admin/categories/create",
        data: $('#create_categories').serialize(),
        success: function(response) {
            Swal.fire(
                'Thành công!',
                'Thêm danh mục thành công.',
                'success'
            ).then(
                function(){
                    location.reload();
                }
            )
            
            $('#create_categories_js').modal('hide')
        },
        error: function(error) {
            Swal.fire(
                'Thất bại!',
                'Thêm danh mục thất bại.',
                'error'
            )
            
        }
    });
});
//select-all Button
    $(document).on('click','#select_all_categories', function() {
        if($('#select_all_categories').prop('checked') == true ){
            $.each(allid, function(key,item){
                if(!selectedChecked.includes(item)) selectedChecked.push(item)
                $('#key'+item).prop('checked',true);    
            })
            
            localStorage.setItem('arraytoChecked',selectedChecked); 
        } else {
            localStorage.removeItem('arraytoChecked');
            $('.checkbox-category').prop('checked',false);
            selectedChecked = [];
            localStorage.removeItem('arraytoChecked');
        }
    })
//unselect-all Button
    $(document).on('click','#unselectall_categories',function(){
        selectedChecked = [];
        localStorage.clear('arraytoChecked');
        $('#select_all_categories').prop('checked',false) ;
        $.each(allid, function(key,item) {
            $('#key'+item).prop('checked',false);
        })
    })
//Select Category 
function selected(id)
{
    selectedChecked=currentChecked;
    
    $(document).on('click','#key'+id, function(){
        if (selectedChecked.includes(id)){
            selectedChecked.splice(selectedChecked.indexOf(id),1);
            
            $('#select_all_categories').prop('checked',false);
        } else selectedChecked.push(id);
        localStorage.setItem('arraytoChecked',selectedChecked);
        if((selectedChecked.length == allid.length))
            $('#select_all_categories').prop('checked',true);
        else if(selectedChecked.length == 0)
            localStorage.removeItem('arraytoChecked');
    })  
}
//DeleteMany Function

$(document).on('click','#delete_all_categories',function(e){
    e.preventDefault();
    
    var url='destroyMany';
    if(localStorage.getItem('arraytoChecked')!=null & localStorage.getItem('arraytoChecked')!='NaN')
    removeManyRow(currentChecked,url)
});
function removeManyRow(id, url){
    Swal.fire({
        title: 'Bạn có muốn xóa không?',
        text: "Xóa xong không thể khôi phục!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Xác nhận!'
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'DELETE',
                datatype: 'JSON',
                data: { id },
                url: url,
                success: function (result){
                    if (result.error==false){
                        Swal.fire(
                            'ĐÃ xóa!',
                            'Đã xóa thành công danh mục.',
                            'success'
                        )
                        $.each(id,function(key,item){
                            $(`#${item}`).remove();
                        })
                        localStorage.removeItem('arraytoChecked');
                    }
                },
                error: function(){
                    Swal.fire(
                        'Thất bại!',
                        'Xóa danh mục thất bại.',
                        'error'
                    )
                }

            })
        }
      })
}
//Checked Active function
function check( status ){
    if (status == 1)
        document.getElementById('edit_active').checked = true; else
        document.getElementById('edit_no_active').checked = true;
}
//Show details
$(document).on('click','.edit_cate',function(e){
    e.preventDefault();
    var cate_id=$(this).val();
    $('#edit_categories').modal('show');
    $.ajax({
        type:"GET",
        url:"find/"+cate_id,
        dataType: "json",
        success: function(response){
            $('#edit_name').val(response.category.name),
            $('#edit_parent').val(response.category.parent_id),
            $('#edit_description').val(response.category.description),
            $('#edit_content').val(response.category.content),
            $('#edit_function').val(response.category.function),
            $('#edit_active').val(response.category.status),
            $('#edit_id').val(response.category.id),
            check(response.category.status);     
        }
    });
});
//Check status to value function
function checkvalue (){
    if (document.getElementById('edit_active').checked)
    {
        return 1;
    } else return 0;
}

//Edit categories
$(document).on('click','.edit_categories_js',function(e) {
    var status = checkvalue();
    e.preventDefault();
    var edit_cate_id = $('#edit_id').val();
    var data = {
        'name' : $('#edit_name').val(),
        'parent_id' : $('#edit_parent').val(),
        'description' : $('#edit_description').val(),
        'content' : $('#edit_content').val(),
        'function' : $('#edit_function').val(),
        'status' : status,
    }
    $.ajax({
        type: "POST",
        url: "edit/"+edit_cate_id,
        data: data,
        dataType: "json",
        success: function(response){
            Swal.fire(
                'Thành công!',
                'chỉnh sửa danh mục thành công.',
                'success'
            ).then(fetchCate())
            
            $('#edit_categories').modal('hide')
        },
        error: function(errors){
            Swal.fire(
                'Thất bại!',
                'chỉnh sửa danh mục thất bại.',
                'error'
              
            )
        }
    })
});
//Xóa 
$(document).on('click','.delete_cate',function(e){
    e.preventDefault();
    var dele_id = $(this).val();
    var url='delete';
    removeRow(dele_id,url)
});
function removeRow(id, url){
    Swal.fire({
        title: 'Bạn có muốn xóa không?',
        text: "Xóa xong không thể khôi phục!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Xác nhận!'
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'DELETE',
                datatype: 'JSON',
                data: { id },
                url: url,
                success: function (result){
                    if (result.error==false){
                        Swal.fire(
                            'ĐÃ xóa!',
                            'Đã xóa thành công danh mục.',
                            'success'
                        )
                        $(`#${id}`).remove();
                    }
                },
                error: function(){
                    Swal.fire(
                        'Thất bại!',
                        'Xóa danh mục thất bại.',
                        'error'
                    )
                }
            })
        }
      })
}