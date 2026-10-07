
<?php
use PHPUnit\Framework\TestCase;
use modules\template\models\Signup;

require_once __DIR__ . '/../../modules/template/models/Signup.php';

final class InscriptionTest extends TestCase
{
    private function donneesValides(array $override = []): array
    {
        return array_merge([
            'identifiant' => 'bob',
            'email' => 'bob@mail.fr',
            'password' => 'secret123',
            'verification-password' => 'secret123',
        ], $override);
    }

    public function testPasswordTooShort(): void
    {
    $errors = ($this->model())->valider($this->donneesValides([
        'password' => 'abc', 'verification-password' => 'abc',
    ]));
    $this->assertArrayHasKey('taille-mdp', $errors);
    }

    public function testDonneesValidesSansErreur(): void
    {
        $this->assertSame([], ($this->model())->valider($this->donneesValides()));
    }

    public function testIdentifiantRequis(): void
    {
        $errors = ($this->model())->valider($this->donneesValides(['identifiant' => '']));
        $this->assertArrayHasKey('identifiant', $errors);
    }

    public function testEmailRequis(): void
    {
        $errors = ($this->model())->valider($this->donneesValides(['email' => '']));
        $this->assertArrayHasKey('email', $errors);
    }

    public function testEmailInvalide(): void
    {
        $errors = ($this->model())->valider($this->donneesValides(['email' => 'pas-un-email']));
        $this->assertSame('Email invalide.', $errors['email']);
    }

    public function testPasswordRequis(): void
    {
        $errors = ($this->model())->valider($this->donneesValides(['password' => '']));
        $this->assertArrayHasKey('password', $errors);
    }

    public function testMotsDePasseDifferents(): void
    {
        $errors = ($this->model())->valider($this->donneesValides(['verification-password' => 'autre']));
        $this->assertArrayHasKey('verification-password', $errors);
    }

    private function model(bool $exists = false): Signup
    {
    return new class($exists) extends Signup {
        public function __construct(private bool $exists) {}
        public function value_exists(string $value, string $type): bool
        {
            return $this->exists;
        }
    };
    }
    
    public function testIdentifiantAlreadyTaken(): void
    {
    $errors = $this->model(true)->valider($this->donneesValides());
    $this->assertStringContainsString('déjà utilisé', $errors['identifiant']);
    }
}