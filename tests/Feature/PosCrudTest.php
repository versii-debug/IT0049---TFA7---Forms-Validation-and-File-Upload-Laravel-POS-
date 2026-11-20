<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PosCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_can_be_created_and_edited(): void
    {
        $this->get('/customers/create')->assertOk();

        $this->post('/customers', [
            'full_name' => 'Test Customer',
            'email' => 'test@example.com',
            'phone' => '09123456789',
        ])->assertRedirect('/customers');

        $customer = Customer::firstOrFail();
        $this->get('/customers/'.$customer->id.'/edit')
            ->assertOk()
            ->assertSee('value="Test Customer"', false);

        $this->put('/customers/'.$customer->id, [
            'full_name' => 'Updated Customer',
            'email' => 'updated@example.com',
            'phone' => '',
        ])->assertRedirect('/customers');

        $this->assertDatabaseHas('customers', [
            'id' => $customer->id,
            'full_name' => 'Updated Customer',
            'email' => 'updated@example.com',
            'phone' => null,
        ]);
    }

    public function test_customer_required_fields_and_email_are_validated(): void
    {
        $this->post('/customers', [
            'full_name' => '',
            'email' => 'invalid-email',
        ])->assertSessionHasErrors(['full_name', 'email']);

        $this->assertDatabaseCount('customers', 0);
    }

    public function test_user_can_be_created_and_edited(): void
    {
        $this->get('/users/create')->assertOk();

        $this->post('/users', [
            'username' => 'tester',
            'full_name' => 'Test User',
            'role' => 'Cashier',
        ])->assertRedirect('/users');

        $user = User::firstOrFail();
        $this->get('/users/'.$user->id.'/edit')
            ->assertOk()
            ->assertSee('value="tester"', false);

        $this->put('/users/'.$user->id, [
            'username' => 'tester',
            'full_name' => 'Updated User',
            'role' => 'Manager',
        ])->assertRedirect('/users');

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'username' => 'tester',
            'full_name' => 'Updated User',
            'role' => 'Manager',
        ]);
    }

    public function test_username_must_be_unique_and_user_name_is_required(): void
    {
        User::create(['username' => 'existing', 'full_name' => 'Existing User']);

        $this->post('/users', [
            'username' => 'existing',
            'full_name' => '',
        ])->assertSessionHasErrors(['username', 'full_name']);

        $this->assertDatabaseCount('users', 1);
    }

    public function test_avatar_is_prepared_and_stored_on_public_disk(): void
    {
        Storage::fake('public');
        $user = User::create(['username' => 'photo.user', 'full_name' => 'Photo User']);

        $this->put('/users/'.$user->id, [
            'username' => 'photo.user',
            'full_name' => 'Photo User',
            'avatar' => UploadedFile::fake()->image('photo.png', 400, 300),
        ])->assertRedirect('/users');

        $user->refresh();
        $this->assertStringStartsWith('avatars/', $user->avatar);
        $this->assertStringEndsWith('.jpg', $user->avatar);
        Storage::disk('public')->assertExists($user->avatar);

        $size = getimagesize(Storage::disk('public')->path($user->avatar));
        $this->assertLessThanOrEqual(200, $size[0]);
        $this->assertLessThanOrEqual(200, $size[1]);
        $this->get('/users')->assertOk()->assertSee('storage/'.$user->avatar);
    }

    public function test_avatar_must_be_an_image_under_two_megabytes(): void
    {
        $user = User::create(['username' => 'photo.user', 'full_name' => 'Photo User']);

        $this->put('/users/'.$user->id, [
            'username' => 'photo.user',
            'full_name' => 'Photo User',
            'avatar' => UploadedFile::fake()->create('document.txt', 10, 'text/plain'),
        ])->assertSessionHasErrors('avatar');

        $this->put('/users/'.$user->id, [
            'username' => 'photo.user',
            'full_name' => 'Photo User',
            'avatar' => UploadedFile::fake()->image('large.jpg')->size(2049),
        ])->assertSessionHasErrors('avatar');

        $this->assertNull($user->fresh()->avatar);
        $this->get('/users')->assertOk()->assertSee('images/avatar-placeholder.svg');
    }
}
