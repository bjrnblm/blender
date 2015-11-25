<?php

namespace App\Models\Foundation\Traits;

use Vinkla\Translator\Translatable as BaseTranslatable;

trait Translatable
{
    use BaseTranslatable;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function translations()
    {
        return $this->hasMany($this->getTranslationModelName());
    }

    /**
     * @param $locale
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function translatefoobar($locale)
    {
        return $this->translateOrNew($locale);
    }

    /**
     * @return string
     */
    public function getTranslationModelName()
    {
        if (isset($this->translationModel)) {
            return $this->translationModel;
        }

        return 'App\\Models\\Translations\\'.short_class_name($this).'Translation';
    }
}
