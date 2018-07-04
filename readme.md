# Tk2 Example Plugin

__Project:__ [ttek-plg/sample](http://packagist.org/packages/ttek-plg/sample)  
__Published:__ 01 Sep 2016
__Web:__ <http://www.tropotek.com/>  
__Authors:__ Michael Mifsud <http://www.tropotek.com/>  
  
An sample Plugin for the new Tk2 plugin system. Use this to create your own plugins.

## Contents

- [Installation](#installation)
- [Introduction](#introduction)


## Installation

Available on Packagist ([ttek-plg/sample](http://packagist.org/packages/ttek-plg/sample))
and as such installable via [Composer](http://getcomposer.org/).

```bash
# composer require ttek-plg/sample
```

Or add the following to your composer.json file:

```json
{
  "ttek-plg/sample": "~1.0"
}
```

If you do not use Composer, you can grab the code from GitHub, and use any
PSR-0 compatible autoloader (e.g. the [plg-sample](https://github.com/tropotek/plg-sample))
to load the classes.


## Introduction

__NOTE:__ When creating plugins that will not be installed via composer be sure that 
 you use a single name as the plugin name (as the sample) as that will become its namespace.
 If you do use Composer then you can create custom namespaces in the composer.json file of 
 the plugin.



  
  