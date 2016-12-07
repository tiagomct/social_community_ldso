<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createRoles();
        $this->createVotingLocations();

        factory(App\User::class, 10)->create();
        factory(App\User::class)->create(['email' => 'user@mail.com', 'password' => bcrypt('123')]);

        $pollThreads = $this->createPollThreads();
        $this->pollThreadsCreatePollAnswers($pollThreads);

        $threads = $pollThreads;
        $threads = $this->createRemainingThreads($threads);
        $this->threadCreateRelatedClasses($threads);
    }

    private function createRoles()
    {
        factory(App\Role::class)->create([
            'title' => 'User'
        ]);
        factory(App\Role::class)->create([
            'title' => 'Moderator'
        ]);
        factory(App\Role::class)->create([
            'title' => 'Administrator'
        ]);
    }

    private function createVotingLocations()
    {
        factory(App\VotingLocation::class)->create([
            'district' => 'Porto',
            'county'   => 'Porto',
            'parish'   => 'Paranhos'
        ]);
    }

    /**
     * @param $threads
     */
    private function threadCreateRelatedClasses($threads)
    {
        /** @var \App\IsThread $thread */
        foreach ($threads as $thread) {
            $thread->comments()->saveMany(
                factory(App\Comment::class)->times(3)->make()
            );
            $thread->likes()->saveMany(
                factory(App\Like::class)->times(2)->make()
            );
            $thread->flags()->saveMany(
                factory(App\Flag::class)->times(2)->make()
            );
            $thread->follows()->saveMany(
                factory(App\EntryFollow::class)->times(2)->make()
            );

            /** @var \App\Comment $comment */
            foreach ($thread->comments as $comment) {
                $comment->likes()->saveMany(
                    factory(App\Like::class)->times(2)->make()
                );
            }
        }
    }

    private function pollThreadsCreatePollAnswers($pollableThreads)
    {
        /** @var \App\isPoll $pollableThread */
        foreach ($pollableThreads as $pollableThread) {
            $pollableThread->pollAnswers()->saveMany(
                factory(\App\PollAnswer::class)->times(3)->make()
            );
        }
    }

    /**
     * @return array
     */
    private function createPollThreads()
    {
        $pollThreads = [];
        $pollThreads[] = factory(App\Referendum::class, 3)->create(['approved' => true]);
        $pollThreads[] = factory(App\Referendum::class, 2)->create(['approved' => false]);

        return array_collapse($pollThreads);
    }

    /**
     * @param $threads
     * @return array
     */
    private function createRemainingThreads($threads)
    {
        $newThreads = [];
        $newThreads[] = factory(App\ForumEntry::class, 5)->create();
        $newThreads[] = factory(App\MalfunctionEntry::class, 5)->create();
        $newThreads[] = factory(App\NewsEntry::class, 5)->create();
        $pollThreads[] = factory(App\IdeaEntry::class, 5)->create();

        return array_merge($threads, array_collapse($newThreads));
    }
}
