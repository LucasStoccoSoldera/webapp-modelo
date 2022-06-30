<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pedido extends Model
{
    use HasFactory;

    public $table = 'pedido';

    protected $fillable = [
        'id_cliente',
    ];

    public $timestamps = false;

    /**
     * Get all of the comments for the Pedido
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cliente(): HasMany
    {
        return $this->hasMany(Cliente::class, 'id', 'id_cliente');
    }

    /**
     * Get the user that owns the Pedido
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pedidoproduto(): BelongsTo
    {
        return $this->belongsTo(PedidoProduto::class, 'id_pedido', 'id');
    }
}
