<?php
namespace modules\template\views;
require_once __DIR__ . '/Layout.php';

class Members {
    public function show(array $members, int $page, int $totalPages): void {
        ob_start();?>
        <table>
            <!-- ton tableau actuel -->
        </table>
        <nav aria-label="Pagination">
            <ul>
                <li>
                    <?php if ($page > 1): ?>
                        <a href="?page=members&p=<?= $page - 1 ?>">Précédent</a>
                    <?php else: ?>
                        <span>Précédent</span>
                    <?php endif; ?>
                </li>
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li>
                        <?php if ($i === $page): ?>
                            <span aria-current="page"><?= $i ?></span>
                        <?php else: ?>
                            <a href="?page=members&p=<?= $i ?>"><?= $i ?></a>
                        <?php endif; ?>
                    </li>
                <?php endfor; ?>
                <li>
                    <?php if ($page < $totalPages): ?>
                        <a href="?page=members&p=<?= $page + 1 ?>">Suivant</a>
                    <?php else: ?>
                        <span>Suivant</span>
                    <?php endif; ?>
                </li>
            </ul>
        </nav>
        <?php
        (new layout('Membres', 'Liste des membres', ob_get_clean()))->show();
    }
}