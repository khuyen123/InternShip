<?php

namespace App\Repository\Eloquent;

use App\Models\Categories;
use App\Repository\BaseRepositoryInterface;

use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Stmt\TryCatch;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }   
    public function find($id): ?Model
    {
        return $this->model->find($id);
    }
    public function update(Model $model, array $attributes): bool
    {
        return $model->update($attributes);
    }
    public function delete($id): bool
    {
        try {
            $this->model->destroy($id);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
       
    }
}