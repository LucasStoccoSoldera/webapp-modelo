<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Produto extends Model
{
    use HasFactory;

    public $table = 'produto';

    protected $fillable = [
        'nome',
        'preco',
    ];

    public $timestamps = false;

    /**
     * Get the user that owns the Pedido
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pedidoproduto(): BelongsTo
    {
        return $this->belongsTo(PedidoProduto::class, 'id_produto', 'id');
    }
}
