<?php
namespace App\Models;
use App\Database;

class Signup{
    private string $uid;
    private $password;
    private $id;
    private $email;
    public function __construct($uid,$password,$id,$email)
    {


        $this->uid = $uid;
        $this->password = $password;
        $this->id = $id;
        $this->email = $email;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @return string
     */
    public function getUid(): string
    {
        return $this->uid;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPasswordRepeat()
    {
        return $this->passwordRepeat;
    }

}