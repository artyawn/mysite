<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{


    protected $model= Task::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->title,
            'content'=>$this->faker->text,
            'date'=>$this->faker->date,
            'group_id'=>$this->faker->numberBetween(0,20),
            'worker_id'=>$this->faker->text,
            'sender_id'=>$this->faker->numberBetween(0,20),
            'is_done'=>$this->faker->boolean,

        ];
    }
}
