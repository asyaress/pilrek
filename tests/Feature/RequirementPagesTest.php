<?php

namespace Tests\Feature;

use Tests\TestCase;

class RequirementPagesTest extends TestCase
{
    public function test_public_requirement_page_is_accessible(): void
    {
        $response = $this->get(route('persyaratan'));

        $response->assertOk();
        $response->assertSee('Persyaratan Calon Rektor', false);
    }

    public function test_admin_requirement_page_requires_login(): void
    {
        $response = $this->get(route('admin.requirements.index'));

        $response->assertRedirect(route('admin.login'));
    }
}
