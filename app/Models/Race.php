<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Race extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'name',
        'name_plural',
        'name_male',
        'name_female',
        'active',
        'avaible_registration',
        'icon',
        'image',
        'url',
        'description'
    ];

    protected $appends = [
        'icon_url',
        'image_url',
        'character_number',
    ];


    /**
     * Restituisce l'url completo dell'icona della razza
     *
     * @return void
     */
    public function getIconUrlAttribute(){
        if($this->icon){
            return Storage::url($this->icon);
        }

        return null;
    }

    /**
     * Restituisce l'url completo dell'immagine della razza
     *
     * @return void
     */
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return Storage::url($this->image);
        }

        return null;
    }

    /**
     * Restituisce il numero di appartenenti alla razza
     * character_number
     *
     * @return void
     *
     * todo: da implementare quando verranno creati i personaggi
     */
    public function getCharacterNumberAttribute()
    {
        return 0;
    }

}
