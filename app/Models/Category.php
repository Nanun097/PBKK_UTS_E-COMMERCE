<?php
// Model 2: Category.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Category extends Model
{
    use HasFactory, HasUlids;

    protected $primaryKey = 'category_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'description'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'category_id');
    }
}