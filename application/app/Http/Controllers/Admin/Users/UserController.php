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
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

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
        $data=$request->all();
        $result = $this->userService->update($data,$user);
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
        
        $data=$request->all();
        $data['token']= strtoupper(Str::random(10));
        if( $new_user = $this->userService->register($data)){
            Mail::send('Admin.email.active_account',compact('new_user'),function($email) use ($new_user){
                $email->subject('Xác nhận tài khoản đăng ký');
                $email->to($new_user->email, $new_user->name);
            });
            Session::flash('success',"Đăng ký thành công, vui lòng vào email để xác thực");
            return redirect('admin/user/login');
            
        } else {
            return redirect()->back();
        }
    }
    public function activeAccount(User $user,$token){
        $data['status']=1;
        $data['token'] = '';
        if ($token == $user->token){
            $this->userService->update($data,$user);
            Session::flash('success','Xác thực thành công, bạn có thể đăng nhập');
            return redirect('admin/user/login');
            
        }
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
