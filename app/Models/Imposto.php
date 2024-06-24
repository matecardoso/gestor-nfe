<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imposto extends Model
{
    protected $table = 'impostos';

	protected $fillable = [
		'icms_id',
        'ipi_id',
        'pis_id',
        'cofins_id',
        'importacao_id',
        'exportacao_id'
    ];

    public function icms()
    {
        return $this->belongsTo(Icms::class);
    }
    
    public function ipi()
    {
        return $this->belongsTo(Ipi::class);
    }
    
    public function pis()
    {
        return $this->belongsTo(Pis::class);
    }
    
    public function cofins()
    {
        return $this->belongsTo(Cofins::class);
    }

    public function importacao()
    {
        return $this->belongsTo(Importacao::class);
    }

    public function exportacao()
    {
        return $this->belongsTo(Exportacao::class);
    }
    
}
