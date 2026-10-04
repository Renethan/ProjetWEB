<?php
use PHPUnit\Framework\TestCase;
use modules\template\models\Authentification;

require_once __DIR__ . '/../../modules/template/models/Authentification.php';

final class AuthentificationTest extends TestCase
{
    public function testIdentifiantRequis(): void
    {
        $errors = (new Authentification())->valider(['identifiant' => '', 'password' => 'x']);
        $this->assertArrayHasKey('identifiant', $errors);
    }

    public function testPasswordRequis(): void
    {
        $errors = (new Authentification())->valider(['identifiant' => 'bob', 'password' => '']);
        $this->assertArrayHasKey('password', $errors);
    }
}