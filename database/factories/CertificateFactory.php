<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CertificateFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->student(),
            'course_id' => Course::factory(),
            'enrollment_id' => Enrollment::factory(),
            'certificate_number' => 'CERT-' . $this->faker->unique()->numerify('##########'),
            'certificate_url' => 'certificates/sample.pdf',
            'issue_date' => now(),
            'expiry_date' => null,
            'validity_period' => null,
            'verification_code' => 'VER-' . $this->faker->unique()->bothify('????##'),
            'is_revoked' => false,
            'revocation_reason' => null,
            'revoked_at' => null,
        ];
    }
}