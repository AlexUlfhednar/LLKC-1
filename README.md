## Project structure
As most MVC frameworks, this project flows through `public/index.php` and loads the correspondant page base on the URL
```
LLKCC-1/
    config/             # Database credentials
    data/               # SQL database file
    public/             # Accessible files
        css/            # css file
        js/             # javascript file
        index.php       # Starting point for the entire app
    app/                # Application source code
        Libs/           # Redirect, View, Model, Db, Controller classes
        Controllers/    # Controller classes
        Models/         # Model classes
        Views/          # Views
    vendor/             # Composer files, autoloader !ignored
```
