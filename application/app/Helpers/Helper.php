<?php namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class Helper
{
    public static function Categories($categories,$parent_id=0,$char='')
    {
        $role= Auth::user()->roles;
        $html='';
        foreach($categories as $key => $category){
          
               
            if( $category->parent_id == $parent_id ){
                $html .= '
                    <tr id="'.$category->id.'">
                        <th style="width: 50px">'. $category->id .'</th>
                        <th>'. $char .$category->name .'</th>
                        <th>'. self::active($category->status) .'</th>
                        <th>'. $category->updated_at .'</th>
                        <th>'. $category->function .'</th>
                        <th style="width: 100px">
                   
                            <button class="edit_cate btn btn-primary btn-sm" href="/admin/categories/edit/' . $category->id . '">
                                <i class="fas fa-edit"></i>
                            </button>
                           
                            ';
                           
                            if($role == 1 or $role == 2){
                                $html .=
                            '<a class="btn btn-danger btn-sm"  onclick="removeRow(' . $category->id . ',\'/admin/categories/delete\')">
                                <i class="fas fa-trash"></i>
                            </a>
                      
                        </th>
                    </tr>
                ';} else { $html .= ' </th>
                    </tr>';}
                unset($categories[$key]);
                $html .=self::Categories($categories, $category->id, $char .'|--');
            }
        }
      
        return $html;
    }
    public static function User($users)
    {
        $html='';
        foreach($users as $key => $user){
                $html .= '
                
                    <tr id="'.$user->id.'">
                        ';if($user->roles != 1) $html.='<th><input class="checkbox_user" value="'.$user->id.'" style="height: 20px; width:20px" type="checkbox" id="user'.$user->id.'" /></th>';
                        else $html.='<th>&nbsp</th>';
                        $html.='
                        <th style="width: 50px">'. $user->id .'</th>
                        <th>'.$user->name .'</th>
                        <th>'. $user->DiaChi .'</th>
                        <th>'. $user->SDT .'</th>
                        <th>'. self::roles($user->roles) .'</th>
                        <th style="width: 100px">
                        ';
                           
                        if($user->roles != 1 ){
                            $html .='
                            <button class="edit_user btn btn-success btn-sm" value="'.$user->id.'" >
                                <i class="fas fa-edit"></i>
                            </button>
                            <a class="btn btn-danger btn-sm"  onclick="removeUser(' . $user->id . ',\'/admin/users/delete\')">
                                <i class="fas fa-trash"></i>
                            </a>
                      
                        </th>
                    </tr>
                ';} else { $html .= ' </th>
                    </tr>';}
                unset($users[$key]);
        }
      
        return $html;
    }
    public static function active($active=0):string
    {
        return $active==0 ? ' <span class="btn btn-danger btn-sm">Không</span>':'<span class="btn btn-success btn-sm">Có</span>';
    }
    public static function roles($role):string 
    {
        if ( $role == 1)
            return '<span class="badge badge-success" style="font-size: 18px;">Quản Trị</span>'; elseif( $role == 2)
            {
                return '<span class="badge badge-success" style="font-size: 16px;">Nhân Viên</span>';
            } else {
                return '<span class="badge badge-success" style="font-size: 16px;">Khách</span>';
            }
    }
}