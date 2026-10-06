<?php
namespace modules\template\views;
require_once __DIR__ . '/Layout.php';

class Members {
    public function show(array $members, \modules\template\models\Pagination $pagination): void {
        $page = $pagination->getCurrentPage();
        $totalPages = $pagination->getTotalPages();
        ob_start();?>
        <table>
            <thead>
                <tr><th scope="col">Identifiant</th></tr>
            </thead>
            <tbody>
                <?php foreach ($members as $member): ?>
                    <tr><td><?= htmlspecialchars($member['identifiant']) ?></td></tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <nav aria-label="Pagination">
            <ul>
                <li>
                    <?php if ($page > 1):
                        echo '<a href="?page=members&p=' . ($page - 1) . '">Précédent</a>';
                    else:
                        echo '<span>Précédent</span>';
                    endif; ?>
                </li>
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li>
                        <?php if ($i === $page):
                            echo '<span aria-current="page">' . $i . '</span>';
                        else:
                            echo '<a href="?page=members&p=' . $i . '">' . $i . '</a>';
                        endif; ?>
                    </li>
                <?php endfor; ?>
                <li>
                    <?php if ($page < $totalPages):
                        echo '<a href="?page=members&p=' . ($page + 1) . '">Suivant</a>';
                    else:
                        echo '<span>Suivant</span>';
                    endif; ?>
                </li>
            </ul>
        </nav>
        <?php
        (new layout('Membres', 'Liste des membres', ob_get_clean()))->show();
    }
}