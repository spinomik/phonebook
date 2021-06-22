<?php

namespace App\Factory;

use App\Entity\Contact;
use App\Repository\ContactRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static Contact|Proxy createOne(array $attributes = [])
 * @method static Contact[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static Contact|Proxy find($criteria)
 * @method static Contact|Proxy findOrCreate(array $attributes)
 * @method static Contact|Proxy first(string $sortedField = 'id')
 * @method static Contact|Proxy last(string $sortedField = 'id')
 * @method static Contact|Proxy random(array $attributes = [])
 * @method static Contact|Proxy randomOrCreate(array $attributes = [])
 * @method static Contact[]|Proxy[] all()
 * @method static Contact[]|Proxy[] findBy(array $attributes)
 * @method static Contact[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Contact[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ContactRepository|RepositoryProxy repository()
 * @method Contact|Proxy create($attributes = [])
 */
final class ContactFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://github.com/zenstruck/foundry#factories-as-services)
    }

    protected function getDefaults(): array
    {
//        return[
//        'name' => self::faker()->firstName(),
//        'last_name' => self::faker()->lastName(),
//        'phone_number' => self::faker()->phoneNumber(),
//        'locality' =>self::faker()->city(),
//        'zip_code' =>self::faker()->postcode(),
//        'street' =>self::faker()->streetName(),
//        'number_of_the_bulding' => self::faker()->randomDigitNotNull(),
//        'number_apartment' =>self::faker()->randomDigitNotNull(),
//        ];

        return[
            'name' =>self::faker()->firstName(),
            'last_name' =>self::faker()->lastName(),
            'phone_number' =>self::faker()->numberBetween(600000000, 900000000),
            'locality' =>self::faker()->city(),
            'zip_code' =>self::faker()->postcode(),
            'street' =>self::faker()->streetName(),
            'number_of_the_bulding' =>self::faker()->randomDigitNotNull(),
            'number_apartment' =>self::faker()->randomDigitNotNull(),
        ];
    }


    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->afterInstantiate(function(Contact $contact) {})
        ;
    }

    protected static function getClass(): string
    {
        return Contact::class;
    }
}
