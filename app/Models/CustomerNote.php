<?php
/**
 * Created by PhpStorm.
 * Filename: CustomerNote.php
 * User: Orhan BAHAR
 * Date: 20.07.2021
 * Time: 16:04
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CustomerNote extends Model
{
    protected $table = 'customer_note';
    public $timestamps = false;

    protected $fillable = [
        'site_id',
        'admin_id',
        'customer_id',
        'message',
        'date',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'admin_id');
    }

    public function customer(): HasOne
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }
}
