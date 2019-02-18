<?php return array (
  'backpack/backupmanager' => 
  array (
    'providers' => 
    array (
      0 => 'Backpack\\BackupManager\\BackupManagerServiceProvider',
    ),
  ),
  'backpack/base' => 
  array (
    'providers' => 
    array (
      0 => 'Backpack\\Base\\BaseServiceProvider',
    ),
  ),
  'backpack/crud' => 
  array (
    'providers' => 
    array (
      0 => 'Backpack\\CRUD\\CrudServiceProvider',
    ),
    'aliases' => 
    array (
      'CRUD' => 'Backpack\\CRUD\\CrudServiceProvider',
    ),
  ),
  'backpack/generators' => 
  array (
    'providers' => 
    array (
      0 => 'Backpack\\Generators\\GeneratorsServiceProvider',
    ),
  ),
  'backpack/logmanager' => 
  array (
    'providers' => 
    array (
      0 => 'Backpack\\LogManager\\LogManagerServiceProvider',
    ),
  ),
  'backpack/menucrud' => 
  array (
    'providers' => 
    array (
      0 => 'Backpack\\MenuCRUD\\MenuCRUDServiceProvider',
    ),
  ),
  'backpack/newscrud' => 
  array (
    'providers' => 
    array (
      0 => 'Backpack\\NewsCRUD\\NewsCRUDServiceProvider',
    ),
  ),
  'backpack/pagemanager' => 
  array (
    'providers' => 
    array (
      0 => 'Backpack\\PageManager\\PageManagerServiceProvider',
    ),
  ),
  'backpack/permissionmanager' => 
  array (
    'providers' => 
    array (
      0 => 'Backpack\\PermissionManager\\PermissionManagerServiceProvider',
    ),
  ),
  'backpack/settings' => 
  array (
    'providers' => 
    array (
      0 => 'Backpack\\Settings\\SettingsServiceProvider',
    ),
  ),
  'barryvdh/laravel-dompdf' => 
  array (
    'providers' => 
    array (
      0 => 'Barryvdh\\DomPDF\\ServiceProvider',
    ),
    'aliases' => 
    array (
      'PDF' => 'Barryvdh\\DomPDF\\Facade',
    ),
  ),
  'barryvdh/laravel-elfinder' => 
  array (
    'providers' => 
    array (
      0 => 'Barryvdh\\Elfinder\\ElfinderServiceProvider',
    ),
  ),
  'creativeorange/gravatar' => 
  array (
    'providers' => 
    array (
      0 => 'Creativeorange\\Gravatar\\GravatarServiceProvider',
    ),
    'aliases' => 
    array (
      'Gravatar' => 'Creativeorange\\Gravatar\\Facades\\Gravatar',
    ),
  ),
  'cviebrock/eloquent-sluggable' => 
  array (
    'providers' => 
    array (
      0 => 'Cviebrock\\EloquentSluggable\\ServiceProvider',
    ),
  ),
  'fideloper/proxy' => 
  array (
    'providers' => 
    array (
      0 => 'Fideloper\\Proxy\\TrustedProxyServiceProvider',
    ),
  ),
  'intervention/image' => 
  array (
    'providers' => 
    array (
      0 => 'Intervention\\Image\\ImageServiceProvider',
    ),
    'aliases' => 
    array (
      'Image' => 'Intervention\\Image\\Facades\\Image',
    ),
  ),
  'jenssegers/date' => 
  array (
    'providers' => 
    array (
      0 => 'Jenssegers\\Date\\DateServiceProvider',
    ),
    'aliases' => 
    array (
      'Date' => 'Jenssegers\\Date\\Date',
    ),
  ),
  'laracasts/generators' => 
  array (
    'providers' => 
    array (
      0 => 'Laracasts\\Generators\\GeneratorsServiceProvider',
    ),
  ),
  'prologue/alerts' => 
  array (
    'providers' => 
    array (
      0 => 'Prologue\\Alerts\\AlertsServiceProvider',
    ),
    'aliases' => 
    array (
      'Alert' => 'Prologue\\Alerts\\Facades\\Alert',
    ),
  ),
  'spatie/laravel-backup' => 
  array (
    'providers' => 
    array (
      0 => 'Spatie\\Backup\\BackupServiceProvider',
    ),
  ),
  'spatie/laravel-permission' => 
  array (
    'providers' => 
    array (
      0 => 'Spatie\\Permission\\PermissionServiceProvider',
    ),
  ),
  'spatie/laravel-translatable' => 
  array (
    'providers' => 
    array (
      0 => 'Spatie\\Translatable\\TranslatableServiceProvider',
    ),
  ),
);