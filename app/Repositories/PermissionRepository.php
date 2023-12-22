<?php
namespace App\Repositories;

use App\Models\Permission;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PermissionRepository
{
    public function __construct(protected Permission $permission)
    {}

    public function getPaginate(int $totalPerPage = 15, int $page = 1, string $filter = ''): LengthAwarePaginator
    {
        return $this->permission->where(function ($query) use ($filter){
            if($filter !== ''){
                $query->where('name', 'LIKE', "%{$filter}%")
                ->orWhere('description', 'LIKE', "%{$filter}%");
            }
        })->paginate($totalPerPage, ['*'], $page);
    }

    public function findtById(string $id): ?Permission
    {
        return $this->permission->find($id);
    }
}