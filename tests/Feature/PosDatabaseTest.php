<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PosDatabaseTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_original_records_are_displayed(): void
    {
        $this->seed();

        $this->assertDatabaseCount('customers', 6);
        $this->assertDatabaseCount('users', 6);

        $customers = $this->get('/customers');
        $customers->assertOk()->assertViewIs('customers.index');

        foreach (Customer::orderBy('id')->get() as $customer) {
            $customers->assertSeeInOrder([
                $customer->full_name,
                $customer->email,
                $customer->phone,
            ]);
        }

        $users = $this->get('/users');
        $users->assertOk()->assertViewIs('users.index');

        foreach (User::orderBy('id')->get() as $user) {
            $users->assertSeeInOrder([
                $user->username,
                $user->full_name,
                $user->role,
            ]);
        }
    }

    public function test_the_pages_display_new_database_records(): void
    {
        Customer::create([
            'full_name' => 'New Customer',
            'email' => 'new.customer@example.com',
            'phone' => '09170000000',
        ]);

        User::create([
            'username' => 'new.cashier',
            'full_name' => 'New Cashier',
            'role' => 'Cashier',
        ]);

        $this->get('/customers')->assertOk()->assertSeeInOrder([
            'New Customer', 'new.customer@example.com', '09170000000',
        ]);

        $this->get('/users')->assertOk()->assertSeeInOrder([
            'new.cashier', 'New Cashier', 'Cashier',
        ]);
    }

    public function test_nullable_fields_and_creation_dates_work(): void
    {
        $customer = Customer::create([
            'full_name' => 'Customer Without Phone',
            'email' => 'without.phone@example.com',
        ])->fresh();

        $user = User::create([
            'username' => 'without.role',
            'full_name' => 'User Without Role',
        ])->fresh();

        $this->assertNull($customer->phone);
        $this->assertNull($user->role);
        $this->assertNotNull($customer->created_at);
        $this->assertNotNull($user->created_at);
        $this->get('/customers')->assertOk()->assertSee('Customer Without Phone');
        $this->get('/users')->assertOk()->assertSee('User Without Role');
    }

    public function test_usernames_must_be_unique(): void
    {
        User::create(['username' => 'cashier', 'full_name' => 'First User']);

        $this->expectException(QueryException::class);

        User::create(['username' => 'cashier', 'full_name' => 'Second User']);
    }

    public function test_reseeding_does_not_duplicate_records(): void
    {
        $this->seed();
        $this->seed();

        $this->assertDatabaseCount('customers', 6);
        $this->assertDatabaseCount('users', 6);
    }
}
