<?php

namespace Database\Factories;

use App\Models\AcademicDegree;
use App\Models\Lecturer;
use Illuminate\Database\Eloquent\Factories\Factory;

class AcademicDegreeFactory extends Factory
{
    protected $model = AcademicDegree::class;

    public function definition(): array
    {
        return [
            // lecturer_id sẽ được gán khi gọi factory từ LecturerSeeder
            'degree_name' => $this->faker->randomElement(['Tiến sĩ', 'Thạc sĩ', 'Kỹ sư', 'Cử nhân']) . ' ' . $this->faker->jobTitle(),
            'specialization' => $this->faker->bs(),
            'issuing_institution' => $this->faker->company() . ' University',
            'date_issued' => $this->faker->dateTimeBetween('-20 years', '-1 year')->format('Y-m-d'),
            'notes' => $this->faker->optional()->sentence(),
        ];
    }
}