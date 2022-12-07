<?php
namespace App\Repository\Eloquent;

use App\Models\Categories;
use App\Repository\CategoryRepositoryInterface;

use Illuminate\Database\Eloquent\Model;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{

    /** 
      * Hàm constructor.
    *
    * @param Categories $model
    */
   public function __construct(Categories $model)
   {
       // Khai báo model 
       parent::__construct($model);
   }
    public function getAll() {
        return Categories::orderby('parent_id')->paginate(0);
    }
    public function getCategoriesParent(){
        return Categories::where('parent_id',0)->get();
    }
}