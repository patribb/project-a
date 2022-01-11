<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Attendee;
use App\Models\Event;
use App\Models\Photo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PhotoController
 */
class PhotoControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $photos = Photo::factory()->count(3)->create();

        $response = $this->get(route('photo.index'));

        $response->assertOk();
        $response->assertViewIs('photo.index');
        $response->assertViewHas('photos');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('photo.create'));

        $response->assertOk();
        $response->assertViewIs('photo.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PhotoController::class,
            'store',
            \App\Http\Requests\PhotoStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $attendee = Attendee::factory()->create();
        $event = Event::factory()->create();
        $path = $this->faker->word;
        $reviewed = $this->faker->boolean;

        $response = $this->post(route('photo.store'), [
            'attendee_id' => $attendee->id,
            'event_id' => $event->id,
            'path' => $path,
            'reviewed' => $reviewed,
        ]);

        $photos = Photo::query()
            ->where('attendee_id', $attendee->id)
            ->where('event_id', $event->id)
            ->where('path', $path)
            ->where('reviewed', $reviewed)
            ->get();
        $this->assertCount(1, $photos);
        $photo = $photos->first();

        $response->assertRedirect(route('photo.index'));
        $response->assertSessionHas('photo.id', $photo->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $photo = Photo::factory()->create();

        $response = $this->get(route('photo.show', $photo));

        $response->assertOk();
        $response->assertViewIs('photo.show');
        $response->assertViewHas('photo');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $photo = Photo::factory()->create();

        $response = $this->get(route('photo.edit', $photo));

        $response->assertOk();
        $response->assertViewIs('photo.edit');
        $response->assertViewHas('photo');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PhotoController::class,
            'update',
            \App\Http\Requests\PhotoUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $photo = Photo::factory()->create();
        $attendee = Attendee::factory()->create();
        $event = Event::factory()->create();
        $path = $this->faker->word;
        $reviewed = $this->faker->boolean;

        $response = $this->put(route('photo.update', $photo), [
            'attendee_id' => $attendee->id,
            'event_id' => $event->id,
            'path' => $path,
            'reviewed' => $reviewed,
        ]);

        $photo->refresh();

        $response->assertRedirect(route('photo.index'));
        $response->assertSessionHas('photo.id', $photo->id);

        $this->assertEquals($attendee->id, $photo->attendee_id);
        $this->assertEquals($event->id, $photo->event_id);
        $this->assertEquals($path, $photo->path);
        $this->assertEquals($reviewed, $photo->reviewed);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $photo = Photo::factory()->create();

        $response = $this->delete(route('photo.destroy', $photo));

        $response->assertRedirect(route('photo.index'));

        $this->assertSoftDeleted($photo);
    }
}
