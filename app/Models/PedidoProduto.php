<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PedidoProduto extends Model
{
    use HasFactory;

    public $table = 'pedido_produto';

    protected $fillable = [
        'id_pedido',
        'id_produto',
        'qtde',
    ];

    public $timestamps = false;

    /**
     * Get all of the comments for the Pedido
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pedido(): HasMany
    {
        return $this->hasMany(Pedido::class, 'id', 'id_pedido');
    }

    /**
     * Get all of the comments for the Pedido
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function produto(): HasMany
    {
        return $this->hasMany(Produto::class, 'id', 'id_produto');
    }
}
