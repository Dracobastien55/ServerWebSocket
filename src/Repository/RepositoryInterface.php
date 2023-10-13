<?php

namespace App\Repository;

interface RepositoryInterface
{
    /**
     * Method that will return a query for a select all
     */
    public function getAll() : string;

    /**
     * Method that will return a specific entity with a select
     */
    public function getByID(int $id) : string;

    /**
     * Method that will save in db the data (include insert or Update query)
     */
    public function Save($data) : void;
}