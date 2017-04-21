<?php
namespace aminkt\shop\interfaces;

/**
 * Interface CustomerProfileInterface
 * @package shop\interfaces
 *
 * Define an interface to grantee that Customer profile model prepare some important data for shop module.
 */
interface CustomerProfileInterface extends \aminkt\ordering\interfaces\CustomerProfileInterface
{
    /**
     * Set user password
     * @param string $password
     * @return bool true if changed and false if not
     */
    public function setPassword($password);

    /**
     * Set user email
     * @param string $email
     * @return bool true if changed and false if not
     */
    public function setEmail($email);

    /**
     * Set user first name
     * @param string $name
     * @return bool true if changed and false if not
     */
    public function setName($name);

    /**
     * Set user last name
     * @param string $family
     * @return bool true if changed and false if not
     */
    public function setFamily($family);

    /**
     * Set username of user
     * @param string $username
     * @return bool true if changed and false if not
     */
    public function setUsername($username);

    /**
     * Set user mobile number
     * @param string $mobile
     * @return bool true if changed and false if not
     */
    public function setMobile($mobile);
}