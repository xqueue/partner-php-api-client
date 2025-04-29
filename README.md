[![Latest Stable Version](http://poser.pugx.org/xqueue/maileon-partner-api-client/v)](https://packagist.org/packages/xqueue/maileon-partner-api-client)
[![License](http://poser.pugx.org/xqueue/maileon-partner-api-client/license)](https://packagist.org/packages/xqueue/maileon-partner-api-client)
[![PHP Version Require](http://poser.pugx.org/xqueue/maileon-partner-api-client/require/php)](https://packagist.org/packages/xqueue/maileon-partner-api-client)

# Maileon Partner API Client

Provides an API client to connect to XQueue Maileon's Partner REST API and (de-)serializes all API functions and data for easier use in PHP projects.

Maileon's REST API documentation can be found [here](https://support.maileon.com/support/partner-api/).

## Table of contents
* [Requirements](#requirements)
* [Installation](#installation)
* [Usage](#usage)
* [Examples](#examples)
* [Tests](#tests)


## Requirements
The API client requires `PHP >= 8.1` with `libcurl`.

Additionally all requests use an SSL encrypted API endpoint.
To enable SSL support in CURL, please follow these steps:
1. Download the official SSL cert bundle by CURL from https://curl.haxx.se/ca/cacert.pem
2. Save the bundle to a directory that can be accessed by your PHP installation
3. Add the following entry to your php.ini (remember to change the path to where you put the cert bundle):
```
curl.cainfo="your-path-to-the-bundle/cacert.pem"
```

## Installation

You can add this library to your project using [Composer](https://getcomposer.org/):

```
composer require xqueue/maileon-partner-api-client
```

## Usage

The API client divides the features of Maileon's Partner REST API into specific consumable services. Each service provides all functions of it's specific category.
* **AccountService:**
  * Manage newsletter and customer accounts, api keys, mailing domains.


* **BlacklistService:**
  * Manage your blacklists.


* **ContingentService:**
  * Manage contingents and prepaid status.


* **DistributorReportService:**
  * Get Volume and SMS Reports.


* **GeneralService:**
  * Get domains list, validate domain, get locales.


* **JobService:**
  * Get jobs, create account job.


* **ProductService:**
  * Manage products and upload templates.


* **ReportService:**
  * Get report checks and report CSAs.


* **RoleService:**
  * Create or delete custom roles.


* **UserService:**
  * Manage user accounts and roles.


* **WebhookService:**
    * Manage webhooks.

## Examples
Get Newsletter Accounts:
```php
$service = new AccountService(['API_KEY' => 'Your API key'])

$response = $service->getNewsletterAccounts();

if(!$response->getResponse()->isSuccess()){
    // handle error
}

$newsletterAccounts = $response->getData();
```

Create Job:
```php
$service = new JobService(['API_KEY' => 'Your API key'])

$response = $this->jobService->createAccountJob(
            $locale,
            $type,
            $author,
            $customerAccountName,
            $newsletterAccountName,
            $customDomain ?? null,
            $providedDomain ?? null,
            $subdomain ?? null,
            $customDns ?? null,
            $accountTemplateId ?? null,
            $users ?? null,
            $customerAccountId ?? null,
            $domainAsLogin ?? null,
            $uiVersion ?? null
        );

if(!$response->getResponse()->isSuccess()){
    // handle error
}

$data = $response->getData();
$jobId = $data['jobId'];
```


## Tests
In order to run the unit tests you need to have Docker installed.

First you need to create a .env file and add your API key:
```dotenv
MAILEON_PARTNER_API_KEY=**********
```

Run the following commands to create the container and install the required packages:
```
docker-compose up -d

docker exec -it partner-api composer install 
```

Run the following commands to run the tests:
```shell
docker exec -it partner-api composer test
docker exec -it partner-api composer test-coverage  // or this if you want to have the coverage generated 
```
