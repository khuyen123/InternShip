<?php
namespace App\Repository;

use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
  
   public function create(array $attributes): Model;

   /**
    * @param $id
    * @return Model
    */
   public function find($id): ?Model;
   public function update(Model $model, array $attributes):bool;
   public function delete($id): bool;
}
