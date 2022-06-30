<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cliente extends Model
{
    use HasFactory;

    public $table = 'cliente';

    protected $fillable = [
        'nome',
        'telefone',
    ];

    protected $dates = [
        'data_nascimento',
    ];

    public $timestamps = false;

    /**
     * Get the user that owns the Cliente
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pedido(): BelongsTo
    {
        return $this->belongsTo(Pedido::class, 'id_cliente', 'id');
    }
}
