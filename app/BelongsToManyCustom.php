<?php

namespace App;


use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Staudenmeir\EloquentEagerLimit\Relations\HasLimit;

class BelongsToManyCustom extends BelongsToMany
{
    use HasLimit;
}

?>
