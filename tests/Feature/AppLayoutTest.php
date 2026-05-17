<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Blade;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SplFileInfo;
use Tests\TestCase;

class AppLayoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_app_layout_pages_do_not_nest_flux_main_wrappers(): void
    {
        $offendingViews = [];
        $viewFiles = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator(resource_path('views')),
        );

        foreach ($viewFiles as $viewFile) {
            if (! $this->isBladeView($viewFile)) {
                continue;
            }

            $contents = file_get_contents($viewFile->getPathname());

            if (preg_match('/<x-layouts::app(?=\s|>)[^>]*>\s*<flux:main\b/s', $contents) === 1) {
                $offendingViews[] = $this->workspacePath($viewFile);
            }
        }

        $this->assertSame([], $offendingViews);
    }

    public function test_app_layout_pages_do_not_add_duplicate_main_padding(): void
    {
        $offendingViews = [];
        $viewFiles = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator(resource_path('views')),
        );

        foreach ($viewFiles as $viewFile) {
            if (! $this->isBladeView($viewFile)) {
                continue;
            }

            $contents = file_get_contents($viewFile->getPathname());

            if (preg_match('/<x-layouts::app(?=\s|>)[^>]*>\s*<div class="[^"]*\bp-6\b/s', $contents) === 1) {
                $offendingViews[] = $this->workspacePath($viewFile);
            }
        }

        $this->assertSame([], $offendingViews);
    }

    public function test_desktop_user_menu_honors_sidebar_visibility_classes(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $html = Blade::render('<x-desktop-user-menu class="hidden lg:block" />');

        $this->assertStringContainsString('hidden lg:block', $html);
    }

    private function isBladeView(SplFileInfo $viewFile): bool
    {
        return $viewFile->isFile() && str_ends_with($viewFile->getFilename(), '.blade.php');
    }

    private function workspacePath(SplFileInfo $viewFile): string
    {
        $basePath = str_replace('\\', '/', base_path()).'/';
        $viewPath = str_replace('\\', '/', $viewFile->getPathname());

        return str_replace($basePath, '', $viewPath);
    }
}
