# CMMS Database Migrations - Organizadas por Módulos

## MÓDULO 1: AUTENTICACIÓN Y USUARIOS
### Orden de ejecución: 1-2

```php
// 001_create_users_table.php
// php artisan make:migration create_users_table

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('employee_id')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->enum('role', ['admin', 'manager', 'technician', 'operator']);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}

// 002_create_notifications_table.php
// php artisan make:migration create_notifications_table

class CreateNotificationsTable extends Migration
{
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->text('message');
            $table->enum('type', ['work_order', 'maintenance_due', 'inventory_low', 'asset_alert', 'general']);
            $table->json('data')->nullable();
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
```

## MÓDULO 2: CONFIGURACIÓN BASE
### Orden de ejecución: 3-6

```php
// 003_create_locations_table.php
// php artisan make:migration create_locations_table

class CreateLocationsTable extends Migration
{
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->text('description')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->foreignId('parent_location_id')->nullable()->constrained('locations')->onDelete('set null');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('locations');
    }
}

// 004_create_manufacturers_table.php
// php artisan make:migration create_manufacturers_table

class CreateManufacturersTable extends Migration
{
    public function up()
    {
        Schema::create('manufacturers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->string('contact_person')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('website')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('manufacturers');
    }
}

// 005_create_suppliers_table.php
// php artisan make:migration create_suppliers_table

class CreateSuppliersTable extends Migration
{
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->string('contact_person')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('website')->nullable();
            $table->text('notes')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('suppliers');
    }
}

// 006_create_work_order_types_table.php
// php artisan make:migration create_work_order_types_table

class CreateWorkOrderTypesTable extends Migration
{
    public function up()
    {
        Schema::create('work_order_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->text('description')->nullable();
            $table->string('color')->default('#3B82F6');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('work_order_types');
    }
}
```

## MÓDULO 3: GESTIÓN DE ACTIVOS
### Orden de ejecución: 7-11

```php
// 007_create_asset_categories_table.php
// php artisan make:migration create_asset_categories_table

class CreateAssetCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('asset_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->text('description')->nullable();
            $table->foreignId('parent_category_id')->nullable()->constrained('asset_categories')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('asset_categories');
    }
}

// 008_create_assets_table.php
// php artisan make:migration create_assets_table

class CreateAssetsTable extends Migration
{
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('asset_tag')->unique();
            $table->string('serial_number')->nullable();
            $table->string('model')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('category_id')->constrained('asset_categories')->onDelete('restrict');
            $table->foreignId('manufacturer_id')->nullable()->constrained('manufacturers')->onDelete('set null');
            $table->foreignId('location_id')->constrained('locations')->onDelete('restrict');
            $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null');
            $table->date('purchase_date')->nullable();
            $table->decimal('purchase_cost', 12, 2)->nullable();
            $table->date('warranty_expiry')->nullable();
            $table->enum('status', ['active', 'inactive', 'under_maintenance', 'disposed'])->default('active');
            $table->enum('condition', ['excellent', 'good', 'fair', 'poor', 'critical'])->default('good');
            $table->integer('useful_life_years')->nullable();
            $table->json('specifications')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('assets');
    }
}

// 009_create_asset_documents_table.php
// php artisan make:migration create_asset_documents_table

class CreateAssetDocumentsTable extends Migration
{
    public function up()
    {
        Schema::create('asset_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->constrained('assets')->onDelete('cascade');
            $table->string('name');
            $table->string('file_path');
            $table->string('file_type')->nullable();
            $table->integer('file_size')->nullable();
            $table->enum('document_type', ['manual', 'warranty', 'drawing', 'photo', 'certificate', 'other'])->default('other');
            $table->foreignId('uploaded_by')->constrained('users')->onDelete('restrict');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('asset_documents');
    }
}

// 010_create_asset_meter_readings_table.php
// php artisan make:migration create_asset_meter_readings_table

class CreateAssetMeterReadingsTable extends Migration
{
    public function up()
    {
        Schema::create('asset_meter_readings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->constrained('assets')->onDelete('cascade');
            $table->string('meter_type'); // hours, miles, cycles, etc.
            $table->decimal('reading', 12, 2);
            $table->datetime('reading_date');
            $table->foreignId('recorded_by')->constrained('users')->onDelete('restrict');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('asset_meter_readings');
    }
}

// 011_create_downtime_records_table.php
// php artisan make:migration create_downtime_records_table

class CreateDowntimeRecordsTable extends Migration
{
    public function up()
    {
        Schema::create('downtime_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->constrained('assets')->onDelete('cascade');
            $table->foreignId('work_order_id')->nullable()->constrained('work_orders')->onDelete('set null');
            $table->datetime('start_time');
            $table->datetime('end_time')->nullable();
            $table->enum('downtime_type', ['planned', 'unplanned']);
            $table->enum('reason', ['maintenance', 'breakdown', 'no_operator', 'no_material', 'other']);
            $table->text('description')->nullable();
            $table->decimal('cost_impact', 12, 2)->nullable();
            $table->foreignId('reported_by')->constrained('users')->onDelete('restrict');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('downtime_records');
    }
}
```

## MÓDULO 4: ÓRDENES DE TRABAJO Y MANTENIMIENTO
### Orden de ejecución: 12-16

```php
// 012_create_work_orders_table.php
// php artisan make:migration create_work_orders_table

class CreateWorkOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('work_orders', function (Blueprint $table) {
            $table->id();
            $table->string('work_order_number')->unique();
            $table->string('title');
            $table->text('description');
            $table->foreignId('asset_id')->nullable()->constrained('assets')->onDelete('set null');
            $table->foreignId('location_id')->constrained('locations')->onDelete('restrict');
            $table->foreignId('type_id')->constrained('work_order_types')->onDelete('restrict');
            $table->foreignId('created_by')->constrained('users')->onDelete('restrict');
            $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null');
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium');
            $table->enum('status', ['open', 'assigned', 'in_progress', 'on_hold', 'completed', 'cancelled'])->default('open');
            $table->datetime('requested_date')->default(now());
            $table->datetime('scheduled_date')->nullable();
            $table->datetime('started_at')->nullable();
            $table->datetime('completed_at')->nullable();
            $table->decimal('estimated_hours', 8, 2)->nullable();
            $table->decimal('actual_hours', 8, 2)->nullable();
            $table->decimal('estimated_cost', 12, 2)->nullable();
            $table->decimal('actual_cost', 12, 2)->nullable();
            $table->text('completion_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('work_orders');
    }
}

// 013_create_work_order_attachments_table.php
// php artisan make:migration create_work_order_attachments_table

class CreateWorkOrderAttachmentsTable extends Migration
{
    public function up()
    {
        Schema::create('work_order_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('work_order_id')->constrained('work_orders')->onDelete('cascade');
            $table->string('name');
            $table->string('file_path');
            $table->string('file_type')->nullable();
            $table->integer('file_size')->nullable();
            $table->foreignId('uploaded_by')->constrained('users')->onDelete('restrict');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('work_order_attachments');
    }
}

// 014_create_maintenance_schedules_table.php
// php artisan make:migration create_maintenance_schedules_table

class CreateMaintenanceSchedulesTable extends Migration
{
    public function up()
    {
        Schema::create('maintenance_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->foreignId('asset_id')->constrained('assets')->onDelete('cascade');
            $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null');
            $table->enum('frequency_type', ['days', 'weeks', 'months', 'years', 'hours', 'miles', 'cycles']);
            $table->integer('frequency_value');
            $table->date('start_date');
            $table->date('next_due_date');
            $table->date('last_completed')->nullable();
            $table->decimal('estimated_hours', 8, 2)->nullable();
            $table->decimal('estimated_cost', 12, 2)->nullable();
            $table->text('instructions')->nullable();
            $table->enum('status', ['active', 'inactive', 'paused'])->default('active');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('maintenance_schedules');
    }
}

// 015_create_maintenance_logs_table.php
// php artisan make:migration create_maintenance_logs_table

class CreateMaintenanceLogsTable extends Migration
{
    public function up()
    {
        Schema::create('maintenance_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->constrained('assets')->onDelete('cascade');
            $table->foreignId('work_order_id')->nullable()->constrained('work_orders')->onDelete('set null');
            $table->foreignId('performed_by')->constrained('users')->onDelete('restrict');
            $table->datetime('maintenance_date');
            $table->enum('maintenance_type', ['preventive', 'corrective', 'predictive', 'inspection']);
            $table->text('work_performed');
            $table->decimal('hours_spent', 8, 2)->nullable();
            $table->decimal('cost', 12, 2)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('maintenance_logs');
    }
}
```

## MÓDULO 5: INVENTARIO Y COMPRAS
### Orden de ejecución: 16-21

```php
// 016_create_inventory_categories_table.php
// php artisan make:migration create_inventory_categories_table

class CreateInventoryCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('inventory_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventory_categories');
    }
}

// 017_create_inventory_items_table.php
// php artisan make:migration create_inventory_items_table

class CreateInventoryItemsTable extends Migration
{
    public function up()
    {
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('part_number')->unique();
            $table->text('description')->nullable();
            $table->foreignId('category_id')->constrained('inventory_categories')->onDelete('restrict');
            $table->foreignId('manufacturer_id')->nullable()->constrained('manufacturers')->onDelete('set null');
            $table->string('unit_of_measure');
            $table->decimal('unit_cost', 12, 2)->nullable();
            $table->integer('current_stock')->default(0);
            $table->integer('minimum_stock')->default(0);
            $table->integer('maximum_stock')->nullable();
            $table->integer('reorder_point')->default(0);
            $table->integer('reorder_quantity')->default(0);
            $table->foreignId('location_id')->constrained('locations')->onDelete('restrict');
            $table->enum('status', ['active', 'inactive', 'discontinued'])->default('active');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventory_items');
    }
}

// 018_create_work_order_parts_table.php
// php artisan make:migration create_work_order_parts_table

class CreateWorkOrderPartsTable extends Migration
{
    public function up()
    {
        Schema::create('work_order_parts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('work_order_id')->constrained('work_orders')->onDelete('cascade');
            $table->foreignId('inventory_item_id')->constrained('inventory_items')->onDelete('cascade');
            $table->integer('quantity_requested');
            $table->integer('quantity_used')->default(0);
            $table->decimal('unit_cost', 12, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('work_order_parts');
    }
}

// 019_create_purchase_orders_table.php
// php artisan make:migration create_purchase_orders_table

class CreatePurchaseOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->string('po_number')->unique();
            $table->foreignId('supplier_id')->constrained('suppliers')->onDelete('restrict');
            $table->foreignId('requested_by')->constrained('users')->onDelete('restrict');
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');
            $table->date('order_date');
            $table->date('expected_delivery')->nullable();
            $table->date('actual_delivery')->nullable();
            $table->decimal('total_amount', 12, 2);
            $table->enum('status', ['draft', 'pending', 'approved', 'ordered', 'delivered', 'cancelled'])->default('draft');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('purchase_orders');
    }
}

// 020_create_purchase_order_items_table.php
// php artisan make:migration create_purchase_order_items_table

class CreatePurchaseOrderItemsTable extends Migration
{
    public function up()
    {
        Schema::create('purchase_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_order_id')->constrained('purchase_orders')->onDelete('cascade');
            $table->foreignId('inventory_item_id')->constrained('inventory_items')->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('unit_price', 12, 2);
            $table->decimal('total_price', 12, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('purchase_order_items');
    }
}
```

## ESTRUCTURA DE CARPETAS RECOMENDADA:

```
database/
├── migrations/
│   ├── 01_user_management/
│   │   ├── 001_create_users_table.php
│   │   └── 002_create_notifications_table.php
│   ├── 02_base_configuration/
│   │   ├── 003_create_locations_table.php
│   │   ├── 004_create_manufacturers_table.php
│   │   ├── 005_create_suppliers_table.php
│   │   └── 006_create_work_order_types_table.php
│   ├── 03_asset_management/
│   │   ├── 007_create_asset_categories_table.php
│   │   ├── 008_create_assets_table.php
│   │   ├── 009_create_asset_documents_table.php
│   │   ├── 010_create_asset_meter_readings_table.php
│   │   └── 011_create_downtime_records_table.php
│   ├── 04_work_orders_maintenance/
│   │   ├── 012_create_work_orders_table.php
│   │   ├── 013_create_work_order_attachments_table.php
│   │   ├── 014_create_maintenance_schedules_table.php
│   │   └── 015_create_maintenance_logs_table.php
│   └── 05_inventory_purchasing/
│       ├── 016_create_inventory_categories_table.php
│       ├── 017_create_inventory_items_table.php
│       ├── 018_create_work_order_parts_table.php
│       ├── 019_create_purchase_orders_table.php
│       └── 020_create_purchase_order_items_table.php
└── seeders/
    ├── UserManagementSeeder.php
    ├── BaseConfigurationSeeder.php
    ├── AssetManagementSeeder.php
    ├── WorkOrderSeeder.php
    └── InventorySeeder.php
```

## COMANDOS PARA CREAR LAS MIGRACIONES:

```bash
# Módulo 1: Gestión de Usuarios
php artisan make:migration create_users_table
php artisan make:migration create_notifications_table

# Módulo 2: Configuración Base  
php artisan make:migration create_locations_table
php artisan make:migration create_manufacturers_table
php artisan make:migration create_suppliers_table
php artisan make:migration create_work_order_types_table

# Módulo 3: Gestión de Activos
php artisan make:migration create_asset_categories_table
php artisan make:migration create_assets_table
php artisan make:migration create_asset_documents_table
php artisan make:migration create_asset_meter_readings_table
php artisan make:migration create_downtime_records_table

# Módulo 4: Órdenes de Trabajo y Mantenimiento
php artisan make:migration create_work_orders_table
php artisan make:migration create_work_order_attachments_table  
php artisan make:migration create_maintenance_schedules_table
php artisan make:migration create_maintenance_logs_table

# Módulo 5: Inventario y Compras
php artisan make:migration create_inventory_categories_table
php artisan make:migration create_inventory_items_table
php artisan make:migration create_work_order_parts_table
php artisan make:migration create_purchase_orders_table
php artisan make:migration create_purchase_order_items_table
```

Esta organización modular te permitirá:
- **Mejor mantenimiento** del código
- **Desarrollo independiente** por módulos
- **Despliegue incremental** si es necesario
- **Reutilización** de módulos en otros proyectos
- **Testing** más enfocado por funcionalidad

docker compose -f docker-compose.prod.yml exec app php artisan migrate:fresh --seed
