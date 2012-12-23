# contao-rpc

This is an RPC extension for the Content Management System Contao. It allows you as a developer
to define RPC Methods as simple as this:

```php

\\ In your config.php:

$GLOBALS['RPC']['methods'] => array
(
  'pong'    => array
  (
    'call'    => array('MyPong', 'pong')
  )
);

\\ Your MyPong class:

class MyPong
{
  public function pong($objRequest, $objResponse)
  {
    $objResponse->setData($objRequest->getParams()[0]);
  }
}
```

In the backend of contao you can define who is able to access the methods from external:

![CustomSelectWidget](https://raw.github.com/xat/contao-rpc/master/contao-rpc.png)

## License
Copyright (c) 2012 Simon Kusterer
Licensed under the LGPL license.