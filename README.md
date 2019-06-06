# *** Deprecated ***
forbeslibrary.box has been deprecated. Please use [Varying Vagrant Vagrants](https://varyingvagrantvagrants.org/) instead.


Forbeslibrary.org Development Environment
===========

A virtual machine configured with Vagrant with dummy installations of software
used by Forbes Library including Omeka and Wordpress. Used for development.

## Required software
You will need [Vagrant](https://www.vagrantup.com/) and
[VirtualBox](https://www.virtualbox.org/).

### Setup
To get started use the command `vagrant provision` from within the
forbeslibrary.box directory.

As much of the setup as possible is handled by `vagrant provision`. In order to
avoid mixing local and remote node installations, however, the following
commands should be run locally (i.e., not within the virtual machine) after
provisioning.

```bash
cd public/omeka-2.4.1/themes/forbes-library
npm install
grunt
```

## Shared Folders

local machine: `public`<br>
virtual machine: `/var/www/`

## Applications
### MySQL
username | password
---------|----------
`root`   | *no password*

### Omeka
username | role | password
---------|------|----------
`admin`  |super | `password`

Database name: `omeka222`

To save database state, type, from within the virtual machine:

```bash
mysqldump -u root --databases omeka > /var/www/config/mysql/omeka-data.sql
```

### Wordpress</dt>
username | role | password
---------|------|----------
`adminuser`  |admin | `password`
`editor` |editor| `password`

Datbase name: `wordpress`

To save database state, type, from within the virtual machine:

```bash
mysqldump -u root --databases wordpress > /var/www/config/mysql/wordpress-data.sql
```
