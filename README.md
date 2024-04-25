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

Setup your base url and api key via the env file
```env
    BITNOB_API_KEY=pk.f75b136.8a9babaec7ce729be883a7111
    BITNOB_BASE_URL='https://sandboxapi.bitnob.co/api/v1'
```

```bash
    use Towoju5\Bitnob\Bitnob;
    $bitnob = new Bitnob;
```


## Virtual cards Management
```
    $bitnob = new Bitnob();
    $cards      = $bitnob->cards();
    $regUser    = $cards->regUser(array $data)
    $create     = $cards->create(array $data)
    $topup      = $cards->topup(array $data)
    $action     = $cards->action(string $action, string $cardId)
    $getCard    = $cards->getCard(string $cardId)
    $getTransaction = $cards->getTransaction(string $cardId)
```



## Manage Bitnob Customers
```bash
    $bitnob = new Bitnob();
    $customer = $bitnob->customer();
    $createCustomer = $customer->createCustomer(array $data);
    $updateCustomer = $customer->updateCustomer(string $id, array $data);
    $listCustomer   = $customer->listCustomer(string $id);
    $getCustomer    = $customer->getCustomer(string $id);
```



## Transfer/Payout
```bash
    $bitnob = new Bitnob();
    $transfer   = $bitnob->transfer();
    $initPayout = $transfer->initPayout(array $arrays)
    $completePayout      = $transfer->completePayout(string $payoutInitId)
    $countryRequirements = $transfer->countryRequirements(string $country_code)
    $supportedCountries  = $transfer->supportedCountries()
```


## Beneficiary
```bash
    $bitnob = new Bitnob();
    $beneficiary        = $bitnob->beneficiary();
    $createBeneficiary  = $beneficiary->createBeneficiary(array $data)
    $listBeneficiaries  = $beneficiary->listBeneficiaries()
    $getBeneficiary     = $beneficiary->getBeneficiary($beneficiary_id)
```

## Hosted Checkout - BTC Payment
### Note:  Amount in Bitcoin and not satoshi
```bash
    $bitnob = new Bitnob();
    $checkout = $bitnob->checkout();
    $createHostedCheckout   = $checkout->createHostedCheckout(array $data)
    $getCheckoutStatus      = $checkout->getCheckoutStatus($checkoutId)
    $getCheckouts           = $checkout->getCheckouts($param = null)
    $getCheckout            = $checkout->getCheckout($checkoutId)
```


###
###
###
###
###
###
###



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
 $arr = [
    'cardId'    => $data['cardId'],
    'reference' => $data['reference'],
    'amount'    => $data['amount'],
];
app('bitnob')->topup($arr);
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


### ✅ Virtual Card
### ✅ Customers
### ✅ Payouts/Mobile Transfers
### ✅ Hosted Checkout
### ❌ Bitcoin Onchain
### ❌ Wallet
### ❌ Transactions
### ❌ StableCoins