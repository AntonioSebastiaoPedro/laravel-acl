<?php
namespace App\Repositories;

use App\DTOs\Users\CreateUserDTO;
use App\DTOs\Users\EditUserDTO;
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

    public function findById(string $id): ?User
    {
        return $this->user->find($id);
    }

    public function update(EditUserDTO $UserDTO): bool
    {
        if(!$user = $this->findById($UserDTO->id)){
            return false;
        }
        $data = (array) $UserDTO;
        unset($data['password']);
        if($UserDTO->password !== null){
            $data['password'] = bcrypt($UserDTO->password);
        }
        return $user->update($data);
    }

    public function delete(string $id): bool
    {
        if(!$user = $this->findById($id)){
            return false;
        }
        return $user->delete();
    }
    
}