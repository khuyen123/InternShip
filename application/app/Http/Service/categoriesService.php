<?php 
namespace App\Http\Service;

use App\Models\Categories;
use App\Repository\CategoryRepositoryInterface;
use App\Repository\Eloquent\CategoryRepository;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class categoriesService
{
    private $categoryRepository;
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository=$categoryRepository;
    }
    public function getCategoriesParent()
    {
        return $this->categoryRepository->getCategoriesParent();
    }
    public function find($id)
    {
        return $this->categoryRepository->find($id);
    }
    public function getALL()
    {
        return $this->categoryRepository->getAll();
    }
    public function create($request)
    {
        $dataform = $request->all();
        $dataform['slug']=Str::slug($request->input('name'),'-');
        
        $dataform['status']=$request->active;
        $this->categoryRepository->create($dataform);
        return true;
    }
    public function destroyMany($request)
    {
        try {
            return Categories::destroy($request->id); 
        } catch (\Throwable $th) {
            return false;
        }
       
    }
    public function destroy($request)
    {
        $id= $request->id;
        $categories = $this->categoryRepository->find($id);
        if($categories){
            return $this->categoryRepository->delete($id);
        } else
        return false;
    }
    public function update($request,$categories)
    {
        $dataform= $request->all();
        $category=$this->categoryRepository->find($request->id);
        $this->categoryRepository->update($category,$dataform);
        Session::flash('success',"Chỉnh sửa danh mục thành công");
        return true;
    }
}