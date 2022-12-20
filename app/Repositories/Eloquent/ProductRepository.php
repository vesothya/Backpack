<?php

namespace  App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Support\Collection;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function all(): Collection
    {
        return $this->model->all();
    }
}


?>