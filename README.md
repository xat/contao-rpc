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

Within the default implementation contao-rpc supports JSON-RPC 2.0. Find out more about JSON-RPC
[here](http://www.jsonrpc.org/specification). However, contao-rpc is designed to be very flexibel
and extendable. This means if you need something other then JSON-RPC, in most cases it should
 be easy to implement using contao-rpc as your base.

## Use Cases

* Building any kind of Frontend GUI using Contao as Backend. E.g.: Native mobile Apps, JavaScript Apps, Flash Apps, Java Apps,....
* Run certain tasks remotely: Export Data (e.g. Newsletter receivers, Backups), Create News Entries,...
* Use it as Ajax Entrypoint for a normal Contao Website
* Create a native mobile Contao-Backend-App using contao-rpc as Entrypoint

## Dependencies
Hooky: https://github.com/xat/contao-hooky (required)
KeyGenerator Wizard: https://github.com/mediabakery/contao-KeyGenerator (optional, but recommend)

## License
Copyright (c) 2012 Simon Kusterer
Licensed under the LGPL license.
