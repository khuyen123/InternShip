//Loadingpage
$(document).ready(function(){
    loadingpage();
})
function loadingpage(){
    $('#loading').css('opacity','1');
    setTimeout(function(){
        $('#loading').css('opacity','0');
    }, 1000);
}
//Xóa 
function removeUser(id, url){
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
                            'Đã xóa thành công người dùng.',
                            'success'
                        )
                        $(`#${id}`).remove();
                    }
                    
                },
                error:
                    Swal.fire(
                        'Thất Bại!',
                        'Xóa người dùng thất bại',
                        'error'
                    )
            })
        }
      })
}
//check Gender function for show detail user
function checkgender(gen)
{
    if (gen == 1)
        document.getElementById('edit_user_Nam').checked = true; else
        if (gen == 2)
        document.getElementById('edit_user_Nu').checked = true;
}

//check role function for show detail user
function checkrole(role)
{
    if (role == 2)
        document.getElementById('edit_user_employee').checked=true;
        else
        if (role == 3)
        document.getElementById('edit_user_client').checked = true;
}
//Show Details to Edit User
$(document).on('click','.edit_user',function(e){
    e.preventDefault();
    var user_id= $(this).val();
    $('#edit_user_form').modal('show');
    $.ajax({
        type: "Get",
        url: "find/"+ user_id,
        datatype: "JSON",
        success: function(response){
            $('#edit_user_id').val(response.user.id);
            $('#edit_user_name').val(response.user.name);
            $('#edit_user_diachi').val(response.user.DiaChi);
            $('#edit_user_SDT').val(response.user.SDT);
            $('#from-datepicker_edit_user').val(response.user.NgaySinh);
            $('#edit_user_email').val(response.user.email);
            checkrole(response.user.roles);
            checkgender(response.user.GioiTinh);
        }
        
    })
})
//check role to value for update user
function checkroletovalue()
{
    if (document.getElementById('edit_user_employee').checked)
        return 2; else return 3;
}
//check Gender to value function for update
function checkgendertovalue()
{
    if (document.getElementById('edit_user_Nam').checked)
        return 1; else return 2;
}
// Submit to update user
$(document).on('click','.submit_edit_user',function(e){
    e.preventDefault();
    var user_id = $('#edit_user_id').val();
    var data = {
        'name' : $('#edit_user_name').val(),
        'SDT' : $('#edit_user_SDT').val(),
        'DiaChi' : $('#edit_user_diachi').val(),
        'NgaySinh' : $('#from-datepicker_edit_user').val(),
        'roles' : checkroletovalue(),
        'GioiTinh' :checkgendertovalue()
    }
    $.ajax({
        type : "POST",
        url: "edit/"+user_id,
        data : data,
        datatype: "JSON",
        success: function(response){
            Swal.fire(
                'Thành công!',
                'chỉnh sửa người dùng thành công.',
                'success',
                
            ).then(
                function(){
                    location.reload();
                }
            )
            $('#edit_user_form').modal('hide')
        },
        error: function(){
            Swal.fire(
                'Thất bại!',
                'chỉnh sửa người dùng thất bại.',
                'error'
            )
        }
    })
})
//ChangePassword:
$(document).on('click','#change_pass_button',function(){
    $('#change_password_form').modal('show');
    var user_id = $('#edit_user_id').val();
    $.ajax({
        type: "Get",
        url: "find/"+ user_id,
        datatype: "JSON",
        success: function(response){
            $('#changepass_name').val(response.user.name);
        }
    })
})
//submit for changepass:
$(document).on('click','.change_pass_user',function(){
    var user_id = $('#edit_user_id').val();
    $.ajax({
        type: "POST",
        url: "edit/changePass/"+user_id,
        data: $('#change_password').serialize(),
        success: function(response){
            Swal.fire(
                'Thành Công!',
                'Thay đổi mật khẩu Người dùng thành công!',
                'success'
            )
            $('#change_password_form').modal('hide');
        },
        error:function(){
            Swal.fire(
                'Thất bại!',
                'Thay đổi mật khẩu thất bại',
                'error'
            )
        }
    })
})
//Create User
$(document).on('click','.submit_create_user', function(){
    $.ajax({
        type: "POST",
        url: "create",
        data: $('#create_user').serialize(),
        success: function(response){
            Swal.fire(
                'Thành công!',
                'Thêm người dùng thành công',
                'success'
            ).then(
                function(){
                    location.reload();
                }
            )
        },
        error: function(){
            Swal.fire(
                'Thất bại!',
                'Thêm người dùng thất bại',
                'error'
            )
        }
    })
})