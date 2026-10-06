<?php

namespace modules\template\models;

class Pagination {
    private int $perPage;
    private int $totalPages;
    private int $currentPage;
    private int $totalItems;

    public function __construct(int $totalItems, int $perPage, int $requestedPage) {
        $this->totalItems = max(0, $totalItems);
        $this->perPage = max(1, $perPage);
        $this->totalPages = max(1, (int)ceil($this->totalItems / $this->perPage));
        $page = $requestedPage;
        $this->currentPage = max(1, min($page, $this->totalPages));
    }
    public function getLimit(): int {
        return $this->perPage;
    }
    public function getOffset(): int {
        return ($this->currentPage - 1) * $this->perPage;
    }
    public function getCurrentPage(): int {
        return $this->currentPage;
    }
    public function getTotalPages(): int {
        return $this->totalPages;
    }
    public function getTotalItems(): int {
        return $this->totalItems;
    }
}