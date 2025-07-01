<?php

namespace App\Models;

use App\Core\Model;

class HomeModel extends Model
{
    /**
     * Override the parent constructor to avoid establishing a database
     * connection for this simple example model. The base Model class
     * attempts to connect to the database on construction, which can
     * fail if credentials are incorrect or the database server is
     * unavailable. Since this model does not require a database
     * connection, we skip calling the parent constructor.
     */
    public function __construct()
    {
        // No database connection needed
    }

    public function getMessage()
    {
        return 'Welcome to your new MVC app!';
    }
}
