<?php

namespace ARKEcosystem\Hermes\Models\Concerns;

trait HasRelatedNotifications
{
  public function relatedNotifications()
  {
      return $this->morphMany(config('hermes.models.notification'), 'relatable');
  }

  /**
   * Register any events for your application.
   *
   * @return void
   */
  protected static function bootHasRelatedNotifications()
  {
      static::deleting(function (self $model) {
        $model->relatedNotifications()->delete();
      });
  }
}
