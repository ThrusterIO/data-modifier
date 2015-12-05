# DataModifier Component

[![Latest Version](https://img.shields.io/github/release/ThrusterIO/data-modifier.svg?style=flat-square)]
(https://github.com/ThrusterIO/data-modifier/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)]
(LICENSE)
[![Build Status](https://img.shields.io/travis/ThrusterIO/data-modifier.svg?style=flat-square)]
(https://travis-ci.org/ThrusterIO/data-modifier)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/ThrusterIO/data-modifier.svg?style=flat-square)]
(https://scrutinizer-ci.com/g/ThrusterIO/data-modifier)
[![Quality Score](https://img.shields.io/scrutinizer/g/ThrusterIO/data-modifier.svg?style=flat-square)]
(https://scrutinizer-ci.com/g/ThrusterIO/data-modifier)
[![Total Downloads](https://img.shields.io/packagist/dt/thruster/data-modifier.svg?style=flat-square)]
(https://packagist.org/packages/thruster/data-modifier)

[![Email](https://img.shields.io/badge/email-team@thruster.io-blue.svg?style=flat-square)]
(mailto:team@thruster.io)

The Thruster DataModifier Component.


## Install

Via Composer

```bash
$ composer require thruster/data-modifier
```

## Usage

The sample code to understand working principle:

```php
<?PHP

use Thruster\Component\DataModifier\DataModifierInterface;
use Thruster\Component\DataModifier\DataModifierGroup;

$user = new class {
    protected $username = 'foo_bar';
    protected $password = 'youwillnotguessit';
    protected $activationCode;

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setActivationCode($activationCode)
    {
        $this->activationCode = $activationCode;
    }
};

$passwordHasher = new class implements DataModifierInterface {
    public function modify($input)
    {
        $input->setPassword(password_hash($input->getPassword(), PASSWORD_BCRYPT));

        return $input;
    }
};

$activationCodegenerator = new class implements DataModifierInterface {
    public function modify($input)
    {
        $input->setActivationCode(substr(md5(strrev(microtime(true))), 0, 12));

        return $input;
    }
};

$modifierGroup = new DataModifierGroup();
$modifierGroup->addModifier($passwordHasher, 1);
$modifierGroup->addModifier($activationCodegenerator);

var_dump($modifierGroup->modify($user));
```

```php
class class@anonymous#2 (3) {
  protected $username =>
  string(7) "foo_bar"
  protected $password =>
  string(60) "$2y$10$B1F39njifACQcr68osihIeMM0Ps/yAlOrGiEdb.KGgVqBWMARiDqm"
  protected $activationCode =>
  string(12) "25018c42dd5d"
}
```


## Testing

``` bash
$ composer test
```


## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.


## License

Please see [License File](LICENSE) for more information.
