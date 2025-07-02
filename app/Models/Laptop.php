<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

/**
 * Class Laptop.
 *
 * @author  Ernes Wihanda <ernes.422023031@civitas.ukrida.ac.id>
 *
 * @OA\Schema(
 *     description="Laptop model",
 *     title="Laptop model",
 *     required={"name", "price"},
 *     @OA\Xml(
 *         name="Laptop"
 *     )
 * )
*/
class Laptop extends Model
{
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by', 'id');
    }
}
