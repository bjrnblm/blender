<?php

namespace App\Models;

use App\Models\Foundation\Traits\Presentable;
use App\Models\Foundation\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;

class Fragment extends Model
{
    use Presentable, Translatable;

    protected $guarded = ['id'];
    public $translatedAttributes = ['text'];

    public function updateWithRelations(array $attributes)
    {
        foreach (config('app.locales') as $locale) {
            $this->translatefoobar($locale)->text = $attributes[translate_field_name('text', $locale)];
        }

        return $this;
    }

    /**
     * Return a sluggified version the text of the string.
     *
     * @param $name
     * @param string $locale
     *
     * @return string
     */
    public static function getSlugAttribute($name, $locale = '')
    {
        return str_slug(static::getText($name, $locale));
    }
}
