<?php
namespace App\Repository;

use App\Model\User;
use Illuminate\Support\Collection;

interface CategoryRepositoryInterface
{
    public function getAll();
    public function getCategoriesParent();
 
   
}