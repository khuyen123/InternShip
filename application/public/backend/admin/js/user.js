var selectedUserOnPage = [];
var selectedUserOnLocal = [];
var alluser=[];
var alluserid = [];
//Get Current selected user onlocal storage:
if(localStorage.getItem('arrayOfSelectedUser')!=null ){
        $.each(localStorage.getItem('arrayOfSelectedUser').split(','),function(key,item){
            selectedUserOnLocal.push(parseInt(item));
            $('#user'+item).prop('checked',true);
        })
        selectedUserOnPage = selectedUserOnLocal;
        alluserid = selectedUserOnLocal;
    }
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
                        ).then(function(){
                            selectedUserOnPage.splice(selectedUserOnPage.indexOf(id),1);
                            localStorage.setItem('arrayOfSelectedUser',selectedUserOnPage);
                            location.reload();
                        })
                            
                            
                        
                    }
                    
                },
                error:
                    function(){
                    Swal.fire(
                        'Thất Bại!',
                        'Xóa người dùng thất bại',
                        'error'
                    )
                }
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
    $('#edit_user_form').modal('hide');
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
//Select All User:
$(document).on('click','#selectall_user', function(){
    
    $.ajax({
        type: "GET",
        url: "getAll",
        datatype: "Json",
        success: function(response){   
            $.each(response.users.data,function(key,user){
                $('#user'+user.id).prop('checked',true);
                if ( !selectedUserOnPage.includes(user.id) & user.roles!=1)
                    selectedUserOnPage.push(user.id);
            })
            localStorage.setItem('arrayOfSelectedUser',selectedUserOnPage);
        }
    })
})
//unSelect All User:
$(document).on('click','#unselectall_user', function(){
    $.each(selectedUserOnPage,function(key,item){
        $('#user'+item).prop('checked',false)
    })
    
    selectedUserOnPage = [];
    localStorage.removeItem('arrayOfSelectedUser');
    
})
//Select Many User
$(document).on('click','.checkbox_user', function(){
    var user_id = parseInt($(this).val());
    
    if (selectedUserOnPage.includes(user_id)){
        selectedUserOnPage.splice(selectedUserOnPage.indexOf(user_id),1);
        
    } else if(user_id!=1){
        selectedUserOnPage.push(user_id);
    }
    if (selectedUserOnPage.length == 0)
            localStorage.removeItem('arrayOfSelectedUser'); else
    localStorage.setItem('arrayOfSelectedUser',selectedUserOnPage);
    
})
//Delete Many Button:
$(document).on('click','#delete_all_user', function(){
    if(selectedUserOnPage.length !=0)
    removeUser(selectedUserOnPage,"deleteMany");
    localStorage.removeItem('arrayOfSelectedUser');
})
//Search Form Show
$(document).on('click','#search_user_button', function(){
    $('#search_user_form').modal('show');
})
//Funtion get all user:
function getalluser()
{
    $.ajax({
        type: "GET",
        url: "getAll",
        datatype: "Json",
        success: function(response){
            alluser = response.users.data;
        }
    })
}
//getAll userL to localstorage:
$(document).ready(function(){
    getalluser();
})
//Suggest Search User:
$(document).on('keyup','#search_user_string',function(){
    
    var text= $('#search_user_string').val();
    let arr = [];
    let html = '';
    if(text.length > 0) {
        arr = alluser.filter(user => user.name.toLowerCase().search(text.toLowerCase()) >= 0);
    } 
    if(arr.length > 0){
        $.each(arr, function(key,item){
            html += `<li><a>${item.name}</a></li>`;
        })
    }
    $('#suggest_search_user').html(html);
})
