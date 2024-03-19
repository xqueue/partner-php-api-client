<?php

namespace Xqueue\MaileonPartnerApiClient\Entities;

class UserAccount
{

    public string $email;
    public string $firstName;
    public string $lastName;
    public string $theme;
    public string $locale;
    public array $roles;
    public string $created;

    /**
     * @param string $email
     * @param string $firstName
     * @param string $lastName
     * @param string $theme
     * @param string $locale
     * @param array $roles
     * @param string $created
     */
    public function __construct(
        string $email,
        string $firstName,
        string $lastName,
        string $theme,
        string $locale,
        array $roles,
        string $created
    )
    {
        $this->email = $email;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->theme = $theme;
        $this->locale = $locale;
        $this->roles = $roles;
        $this->created = $created;
    }
}