<?php

function entryTypeName($object)
{
    $entries = [
        \App\Referendum::class       => 'Referendum',
        \App\ForumEntry::class       => 'Forum Entry',
        \App\IdeaEntry::class        => 'Idea',
        \App\MalfunctionEntry::class => 'Malfunction Report',
    ];

    return $entries[get_class($object)];
}

function entryTypeAction($object)
{
    $entries = [
        \App\Referendum::class       => action('ReferendumsController@show', $object->id),
        \App\ForumEntry::class       => action('ForumEntriesController@show', $object->id),
        \App\IdeaEntry::class        => action('IdeaEntriesController@show', $object->id),
        //\App\NewsEntry::class        => action('NewsEntriesController@show', $object->id),
        \App\MalfunctionEntry::class => action('MalfunctionEntriesController@show', $object->id),
    ];

    return $entries[get_class($object)];
}

/**
 * @param \Carbon\Carbon $timestamp
 */
function isToday($timestamp) {
    $now = \Carbon\Carbon::now();

    $diff = $now->diffInDays($timestamp);

    return $diff == 0;
}