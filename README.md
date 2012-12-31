# contao-rpc

This is an RPC extension for the Content Management System Contao. It allows you as a developer
to define RPC Methods as simple as this:

```php

\\ In your config.php:

$GLOBALS['RPC']['methods'] => array
(
  'pong'    => array
  (
    'call'    => array('MyPing', 'ping')
  )
);

\\ Your MyPong class:

class MyPing
{
  public function ping($objRequest, $objResponse)
  {
    $objResponse->setData('pong');
  }
}
```

In the backend of contao you can define who is able to access the methods from external:

![CustomSelectWidget](https://raw.github.com/xat/contao-rpc/master/contao-rpc.png)

Within the default implementation contao-rpc supports JSON-RPC 2.0. Find out more about JSON-RPC
[here](http://www.jsonrpc.org/specification). However, contao-rpc is designed to be very flexibel
and extendable. This means if you need something other then JSON-RPC, in most cases it should
 be easy to implement using contao-rpc as your base.

## Dependencies
KeyGenerator Wizard: https://github.com/mediabakery/contao-KeyGenerator (optional, but recommend)


## License
Copyright (c) 2012 Simon Kusterer
Licensed under the LGPL license.
