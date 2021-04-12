<?php

namespace App\Models;

use App\Traits\HasTicketsScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Ticket
 * @property int $id
 * @property string $event
 * @property string $charge
 * @property string $event_date
 * @property string $buyer_id
 * @property string $available
 * @property string $created_by
 */
class Ticket extends Model
{
    use HasFactory;
    use HasTicketsScopes;

}
