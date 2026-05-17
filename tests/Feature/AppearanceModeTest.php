<?php

namespace Tests\Feature;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SplFileInfo;
use Tests\TestCase;

class AppearanceModeTest extends TestCase
{
    public function test_html_shells_do_not_force_dark_mode(): void
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

            if (str_contains($contents, '<!DOCTYPE html>') && str_contains($contents, 'class="dark"')) {
                $offendingViews[] = $this->workspacePath($viewFile);
            }
        }

        $this->assertSame([], $offendingViews);
    }

    public function test_gym_palette_defaults_to_light_and_overrides_dark(): void
    {
        $css = file_get_contents(resource_path('css/app.css'));

        $this->assertStringContainsString('--color-gym-950: #fafaf8;', $css);
        $this->assertMatchesRegularExpression('/\.dark\s*\{[^}]*--color-gym-950:\s*#0a0a0a;/s', $css);
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
