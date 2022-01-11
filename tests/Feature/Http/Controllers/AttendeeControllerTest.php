<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Attendee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\AttendeeController
 */
class AttendeeControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function show_displays_view()
    {
        $attendee = Attendee::factory()->create();

        $response = $this->get(route('attendee.show', $attendee));

        $response->assertOk();
        $response->assertViewIs('attendee.show');
        $response->assertViewHas('attendee');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $attendee = Attendee::factory()->create();

        $response = $this->get(route('attendee.edit', $attendee));

        $response->assertOk();
        $response->assertViewIs('attendee.edit');
        $response->assertViewHas('attendee');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AttendeeController::class,
            'update',
            \App\Http\Requests\AttendeeUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $attendee = Attendee::factory()->create();
        $name = $this->faker->name;

        $response = $this->put(route('attendee.update', $attendee), [
            'name' => $name,
        ]);

        $attendee->refresh();

        $response->assertRedirect(route('attendee.index'));
        $response->assertSessionHas('attendee.id', $attendee->id);

        $this->assertEquals($name, $attendee->name);
    }
}
