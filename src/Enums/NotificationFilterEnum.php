<?php

namespace ARKEcosystem\Hermes\Enums;

final class NotificationFilterEnum
{
    const ALL = 'all';

    const READ = 'read';

    const UNREAD = 'unread';

    const STARRED = 'starred';

    const UNSTARRED = 'unstarred';

    public static function isAll(string $value):bool
    {
        return $value === static::ALL;
    }
}
