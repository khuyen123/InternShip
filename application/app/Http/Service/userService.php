<?php 
namespace App\Http\Service;

use App\Models\User;
use App\Repository\Eloquent\UserRepository;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class userService
{
    protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function getALL()
    {
        return $this->userRepository->getAll();
    }
    public function getall_nopagenigate()
    {
        return $this->userRepository->getall_nopagenigate();
    }
    public function create($request)
    {
        $slug = false;
        $users=$this->getALL();
        foreach($users as $item => $user)
        {
            if($user->email == $request->input('email')){
                $slug = true;
            } 
        }
        $data = $request->all();
        if( !$slug){
        $password = Hash::make( $request->input('password'));  
        $data['password'] = $password; 
        $data['token'] = strtoupper(Str::random(10));
        try {
            $this->userRepository->create($data);
            Session::flash('success',"Thêm mới thành công");
        } catch (\Throwable $th) {
            Session::flash('error',"Thêm mới thất bại");
            return false;
        }
        return true;
    } else {
        Session::flash('error',"Email đã tồn tại");
        return false;
    }
    }
    public function register($data)
    {
        $slug = false;
        $users=$this->getALL();
        foreach($users as $item => $user)
        {
            if($user->email == $data['email']){
                $slug = true;
            } 
        }
        if( !$slug){
        $data['password'] = Hash::make( $data['password']); 
        try {
            
            return $this->userRepository->create($data);
            
        } catch (\Throwable $th) {
            Session::flash('error',"Thêm mới thất bại");
            return false;
        }
        
    } else {
        Session::flash('error',"Email đã tồn tại");
        return false;
    }
    }
    public function destroy($request)
    {
        $id= $request->id;
        $user=$this->userRepository->find($id);
        if($user){
            return $this->userRepository->delete($id);
        } 
        return false;
    }
    public function destroyMany($request)
    {
       return $this->userRepository->destroyMany($request);
    }
    public function search($request)
    {
        return $this->userRepository->search($request);
    }
    public function update($data,$user)
    {
     
        $this->userRepository->update($user,$data);
       
        return true;
    }
    public function changePass($request,$user)
    {
        return $this->userRepository->changePass($request,$user);
    }
    public function find($id)
    {
        return $this->userRepository->find($id);
    }
}