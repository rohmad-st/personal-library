<?php

namespace App\Domain\Contracts;

/**
 * Interface Searchable
 *
 * @package App\Domain\Contracts
 */
interface Searchable
{
    /**
     * @param     $query
     * @param int $page
     *
     * @return mixed
     */
    public function search($query, $page = 1);

}
