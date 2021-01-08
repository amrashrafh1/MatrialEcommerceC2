<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Staudenmeir\EloquentEagerLimit\Relations\HasLimit;

class MorphToManyCustom extends MorphToMany
{
    use HasLimit;
}
?>
