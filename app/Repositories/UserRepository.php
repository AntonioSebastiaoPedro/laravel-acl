<?php
namespace App\Repositories;

use App\DTOs\Users\CreateUserDTO;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository
{
    public function __construct(protected User $user)
    {

    }

    public function getPaginate(int $totalPerPage = 15, int $page = 1, string $filter = ''): LengthAwarePaginator
    {
        return $this->user->where(function ($query) use ($filter){
            if($filter !== ''){
                $query->where('name', 'LIKE', "%{$filter}%");
            }
        })->paginate($totalPerPage, ['*'], $page);
    }

    public function createNew(CreateUserDTO $userDto): User
    {
        $data = (array) $userDto;
        $data['password'] = bcrypt($data['password']);
        
        return $this->user->create($data);
    }
}