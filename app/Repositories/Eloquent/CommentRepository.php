<?php

namespace  App\Repositories\Eloquent;

use App\Models\Comment;
use App\Repositories\CommentRepositoryInterface;
use Illuminate\Support\Collection;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{
    public function __construct(Comment $model)
    {
        parent::__construct($model);
    }

    public function all(): Collection
    {
        return $this->model->all();
    }
}


?>