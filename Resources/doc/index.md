AxeleroMonoBundle
======================

1. [Installation](#1-installation)
2. [Configuration](#2-configuration)
3. [Usage](#3-usage)

### 1. Installation

Run from terminal:

```bash
$ php composer.phar require axelero/axelero-mono-bundle
```

Enable bundle in the kernel:

```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Axelero\MonoBundle\AxeleroMonoBundle(),
    );
}
```

### 2. Configuration

Add following lines in your configuration:

``` yaml
# app/config/config.yml

axelero_mono:
    api_reseller_token: "%mono_reseller_token%"
```

You should define ``mono_reseller_token`` parameters in your ``app/config/parameters.yml`` file.

``` yaml
# app/config/config_test.yml

axelero_mono:
    mono_class:  Axelero\MonoBundle\Tests\Mono\Stub\ResellerStub
```


### 3. Usage

TODO