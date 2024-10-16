<?php

namespace Tests\Unit;

use App\Models\Post;
use App\Models\User; // Make sure to import the User model
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use DatabaseTransactions; // Roll back database after each test

    protected function setUp(): void
    {
        parent::setUp();

        // Run the user seeder to populate users
        $this->seed(); // This will run the default DatabaseSeeder

        // Retrieve the first user created by the seeder
        $this->user = User::first(); // Assuming the seeder creates at least one user
        $this->actingAs($this->user); // Authenticate the user for the test
    }

    /** @test */
    public function test_post_can_be_created()
    {
        $data = [
            'title' => 'Sample Post Title',
            'content' => 'Sample content for the post.',
            'status' => 'pending',
        ];

        $response = $this->post(route('post.store'), $data);

        $response->assertStatus(302); // Redirect after successful creation
        $this->assertDatabaseHas('posts', [
            'title' => 'Sample Post Title',
            'content' => 'Sample content for the post.',
            'status' => 'pending',
        ]);
    }

    /** @test */
    public function test_post_can_be_updated()
    {
        $post = Post::factory()->create([
            'title' => 'Old Title',
            'content' => 'Old content',
            'status' => 'pending',
        ]);

        $updatedData = [
            'title' => 'Updated Title',
            'content' => 'Updated content',
            'status' => 'pending',
        ];

        $response = $this->patch(route('post.update', $post->id), $updatedData);

        $response->assertStatus(302); // Redirect after update
        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'title' => 'Updated Title',
            'content' => 'Updated content',
            'status' => 'pending',
        ]);
    }

    /** @test */
    public function test_post_can_be_deleted()
    {
        $post = Post::factory()->create([
            'title' => 'Post to be deleted',
            'content' => 'This post will be deleted',
        ]);

        $response = $this->delete(route('post.delete', $post->id));

        $response->assertStatus(302); // Redirect after deletion
        $this->assertDatabaseMissing('posts', [
            'id' => $post->id,
        ]);
    }

    /** @test */
    public function test_post_can_be_approved_by_admin()
    {
        // Optionally, create an admin user or use the same user
        // $adminUser = User::factory()->create(['is_admin' => true]);
        // $this->actingAs($adminUser);

        $post = Post::factory()->create([
            'title' => 'Post to be approved',
            'content' => 'This post is pending approval',
            'status' => 'pending',
        ]);

        $response = $this->patch(route('admin.approve', $post->id));

        $response->assertStatus(302); // Redirect after approval
        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'status' => 'approved',
        ]);
    }
}



