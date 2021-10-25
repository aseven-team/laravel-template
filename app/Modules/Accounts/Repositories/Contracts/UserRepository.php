<?php

namespace App\Modules\Accounts\Repositories\Contracts;

use App\Modules\Accounts\Models\User;
use Illuminate\Support\Collection;

interface UserRepository
{
    public function get(): Collection;

    public function store(array $user);

    public function show($id, $throwOnNotFound = false): ?User;

    public function showByUsername($username, $throwOnNotFound = false): ?User;

    public function update($id, array $data);

    public function delete($id);
}
