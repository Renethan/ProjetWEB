<?php
namespace modules\template\views;
require_once __DIR__ . '/Layout.php';

class Members {
    public function show(array $members): void {
        ob_start();?>
        <table>
            <thead>
                <tr><th scope="col">Identifiant</th></tr>
            </thead>
            <tbody>
                <?php foreach ($members as $member): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($member['identifiant']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php
        (new layout('Membres', 'Liste des membres', ob_get_clean()))->show();
    }
}