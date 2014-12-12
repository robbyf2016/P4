##Project 4 - Robby Fussell
>## Live URL
><http://p4.robbyfussell-harvard.me>

>## My class site URL
><http://p1.robbyfussell-harvard.me>

>## Description
The purpose of this site is to demonstrate various PHP application requests to a database, implementation of routes via controllers, view blades, and other PHP and Laravel functionality. The web application enters data into the MySQL database via forms or provides an option to produce some desired output via a search form.


## Demo Information
>    Will be performing to do a live demo - Diana please feel free to schedule me at anytime.

## Details
   This web application is built on Laravel MVC, PHP, HTML, CSS, Toddish RBAC, and Bootstrap.
     There are three defined roles:
     - Admin role
     - Employee role
     - Client role
   If a user signs up for a login account, they are given the default client role. Depending on the role, a user can only perform the functions identified in the role based matrix diagram. Authentication and authorization is performed on each function route to determine accessibility. Depending on the current authenticated user, the "site functions" menu will only show the functions which they can perform. If a user attempts to call a function route in the URL, the application will determine if they are authorized or not and will respond accordingly.

   Under the admin role, a user is able to perform all CRUD functionality as in create services, clients, and orders; read services, clients, and orders; update clients and services; and delete services.

## Outside Code
- HTML 5 image - <http://www.pathowe.co.uk/news/HTML5.png>
- W3C W3C CSS image - <http://jigsaw.w3.org/css-validator/images/vcss-blue>
- Bootstrap - <http://getbootstrap.com/>
- Toddish - <https://packagist.org/packages/toddish/verify>
- Paste\Pre from Aaron Oxborrow - <https://packagist.org/packages/paste/pre>
- Laravel PHP Framework - see below

## Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/downloads.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, and caching.

Laravel aims to make the development process a pleasing one for the developer without sacrificing application functionality. Happy developers make the best code. To this end, we've attempted to combine the very best of what we have seen in other web frameworks, including frameworks implemented in other languages, such as Ruby on Rails, ASP.NET MVC, and Sinatra.

Laravel is accessible, yet powerful, providing powerful tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

## Official Documentation

Documentation for the entire framework can be found on the [Laravel website](http://laravel.com/docs).

### Contributing To Laravel

**All issues and pull requests should be filed on the [laravel/framework](http://github.com/laravel/framework) repository.**

### License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
