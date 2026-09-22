<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_and_view_a_task(): void
    {
        $response = $this->post('/tasks', [
            'task_name' => 'Write project report',
            'description' => 'Finish the task manager project summary.',
            'status' => 'Pending',
            'priority' => 'Medium',
            'due_date' => '2026-09-30',
        ]);

        $response->assertRedirect('/tasks');

        $this->assertDatabaseHas('tasks', [
            'task_name' => 'Write project report',
            'status' => 'Pending',
        ]);

        $this->get('/tasks')
            ->assertOk()
            ->assertSee('Write project report');
    }
}
