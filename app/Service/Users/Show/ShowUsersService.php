<?php
namespace App\Service\Users\Show;

use App\Database;
use App\Models\Signup;

class ShowUsersService
{

        public function execute()
        {
            $connection = Database::connect();
            $results = $connection
                ->createQueryBuilder()
                ->select('id', 'username', 'email', 'password')
                ->from('users')
                ->executeQuery()
                ->fetchAllAssociative();
            foreach ($results as $result) {
                $users[] = new Signup($result['username'], $result['password'], $result['id'], $result['email']);
            }
            return $users;
        }
}