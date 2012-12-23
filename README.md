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

