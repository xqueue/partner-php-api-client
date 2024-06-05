<?php

namespace Xqueue\MaileonPartnerApiClient\Entities;

use Xqueue\MaileonPartnerApiClient\Traits\MappingTrait;

/**
 * @property int    $id
 * @property string $name
 * @property string $type
 * @property string $status
 * @property int    $distributorAccountId
 * @property string $distributorAccountName
 * @property string $createdTime
 * @property string $createdUser
 */
class CustomerAccount
{

    use MappingTrait;

    public const KEY = 'customerAccounts';

    public int    $id;
    public string $name;
    public string $type;
    public string $status;
    public int    $distributorAccountId;
    public string $distributorAccountName;
    public string $createdTime;
    public string $createdUser;

    /**
     * @param int    $id
     * @param string $name
     * @param string $type
     * @param string $status
     * @param int    $distributorAccountId
     * @param string $distributorAccountName
     * @param string $createdTime
     * @param string $createdUser
     */
    public function __construct(
        int    $id,
        string $name,
        string $type,
        string $status,
        int    $distributorAccountId,
        string $distributorAccountName,
        string $createdTime,
        string $createdUser
    ) {
        $this->id                     = $id;
        $this->name                   = $name;
        $this->type                   = $type;
        $this->status                 = $status;
        $this->distributorAccountId   = $distributorAccountId;
        $this->distributorAccountName = $distributorAccountName;
        $this->createdTime            = $createdTime;
        $this->createdUser            = $createdUser;
    }
}