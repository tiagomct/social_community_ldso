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

function entryTypeShowHtml($object)
{
    $entries = [
        \App\Referendum::class       => action('ReferendumsController@show', $object->id),
        \App\ForumEntry::class       => action('ForumEntriesController@show', $object->id),
        \App\IdeaEntry::class        => action('IdeaEntriesController@show', $object->id),
        \App\MalfunctionEntry::class => action('MalfunctionEntriesController@show', $object->id),
    ];

    return '<a href="' . $entries[get_class($object)]
        . '" class="btn btn-primary pull-right"><i class="fa fa-eye"></i> View '
        . entryTypeName($object) . '</a>';
}
