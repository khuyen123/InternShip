<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Categories\CreateRequest;
use App\Http\Service\categoriesService;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    protected $categoriesService;
    public function __construct(categoriesService $categoriesService)
    {
        $this->categoriesService = $categoriesService;
    }
    public function find($id)
    {
        $categories=$this->categoriesService->find($id);
        if( $categories)
        {
            return response()->json([
               'status'=> 200,
               'category'=>$categories 
            ]);
        } else {
            return response()->json([
                'status'=>404,
                'message'=>"Not Found"
            ]);
        }
    }
    public function getALL()
    {
        $categories= $this->categoriesService->getALL();
        return response()->json([
            'categories'=>$categories
        ]);
    }
    public function create()
    {
        $data = $this->categoriesService->getCategoriesParent();
        return view('Admin.Categories.create',[
                'title'=>"Thêm mới sản phẩm",
                'categories'=>$data
            ]);
    } 
    public function store(CreateRequest $request)
    {
            if ($this->categoriesService->create($request)) {
            return redirect('admin/categories/index');     
        }  else
        return redirect()->back();    
    }
    public function destroy(Request $request)
    {
        
        $result=$this->categoriesService->destroy($request);
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
    public function destroyMany(Request $request)
    {
        
        $result=$this->categoriesService->destroyMany($request);
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
    public function index()
    {
        // dd($this->categoriesService->getALL());   
        return view('Admin.Categories.list',[
            'title'=>"Danh sách danh mục",
            'categories'=>$this->categoriesService->getALL(),
            'categories_parent'=>$this->categoriesService->getCategoriesParent()
        ]);
    }
    public function show(Categories $categories)
    {
        $category=$this->categoriesService->getCategoriesParent();
        return view('Admin.Categories.edit',[
            'title'=>"Chỉnh sửa danh mục: ". $categories->name,
            'categories'=>$category,
            'category'=>$categories
        ]);
    }
    public function update(Categories $categories, CreateRequest $request) 
    {
        $this->categoriesService->update($request,$categories);
        return redirect()->back();
    } 
    public function update_2($id, CreateRequest $request) 
    {
        $categories = $this->categoriesService->find($id);
        $data = $this->categoriesService->update($request,$categories);
        return $data;
    } 
}
