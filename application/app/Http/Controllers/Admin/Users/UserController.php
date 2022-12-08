<?php

namespace App\Http\Controllers\Admin\Users;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\ChangePassRequest;
use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Service\userService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{   
    protected $userService;
    public function __construct(userService $userService)
    {
        $this->userService = $userService;
    }
    public function index()
    {
            return view('Admin.User.list',[
                'title' => "Danh sách người dùng",
                'users' => $this->userService->getALL()
            ]); 
    }
    public function getAll()
    {
        $users = $this->userService->getall_nopagenigate();
        return response() -> json([
            'users'=>$users
        ]);
    }
    public function create()
    {
            return view('Admin.User.create',[
                'title'=>"Thêm mới người dùng"
            ]);
    }
    public function store(CreateRequest $request)
    {
            if($this->userService->create($request)){
                return redirect('admin/users/index');
            } else return redirect()->back();
    }
    public function destroy(Request $request)
    {
        $result=$this->userService->destroy($request);
        if ($result){
            return response()->json([
                'error'=> false,
                'message'=>"Xóa thành công"
            ]);
        } else
        return response()->json([
            'error'=>true
        ]);
    }
    public function destroyMany(Request $request)
    {
        $result=$this->userService->destroyMany($request);
        if ($result){
            return response()->json([
                'error'=> false,
                'message'=>"Xóa thành công"
            ]);
        }
        return response()->json([
            'error'=>true
        ]);
    }
    public function show(User $user)
    {
        return view('Admin.User.edit',[
            'title'=>"Chỉnh sửa người dùng: ". $user->name,
            'user' => $user
        ]);
    }
    public function update($user_id, UpdateRequest $request) 
    {
        $user = $this->userService->find($user_id);
        $result = $this->userService->update($request,$user);
        return $result;
    }
    public function search(Request $request)
    {
        $users= $this->userService->search($request);
        if ($users!=null){
        return view('Admin.User.list',[
            'title' => "Kết quả tìm kiếm",
            'users' => $users
        ]); 
    } else {
        return false;
    }
    }
    public function changePass(ChangePassRequest $request,  $user_id)
    {
        $user = $this->userService->find($user_id);
        
        return $this->userService->changePass($request,$user);
    }
    public function register()
    {
        return view('Admin.User.register',[
            'title'=>"Trang đăng ký"
        ]);
    }
    public function register_store(CreateRequest $request)
    {
        if($this->userService->create($request)){
            return redirect('admin/user/login');
            Session::flash('success',"Đăng ký thành công");
        } else return redirect()->back();
    }
    public function find($id)
    {
        $user = $this->userService->find($id);
        if ($user) {
            return response() -> json([
                'status' => 200,
                'user' => $user
            ]);
        } else {
            return response() -> json([
                'status' => 404,
                'message' => "Not Found"
            ]);
        }
    }
}
