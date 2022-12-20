<?php

namespace App\Repositories;

use App\Models\Comment;
use Illuminate\Support\Collection;

interface CommentRepositoryInterface
{
    public function all(): Collection;
}

?>