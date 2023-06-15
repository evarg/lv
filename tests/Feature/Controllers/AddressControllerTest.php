<?php

namespace Tests\Feature\Controllers;

use App\Models\Address;
use App\Models\Country;
use App\Models\Enums\AddressType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddressControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_can_add_country(): void
    {
        $country = Country::factory()->create();

        $address = Address::factory()->make();
        $address->country()->associate($country);
        $address->save();
    }

    public function test_can_add_address(): void
    {
        $country = Country::factory()->create();
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $address = Address::factory()->make();
        $address->country()->associate($country);
        $address->save();

        $address->users()->attach($user1, ['type' => AddressType::BUSINESS]);
        $address->users()->attach($user2);

        //$address->users()->syncWithPivotValues($user2, [
        //    'type' => AddressType::SHIPPING,
        //]);

        //$address->users()->updateExistingPivot($user1, ['type' => AddressType::SHIPPING] );

        $user1->addresses()->updateExistingPivot($address, ['type' => AddressType::SHIPPING] );


    }

    public function test_can_document_file(): void
    {
        $country = Country::factory()->create();
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $address = Address::factory()->make();
        $address->country()->associate($country);
        $address->save();

        $address->users()->attach($user1, ['type' => AddressType::BUSINESS]);
        $address->users()->attach($user2);

        //$address->users()->syncWithPivotValues($user2, [
        //    'type' => AddressType::SHIPPING,
        //]);

        //$address->users()->updateExistingPivot($user1, ['type' => AddressType::SHIPPING] );

        $user1->addresses()->updateExistingPivot($address, ['type' => AddressType::SHIPPING] );


    }


}
