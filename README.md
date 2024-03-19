# Introduction / Overview

This repository is an example of how to 'containerize' a composite application.  In this case, multiple containers are used to separate the data in a MySQL database from the PHPH / Apache implementation for Wordpress.  While it is true that an official Docker image exists for Wordpress, this repository - [and the accompanying blog series here](https://occasional-it.com/2024/03/05/how-do-i-containerize-something/) - assumes a use case where a composite application has been deployed 'on premise,' and the business has a requirement to encapsulate the application into containers.

Following best practices, the database has been captured in one container, and the Wordpress installation has been captured into a separate container.  Further, a transient container ('datamover') is used to copy an existing dataset into either a 'test' environment (using 'test' data), or a 'production' environment (using a copy of 'production' data.)

[Follow along with the blog](https://occasional-it.com/2024/03/05/how-do-i-containerize-something/), and use this repository for reference.