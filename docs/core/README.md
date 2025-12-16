# Core Documentation

Dokumentasi lengkap untuk semua core classes dan utilities dalam Yii2 Skeleton.

## 📚 Daftar Core Classes

### API & Controller Layer
1. **[CoreAPI](./CoreAPI.md)** - Utility methods untuk timestamps, user management, validation, dan error handling
2. **[CoreController](./CoreController.md)** - Base controller untuk RESTful API endpoints
3. **[CoreErrorHandler](./CoreErrorHandler.md)** - Custom error handler untuk JSON responses

### Model & Data Layer
4. **[CoreModel](./CoreModel.md)** - Core model utilities untuk data manipulation dan validation
5. **[CoreConstants](./CoreConstants.md)** - Standardized constants untuk status codes, scenarios, dan validation patterns

### Database Query Builders
6. **[CoreMySQL](./CoreMySQL.md)** - Base ActiveQuery class untuk MySQL queries
7. **[CorePostgreSQL](./CorePostgreSQL.md)** - Base ActiveQuery class untuk PostgreSQL queries
8. **[CoreMongodb](./CoreMongodb.md)** - Utility methods untuk MongoDB queries

### Configuration & Localization
9. **[CoreParamLoader](./CoreParamLoader.md)** - Loader untuk default core parameters
10. **[CoreMessageSource](./CoreMessageSource.md)** - Custom message source untuk i18n/translation
11. **[Environment](./Environment.md)** - Environment variable helper functions

## 📁 Struktur Folder

```
docs/core/
├── README.md                    # File ini
├── CoreAPI.md                   # Utility methods
├── CoreConstants.md             # Constants definitions
├── CoreController.md            # Base API controller
├── CoreErrorHandler.md          # Error handling
├── CoreMessageSource.md         # i18n/translation
├── CoreModel.md                 # Model utilities
├── CoreMongodb.md               # MongoDB queries
├── CoreMySQL.md                 # MySQL queries
├── CoreParamLoader.md           # Parameter loading
├── CorePostgreSQL.md            # PostgreSQL queries
└── Environment.md               # Environment variables
```

## 🚀 Quick Start

### Menggunakan CoreAPI

```php
use app\core\CoreAPI;

// Get current timestamp
$timestamp = CoreAPI::timestamp();

// Get current username
$username = CoreAPI::getUsername();

// Check if user is superadmin
if (CoreAPI::superAdmin()) {
    // Allow superadmin operations
}
```

### Menggunakan CoreController

```php
use app\core\CoreController;

class UserController extends CoreController
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find()->active(),
        ]);
        
        return $this->coreData($dataProvider);
    }
    
    public function actionView($id)
    {
        $user = $this->coreFindModelOne(User::class, ['id' => $id]);
        
        if ($user === null) {
            throw new NotFoundHttpException('User not found');
        }
        
        return $this->coreSuccess($user);
    }
}
```

### Menggunakan CoreModel

```php
use app\core\CoreModel;

// Purify user input
$name = CoreModel::htmlPurifier($input);

// Create like filter
$query->andFilterWhere(CoreModel::setLikeFilter($keyword, 'name'));

// Check restricted status
if (CoreModel::isRestrictedStatus($model->status)) {
    throw new Exception('Cannot modify');
}
```

### Menggunakan Query Builders

```php
use app\models\User;

// MySQL queries
$users = User::find()
    ->active()
    ->orderByName(SORT_ASC)
    ->all();

// MongoDB queries
$where = [];
CoreMongodb::mdbStringLike('name', $keyword, $where);
$users = User::find()->where($where)->all();
```

### Menggunakan Environment Variables

```php
use function app\core\env_group;
use function app\core\env_value;

// Get grouped configuration
$dbConfig = env_group('db');

// Get single value
$debug = env_value('APP.DEBUG', false);
```

## 📖 Dokumentasi Lengkap

Setiap dokumentasi mencakup:

- **Deskripsi**: Penjelasan singkat tentang class/function
- **Fitur Utama**: List fitur-fitur utama dengan checkmarks
- **Metode/Fungsi**: Dokumentasi lengkap setiap method dengan:
  - Parameters dan return types
  - Contoh penggunaan
  - Use cases praktis
- **Konfigurasi**: Setup dan configuration details
- **Best Practices**: Tips dan best practices
- **Catatan Penting**: Important notes dan considerations

## 🔗 Relationship Diagram

```
CoreController
    ├── Uses CoreAPI (utility methods)
    ├── Uses CoreModel (data utilities)
    ├── Uses CoreConstants (status codes)
    └── Returns standardized responses

CoreModel
    ├── Uses CoreConstants (validation rules)
    ├── Provides data purification
    └── Provides validation helpers

Database Queries
    ├── CoreMySQL (MySQL queries)
    ├── CorePostgreSQL (PostgreSQL queries)
    └── CoreMongodb (MongoDB queries)

Configuration
    ├── CoreParamLoader (load defaults)
    ├── CoreMessageSource (i18n)
    └── Environment (env variables)

Error Handling
    └── CoreErrorHandler (JSON responses)
```

## 📋 Namespace & Import

Semua core classes menggunakan namespace `app\core`:

```php
use app\core\CoreAPI;
use app\core\CoreController;
use app\core\CoreModel;
use app\core\CoreConstants;
use app\core\CoreErrorHandler;
use app\core\CoreMessageSource;
use app\core\CoreMySQL;
use app\core\CorePostgreSQL;
use app\core\CoreMongodb;
use app\core\CoreParamLoader;

// Environment functions (global)
use function app\core\env_group;
use function app\core\env_value;
use function app\core\parse_env_value;
```

## 🎯 Common Use Cases

### 1. Creating API Endpoint

```php
class ProductController extends CoreController
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find()->active(),
        ]);
        return $this->coreData($dataProvider);
    }
    
    public function actionCreate()
    {
        $model = new Product();
        $model->load(Yii::$app->request->post());
        
        if ($model->save()) {
            return $this->coreSuccess($model, 'Product created');
        }
        
        throw new CoreException($model, 'Validation failed', 422);
    }
}
```

### 2. Querying with Status Filters

```php
// MySQL
$products = Product::find()
    ->active()
    ->orderByName(SORT_ASC)
    ->all();

// PostgreSQL
$products = Product::find()
    ->active()
    ->orderByName(SORT_ASC)
    ->all();
```

### 3. Searching with MongoDB

```php
$where = [];
CoreMongodb::mdbStringLike('name', $keyword, $where);
CoreMongodb::mdbStatus('status', 1, $where);

$products = Product::find()->where($where)->all();
```

### 4. Data Validation & Purification

```php
$data = Yii::$app->request->post();
$data = CoreModel::purifyArray($data);

$model = new Product();
$model->load($data);

CoreAPI::unavailableParams($model, $data);

if ($model->save()) {
    return $this->coreSuccess($model);
}
```

## ⚙️ Configuration Files

Dokumentasi ini mengasumsikan struktur konfigurasi standar:

```
config/
├── web.php              # Web application config
├── console.php          # Console config
├── params.php           # Project parameters
├── params_app.php       # User parameters
└── setup/
    ├── db_manager.php   # Database config
    └── console.php      # Console setup
```

## 📝 Catatan Penting

- Semua core classes menggunakan namespace `app\core`
- Dokumentasi ini mengikuti standar Yii2 Framework
- Setiap method dilengkapi dengan docblock dan contoh penggunaan
- Response format selalu standardized dengan `code`, `success`, `message`, `data`
- Error handling menggunakan CoreException untuk consistency
- Database queries chainable dan dapat dikombinasikan
- Environment variables support type parsing otomatis

## 🔍 Tips Navigasi

- Gunakan **Ctrl+F** untuk mencari method/function tertentu
- Setiap dokumentasi memiliki table of contents
- Contoh kode dapat langsung dicopy-paste
- Best practices section memberikan tips implementasi
- Catatan penting di akhir setiap dokumentasi

## 📞 Support

Untuk pertanyaan atau issues:
1. Baca dokumentasi yang relevan terlebih dahulu
2. Periksa contoh penggunaan
3. Lihat best practices section
4. Konsultasikan dengan tim development
