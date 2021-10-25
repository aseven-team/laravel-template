<?php

namespace App\Modules\Accounts\Repositories;

use App\Modules\Accounts\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class EloquentUserRepository implements Contracts\UserRepository
{
    public function get(): Collection
    {
        $query = User::query();

        return $query->get();
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            return User::create($data);
        });
    }

    public function show($id, $throwOnNotFound = false): ?User
    {
        $user = User::query()->find($id);

        if (!$user instanceof User) {
            if ($throwOnNotFound) throw (new ModelNotFoundException())->setModel(User::class);

            return null;
        }

        return $user;
    }

    public function showByUsername($username, $throwOnNotFound = false): ?User
    {
        $user = User::query()->where('username', $username)->first();

        if (!$user instanceof User) {
            if ($throwOnNotFound) throw (new ModelNotFoundException())->setModel(User::class);

            return null;
        }

        return $user;
    }


    public function update($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $user = $this->show($id);

            $user->update($data);

            return $user;
        });
    }

    public function delete($id)
    {
        DB::transaction(function () use ($id) {
            $user = $this->show($id);
            return $user->delete();
        });
    }
}
