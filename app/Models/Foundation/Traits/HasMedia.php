<?php

namespace App\Models\Foundation\Traits;

use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Media;

/**
 * Don't forget to set protected $mediaLibraryCollections.
 */
trait HasMedia
{
    use HasMediaTrait;

    /**
     * @param array $attributes
     */
    protected function updateMediaLibraryFields($attributes)
    {
        if (!isset($this->mediaLibraryCollections)) {
            return;
        }

        foreach ($this->mediaLibraryCollections as $collectionName) {
            if (array_key_exists($collectionName, $attributes)) {
                $updatedMedia = $this->updateMedia(json_decode($attributes[$collectionName], true), $collectionName);
                foreach ($updatedMedia as $mediaItem) {
                    $mediaItem->setCustomProperty('temp', false);
                    $mediaItem->save();
                }
            }
        }
    }

    public function clearTemporaryMedia()
    {
        $this->media()->get()->each(function (Media $media) {
            if ($media->getCustomProperty('temp', false) === true) {
                $media->delete();
            }
        });
    }
}
