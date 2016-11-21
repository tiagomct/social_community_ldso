<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReferendumControllerFunctionTest extends TestCase
{

    protected static $user;
    protected static $moderator;

    public function setUp()
    {
        parent::setUp();
        self::$user=\App\User::where('role_id',1)->first();
        self::$moderator=\App\User::where('role_id',2)->first();
    }


    /**
     * Tests if controller returns create form
     */
    public function tests_returning_create_form()
    {

        $response = $this->actingAs(self::$user)->action('GET', 'ReferendumsController@index');

        $this->assertResponseOk();
    }

    /**
     * Tests storing of referendum
     */
    public function tests_referendum_storing()
    {
        $response = $this->actingAs(self::$user)->action('POST', 'ReferendumsController@store',
            [
                'title' => 'Test store title',
                'description' => 'Test store description',
                'answers' => ['Test answer 1', 'Test answer 2', 'Test answer 3'],
            ]);

        $this->assertRedirectedToAction('ReferendumsController@index');
        $this->seeInDatabase('referendums', ['title' => 'Test store title']);

    }


    /**
     * Tests listing of referendums for users
     */
    public function tests_referendum_listing()
    {

        $response = $this->actingAs(self::$user)->action('GET', 'ReferendumsController@index');

        $this->assertResponseOk();
        $this->assertViewHas('referendums');
    }

    /**
     * Tests showing of referendum for a user
     */
    public function tests_referendum_show()
    {
        $referendum = \App\Referendum::approved()->first();


        $response = $this->actingAs(self::$user)->action('GET', 'ReferendumsController@show', $referendum->id );

        $this->assertResponseOk();

        $this->assertViewHasAll(['referendum', 'answers', 'userAnswerId', 'totalVotes']);

    }


    /**
     * Tests submit vote
     */
    public function tests_submit_vote()
    {
        $referendum = \App\Referendum::approved()->first();
        $referendumAnswer = $referendum->referendumAnswer->first();

        $response = $this->actingAs(self::$user)->action('GET', 'ReferendumsController@submitVote', [$referendum->id, $referendumAnswer->id]);

        $this->assertRedirectedToAction('ReferendumsController@show', $referendum->id);
        $this->seeInDatabase('votes', [
            'user_id' => self::$user->id,
            'referendum_answer_id' => $referendumAnswer->id
        ]);

    }

    /**
     * Tests submit comment
     */
    public function tests_submit_comment()
    {
        $referendum = \App\Referendum::approved()->first();

        $response = $this->actingAs(self::$user)->action('POST', 'ReferendumsController@submitComment', $referendum->id,[
                '_token' => csrf_token(),
                'content' => 'Test comment'
            ]);

        $this->assertResponseStatus(302);
        $this->seeInDatabase('referendum_comments', [
            'user_id' => self::$user->id,
            'referendum_id' => $referendum->id,
            'content' => 'Test comment'
        ]);

    }


    /**
     * Tests showing pending requests
     */
    public function tests_pending(){

        $referendum = \App\Referendum::notApproved()->first();

        $response = $this->actingAs(self::$moderator)->action('GET', 'ReferendumsController@pendingShow', $referendum->id);

        $this->assertResponseOk();
        $this->assertViewHasAll(['referendum', 'answers']);
    }

    /**
     * Tests approve of request
     */
    public function tests_approve()
    {
        $referendum = \App\Referendum::notApproved()->first();

        $response = $this->actingAs(self::$moderator)->action('GET', 'ReferendumsController@approve', $referendum->id);

        $this->assertRedirectedToAction('ReferendumsController@pendingList');
        $this->seeInDatabase('referendums', [
            'id' => $referendum->id,
            'approved' => true,
        ]);

    }
}
