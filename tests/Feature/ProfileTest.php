<?php

/**
 * File Test untuk Fitur Profile
 * 
 * File ini berisi test-test yang memastikan fitur profile berfungsi dengan benar:
 * - Menampilkan halaman profile
 * - Mengupdate informasi profile
 * - Menghapus akun
 * - Validasi password
 */

use App\Models\User;

/**
 * Test untuk memastikan halaman profile dapat diakses
 * 
 * @test
 */
test('profile page is displayed', function () {
    // Membuat user dummy menggunakan factory
    $user = User::factory()->create();

    // Simulasi request ke halaman profile sebagai user yang sudah login
    $response = $this
        ->actingAs($user)
        ->get('/profile');

    // Memastikan response OK (200)
    $response->assertOk();
});

/**
 * Test untuk memastikan informasi profile dapat diupdate
 * 
 * @test
 */
test('profile information can be updated', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->patch('/profile', [
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/profile');

    $user->refresh();

    $this->assertSame('Test User', $user->name);
    $this->assertSame('test@example.com', $user->email);
    $this->assertNull($user->email_verified_at);
});

test('email verification status is unchanged when the email address is unchanged', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->patch('/profile', [
            'name' => 'Test User',
            'email' => $user->email,
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/profile');

    $this->assertNotNull($user->refresh()->email_verified_at);
});

test('user can delete their account', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->delete('/profile', [
            'password' => 'password',
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/');

    $this->assertGuest();
    $this->assertNull($user->fresh());
});

test('correct password must be provided to delete account', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->from('/profile')
        ->delete('/profile', [
            'password' => 'wrong-password',
        ]);

    $response
        ->assertSessionHasErrorsIn('userDeletion', 'password')
        ->assertRedirect('/profile');

    $this->assertNotNull($user->fresh());
});
