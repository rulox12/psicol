<?php

namespace App\Models;

use App\Traits\HasBuyerScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Buyer
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $email
 * @property string $mobile
 * @property string $created_by
 */
class Buyer extends Model
{
    use HasFactory;
    use HasBuyerScopes;
}
