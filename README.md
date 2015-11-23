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

## License

The EASOL Dashboard is licensed under the GNU Affero General Public License, version 3.  Please see LICENSE.md for more information.

## Copyright

(c) 2015 Heimes Communications LLC.
