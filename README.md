# EASOL Dashboard

## Overview

EASOL helps teachers and school leaders bring their favorite educational technologies together onto one platform so that they can optimize learning. Educators can choose to integrate various data sources and blended learning tools so that they "talk" to one another and, therefore, allow them to get the most out of these systems. It’s all about making the use of educational technology easier and more powerful.

The EASOL Dashboard is a user interface to view information stored within the common data store.

The EASOL development team includes teachers, school leaders, data specialists and software engineers. Each element of the system is piloted in real classrooms so that we can get on-the-ground, real world feedback to inform the kind and format of educational technologies included in EASOL.

## Technical Information

The EASOL Dashboard is a PHP web application, chosen for its easy-to-deploy and accessibility to technologists of all levels.  At its core, EASOL uses utilizes the CodeIgniter web application framework to leverage a well-known, stable MVC framework for rapid application development.  Please see http://codeigniter.com for more information.

EASOL uses Ed-Fi Alliance common data model as its data store schema.  Currently, the Ed-Fi schema is designed for Microsoft SQL Server.  Please see http://ed-fi.org for more information.

EASOL is currently in an active development and beta state.

## Installation

* Download the EASOL Dashboard from GitHub

* Configure using your PHP environment of choice (tested using Apache, Nginx and Internet Information Server (IIS)).

* Build the underlying Ed-Fi v2 data schema at sql/mssql

* For environment specific instructions, please see [Environment Installation.](https://github.com/EASOL/easol/wiki/EASOL:-Environment-Installation)

## Tests

We're using Codeception as testing framework. It was installed using composer and added to the vendor folder.

We were using previously using a pure PHPUnit with a CodeIgniter module to run unit test, and we were testing controllers only. It happens that testing a controller is not actually unit tests, cause a controller have a lot of components inside it, we have models, logic operations, and views being called. So they are more like integration/functional tests. The CodeIgniter files that allows unit tests with PHPUnit was causing issues with different environments, so we're moving to Codeception instead.

Codeception allows you to run unit, functional, and acceptance tests. For now, we're focusing in functional tests, so we should be using a more BDD approach instead of TDD. We can expand tests undefinitelly though, so we might implement different tests types in the long run. For unit tests though, we might just use CodeIgniter's unit test library.

### Setting up functional tests

To set up the functional tests, you need to create a functional.suite.yml file. In the "./tests" folder, you'll find a functional.suite.template.yml file. Just adjust the Url parameter to match your server's URL.

After creating the functional.suite.yml file, you need to run this command (from the system root):

> vendor/bin/codecept build

After that, we should be all good to run the tests. To run tests, you run this command:

> vendor/bin/codecept run

If you want to run a specific test type, for example, functional tests, which should be our case, you can run

> vendor/bin/codecept run functional

If you look at the functional.suite.yml file, you'll see that we have header parameters, one for X-Test-Key. That's to allow the system to recognize test requests and do authentication stuff accordingly (read more about that below). The value there should match the configuration at ./application/config/auth.php. At the bottom of that file, you'll see an entry for $config['auth']['TEST_KEY'].


### Creating tests

Creating tests is easy and really semantic. Look at the "./tests/function" folder. There's a simple example there that test the Reports index page. For a complete reference, look at the docs: http://codeception.com/docs/04-FunctionalTests

The only piece that is specific to us is the headers settings we can use to create session variables easily. If you want to be logged in as an specific user, you can do

```
$I->setHeader('X-Test-User', 'edgar.f91@gmail.com');
```

Or you can pass the StaffUSI instead of the email:

```
$I->setHeader('X-Test-User', '207220');
```

You can also set up the School context:

```
$I->setHeader('X-Test-School', [SchoolId]);
```

If the user you're logging in has access to more than one school, the code will automatically select the first school it finds, if the request has no header for School context. If the user you're logging in with has access to only one school (for example, the user is a Educator), the school is also automatically selected, just like happens when you login through the site.


### Acceptance tests

We're not focusing in acceptance tests for now, but if we want to do it, it's not hard. We might use it specially if we want to test JavaScript. If so, we need to use the Selenium webdriver installe.

In order to run acceptance tests, we need to have selenium running on our server. If you're running the system locally, you need to run selenium on your system.

Just download selenium from http://docs.seleniumhq.org/download/, and execute it from command line with 

> java -jar selenium-server-standalone-3.0.0-beta4.jar

It requires java to be installed in the system.

You also need the geckodriver to be installed: https://github.com/mozilla/geckodriver/releases.

The Selenium client bindings will try to locate the geckodriver executable from the system PATH. You will need to add the directory containing the executable to the system path.


On Unix systems you can do the following to append it to your system’s search path, if you’re using a bash-compatible shell:

export PATH=$PATH:/path/to/directory/of/executable/downloaded/in/previous/step

On Windows you need to update the Path system variable to add the full directory path to the executable. The principle is the same as on Unix.

Reference: http://stackoverflow.com/questions/38676719/fail-to-launch-mozilla-with-selenium

## License

The EASOL Dashboard is licensed under the GNU Affero General Public License, version 3.  Please see LICENSE.md for more information.

## Copyright

(c) 2015 Heimes Communications LLC.
