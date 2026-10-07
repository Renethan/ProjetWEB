<?php
use PHPUnit\Framework\TestCase;
use modules\template\models\Login;

require_once __DIR__ . '/../../modules/template/models/Login.php';

final class AuthentificationTest extends TestCase
{
    public function testIdentifiantRequis(): void
    {
        $errors = (new Login())->valider(['identifiant' => '', 'password' => 'x']);
        $this->assertArrayHasKey('identifiant', $errors);
    }

    public function testPasswordRequis(): void
    {
        $errors = (new Login())->valider(['identifiant' => 'bob', 'password' => '']);
        $this->assertArrayHasKey('password', $errors);
    }
}