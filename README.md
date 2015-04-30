Forbeslibrary.org Development Environment
===========

A virtual machine configured with vagrant with dummy installations of software used by Forbes Library including Omeka and Wordpress. Used for development.

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
mysqldump -u root --databases wordpress > /var/www/config/mysql/wordpress-data.sql
```

### Wordpress</dt>
username | role | password
---------|------|----------
`admin`  |admin | `password`
`editor` |editor| `password`

Datbase name: `wordpress`

To save database state, type, from within the virtual machine:

```bash
mysqldump -u root --databases omeka222 > /var/www/config/mysql/omeka-2.2.2-data.sql
```
