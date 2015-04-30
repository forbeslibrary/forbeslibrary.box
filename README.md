Forbeslibrary.org Development Environment
===========

A virtual machine configured with vagrant with dummy installations of software used by Forbes Library including Omeka and Wordpress. Used for development.

## Shared Folders

local machine: `public`<br>
virtual machine: `/var/www/`

## Databases
<dl>
  <dt>Omeka</dt>
  <dd>
    `omeka222`
    <br>
    To save database state, type:

    ```bash
    mysqldump -u root --databases wordpress > /var/www/config/mysql/wordpress-data.sql
    ```
  </dd>
  <dt>Wordpress</dt>
  <dd>
    `wordpress`
    To save database state, type:

    ```bash
    mysqldump -u root --databases omeka222 > /var/www/config/mysql/omeka-2.2.2-data.sql
    ```
  </dd>
</dl>

## User Accounts

### MySQL
username | password
---------|----------
`root`   | *no password*

### Omeka
username | role | password
---------|------|----------
`admin`  |super | `password`

### Wordpress
username | role | password
---------|------|----------
`admin`  |admin | `password`
`editor` |editor| `password`
