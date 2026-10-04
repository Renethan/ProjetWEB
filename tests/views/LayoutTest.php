<?php
use PHPUnit\Framework\TestCase;
use modules\template\views\layout;

require_once __DIR__ . '/../../modules/template/views/Layout.php';

final class LayoutTest extends TestCase
{
    private function rendu(): string
    {
        ob_start();
        (new layout('Mon titre', 'Ma description', '<p>Contenu</p>'))->show();
        return ob_get_clean();
    }

    public function testContientTitreEtDescription(): void
    {
        $html = $this->rendu();
        $this->assertStringContainsString('<title>Mon titre</title>', $html);
        $this->assertStringContainsString('content="Ma description"', $html);
    }

    public function testContientLeContenu(): void
    {
        $this->assertStringContainsString('<p>Contenu</p>', $this->rendu());
    }

    public function testNavigationContientLesPages(): void
    {
        $html = $this->rendu();
        foreach (['homepage', 'inscription', 'auth', 'mentions'] as $page) {
            $this->assertStringContainsString("index.php?page=$page", $html);
        }
    }
}