# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/towoju5/bitnob.svg?style=flat-square)](https://packagist.org/packages/towoju5/bitnob)
[![Total Downloads](https://img.shields.io/packagist/dt/towoju5/bitnob.svg?style=flat-square)](https://packagist.org/packages/towoju5/bitnob)
![GitHub Actions](https://github.com/towoju5/bitnob/actions/workflows/main.yml/badge.svg)

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what PSRs you support to avoid any confusion with users and contributors.

## Installation

You can install the package via composer:

```bash
composer require towoju5/bitnob
```

## Enroll user for card creation

```php
// enroll user for card creation
$data = [
    'customerEmail'     => 'johnsmith@gmail.com',
    'idNumber'          => 'A00100010',
    'idType'            => 'PASSPORT',
    'firstName'         => 'Smith',
    'lastName'          => 'John',
    'phoneNumber'       => '08012345678',
    'city'              => 'ILORIN',
    'state'             => 'KWARA',
    'country'           => 'NIGERIA',
    'zipCode'           => '90011',
    'line1'             => 'ABC street, klotovan road',
    'houseNumber'       => 15,
    'idImage'           => 'https://example.com/image.png',
];
app('bitnob')->regUser($data);
```
## Create card. 
NOTE: user must be firstly enrolled for this service
```
$data = [
    'customerEmail' => 'johndoe@gmail.com',
    'cardBrand'     => 'visa', // cardBrand should be "visa" or "mastercard"
    'cardType'      => 'virtual',
    'reference'     => '4f644a2c-3c4f-48c7-a3fa-e896b544d546',
    'amount'        => 5000,
];
app('bitnob')->create($data);
```

## Card Topup. 
NOTE: user must be firstly enrolled for this service
```
 $data = [
    'cardId'    => $data['cardId'],
    'reference' => $data['reference'],
    'amount'    => $data['amount'],
];
app('bitnob')->topup($data);
```

## Perform action on card 
```
    $action = 'freeze'; // unfreeze
    $cardId = '4f644a2c-3c4f-48c7-a3fa-e896b544d546';
    app('bitnob')->action($action, $cardId);
```

## Get single card 
```
    $cardId = '4f644a2c-3c4f-48c7-a3fa-e896b544d546';
    app('bitnob')->getCard($cardId);
```

## Get card getTransaction
```
    $cardId = '4f644a2c-3c4f-48c7-a3fa-e896b544d546';
    app('bitnob')->getTransaction($cardId);
```


### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email towojuads@gmail.com instead of using the issue tracker.

## Credits

-   [EMMANUEL TOWOJU](https://github.com/towoju5)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Todo List


✅ Virtual Card
❌ Customers
❌ Bitcoin Onchain
❌ Wallet
❌ Transactions
❌ Hosted Checkout
❌ StableCoins
❌ Payouts/Mobile Transfers