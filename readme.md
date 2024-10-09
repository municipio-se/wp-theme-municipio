# Municipio Theme

This WordPress theme is an LTS version of the Municipio Theme v4.25.0.

## Installation

1. Add the following to your `composer.json` file:
   ```json
   {
     "repositories": [
       {
         "type": "vcs",
         "url": "https://github.com/municipio-lts/wp-theme-municipio-2024.git",
         "only": [
           "municipio-lts/wp-theme-municipio-2024"
         ],
         "no-api": true
       },
     ]
   }
   ```
2. Install the package and its dependencies:
   ```bash
   composer require municipio-lts/wp-theme-municipio-2024:dev-main
   ```
3. Activate the theme in WordPress.
