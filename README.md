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

Within the default implementation contao-rpc supports JSON-RPC 2.0. Find out more about JSON-RPC
[here](http://www.jsonrpc.org/specification). However, contao-rpc is designed to be very flexibel
and extendable. This means if you need something other then JSON-RPC, in most cases it should
 be easy to implement using contao-rpc as your base.

## License
Copyright (c) 2012 Simon Kusterer
Licensed under the LGPL license.