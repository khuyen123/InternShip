<?php 
namespace App\Repository\Eloquent;

use App\Models\User;
use App\Repository\UserRepositoryInterface;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /** 
      * Hàm constructor.
    *
    * @param User $user
    */
   public function __construct(User $user)
   {
       // Khai báo model 
       parent::__construct($user);
   }
   public function getAll()
   {
        return User::orderby('id')->paginate(5);
   }
   public function changePass($request, $user)
   {    
    $new_pass=$request->new_pass;
    
    if( Hash::make($new_pass) == $user->password)
    {
        Session::flash('error',"Thay đổi mật khẩu thất bại");
        return false;
    } else {
        $user->password = Hash::make($new_pass);
        $user->save();
        Session::flash('success',"Thay đổi mật khẩu thành công");
        return true;
    }
   }
}