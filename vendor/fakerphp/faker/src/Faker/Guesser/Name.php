<?php

namespace Faker\Guesser;

use Faker\Provider\Base;

class Name
{
    private string $firstName;
    private string $lastName;

    public function __construct( string $firstName, string $lastName)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }
    /**
     * @param string   $name
     * @param int|null $size Length of field, if known
     *
     * @return callable|null
     */
    public function guessFormat($name, $size = null)
    {
        $name = Base::toLower($name);
        $generator = $this->generator;

        if (preg_match('/^is[_A-Z]/', $name)) {
            return static function () use ($generator) {
                return $generator->boolean;
            };
        }

        if (preg_match('/(_a|A)t$/', $name)) {
            return static function () use ($generator) {
                return $generator->dateTime;
            };
        }

        switch (str_replace('_', '', $name)) {
            case 'firstname':
                return static function () use ($generator) {
                    return $generator->firstName;
                };

            case 'lastname':
                return static function () use ($generator) {
                    return $generator->lastName;
                };

            case 'username':
            case 'login':
                return static function () use ($generator) {
                    return $generator->userName;
                };

            case 'email':
            case 'emailaddress':
                return static function () use ($generator) {
                    return $generator->email;
                };

            case 'phonenumber':
            case 'phone':
            case 'telephone':
            case 'telnumber':
                return static function () use ($generator) {
                    return $generator->phoneNumber;
                };

            case 'address':
                return static function () use ($generator) {
                    return $generator->address;
                };

            case 'city':
            case 'town':
                return static function () use ($generator) {
                    return $generator->city;
                };

            case 'streetaddress':
                return static function () use ($generator) {
                    return $generator->streetAddress;
                };

            case 'postcode':
            case 'zipcode':
                return static function () use ($generator) {
                    return $generator->postcode;
                };

            case 'state':
                return static function () use ($generator) {
                    return $generator->state;
                };

            case 'county':
                if ($this->generator->locale == 'en_US') {
                    return static function () use ($generator) {
                        return sprintf('%s County', $generator->city);
                    };
                }

                return static function () use ($generator) {
                    return $generator->state;
                };

            case 'country':
                switch ($size) {
                    case 2:
                        return static function () use ($generator) {
                            return $generator->countryCode;
                        };

                    case 3:
                        return static function () use ($generator) {
                            return $generator->countryISOAlpha3;
                        };

                    case 5:
                    case 6:
                        return static function () use ($generator) {
                            return $generator->locale;
                        };

                    default:
                        return static function () use ($generator) {
                            return $generator->country;
                        };
                }

                break;

            case 'locale':
                return static function () use ($generator) {
                    return $generator->locale;
                };

            case 'currency':
            case 'currencycode':
                return static function () use ($generator) {
                    return $generator->currencyCode;
                };

            case 'url':
            case 'website':
                return static function () use ($generator) {
                    return $generator->url;
                };

            case 'company':
            case 'companyname':
            case 'employer':
                return static function () use ($generator) {
                    return $generator->company;
                };

            case 'title':
                if ($size !== null && $size <= 10) {
                    return static function () use ($generator) {
                        return $generator->title;
                    };
                }

                return static function () use ($generator) {
                    return $generator->sentence;
                };

            case 'body':
            case 'summary':
            case 'article':
            case 'description':
                return static function () use ($generator) {
                    return $generator->text;
                };
        }

        return null;
    }

    public function __toString(): string
    {
        return $this->firstName . " " . $this->lastName;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }
}
