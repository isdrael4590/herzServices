atabase/
├── migrations/
│   ├── 01_user_management/
│   │   ├── 001_create_users_table.php
│   │   ├── 002_create_roles_table.php
│   │   ├── 003_create_permissions_table.php
│   │   ├── 004_create_role_permissions_table.php
│   │   └── 005_create_user_roles_table.php
│   ├── 02_company_configuration/
│   │   ├── 006_create_companies_table.php
│   │   ├── 007_create_departments_table.php
│   │   ├── 008_create_business_hours_table.php
│   │   └── 009_create_sla_policies_table.php
│   ├── 03_customer_management/
│   │   ├── 010_create_customer_types_table.php
│   │   ├── 011_create_customers_table.php
│   │   ├── 012_create_customer_contacts_table.php
│   │   ├── 013_create_customer_addresses_table.php
│   │   └── 014_create_customer_notes_table.php
│   ├── 04_service_catalog/
│   │   ├── 015_create_service_categories_table.php
│   │   ├── 016_create_services_table.php
│   │   ├── 017_create_service_contracts_table.php
│   │   └── 018_create_contract_services_table.php
│   ├── 05_ticket_system/
│   │   ├── 019_create_ticket_priorities_table.php
│   │   ├── 020_create_ticket_statuses_table.php
│   │   ├── 021_create_ticket_categories_table.php
│   │   ├── 022_create_tickets_table.php
│   │   ├── 023_create_ticket_responses_table.php
│   │   ├── 024_create_ticket_attachments_table.php
│   │   ├── 025_create_ticket_assignments_table.php
│   │   └── 026_create_ticket_escalations_table.php
│   ├── 06_knowledge_base/
│   │   ├── 027_create_kb_categories_table.php
│   │   ├── 028_create_kb_articles_table.php
│   │   ├── 029_create_kb_article_tags_table.php
│   │   └── 030_create_kb_article_ratings_table.php
│   ├── 07_communication/
│   │   ├── 031_create_email_templates_table.php
│   │   ├── 032_create_notifications_table.php
│   │   ├── 033_create_communication_logs_table.php
│   │   └── 034_create_auto_responses_table.php
│   └── 08_reporting_analytics/
│       ├── 035_create_report_templates_table.php
│       ├── 036_create_dashboards_table.php
│       ├── 037_create_metrics_table.php
│       └── 038_create_audit_logs_table.php
└── seeders/
    ├── UserManagementSeeder.php
    ├── CompanyConfigurationSeeder.php
    ├── CustomerManagementSeeder.php
    ├── ServiceCatalogSeeder.php
    ├── TicketSystemSeeder.php
    ├── KnowledgeBaseSeeder.php
    ├── CommunicationSeeder.php
    └── ReportingSeeder.php

<?php

// =============================================================================
// 01_user_management/001_create_users_table.php
// =============================================================================

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id', 20)->unique()->nullable();
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('avatar', 500)->nullable();
            $table->string('phone', 20)->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->string('position', 100)->nullable();
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->date('hire_date')->nullable();
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active');
            $table->timestamp('last_login_at')->nullable();
            $table->string('timezone', 50)->default('UTC');
            $table->string('language', 5)->default('es');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['status', 'created_at']);
            $table->index('department_id');
            $table->index('manager_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};

// =============================================================================
// 01_user_management/002_create_roles_table.php
// =============================================================================

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->string('slug', 100)->unique();
            $table->text('description')->nullable();
            $table->integer('level')->default(1);
            $table->boolean('is_system')->default(false);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            
            $table->index('status');
            $table->index('level');
        });
    }

    public function down()
    {
        Schema::dropIfExists('roles');
    }
};

// =============================================================================
// 01_user_management/003_create_permissions_table.php
// =============================================================================

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->string('slug', 100)->unique();
            $table->text('description')->nullable();
            $table->string('resource', 50);
            $table->string('action', 50);
            $table->timestamps();
            
            $table->index(['resource', 'action']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('permissions');
    }
};

// =============================================================================
// 01_user_management/004_create_role_permissions_table.php
// =============================================================================

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('role_permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained()->onDelete('cascade');
            $table->foreignId('permission_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['role_id', 'permission_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('role_permissions');
    }
};

// =============================================================================
// 01_user_management/005_create_user_roles_table.php
// =============================================================================

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_roles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('role_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('assigned_by')->nullable();
            $table->timestamp('assigned_at')->useCurrent();
            $table->timestamp('expires_at')->nullable();
            
            $table->foreign('assigned_by')->references('id')->on('users')->onDelete('set null');
            $table->unique(['user_id', 'role_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_roles');
    }
};

// =============================================================================
// 02_company_configuration/006_create_companies_table.php
// =============================================================================

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('legal_name')->nullable();
            $table->string('tax_id', 50)->nullable();
            $table->string('logo', 500)->nullable();
            $table->string('website')->nullable();
            $table->string('email')->nullable();
            $table->string('phone', 20)->nullable();
            $table->text('address')->nullable();
            $table->string('city', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('postal_code', 20)->nullable();
            $table->string('country', 100)->nullable();
            $table->string('timezone', 50)->default('UTC');
            $table->string('currency', 3)->default('USD');
            $table->string('language', 5)->default('es');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('companies');
    }
};

// =============================================================================
// 02_company_configuration/007_create_departments_table.php
// =============================================================================

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('slug', 100)->unique();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->decimal('budget', 15, 2)->nullable();
            $table->string('cost_center', 50)->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            
            $table->foreign('parent_id')->references('id')->on('departments')->onDelete('set null');
            $table->foreign('manager_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('departments');
    }
};

// =============================================================================
// 02_company_configuration/008_create_business_hours_table.php
// =============================================================================

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('business_hours', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('timezone', 50);
            $table->time('monday_start')->nullable();
            $table->time('monday_end')->nullable();
            $table->time('tuesday_start')->nullable();
            $table->time('tuesday_end')->nullable();
            $table->time('wednesday_start')->nullable();
            $table->time('wednesday_end')->nullable();
            $table->time('thursday_start')->nullable();
            $table->time('thursday_end')->nullable();
            $table->time('friday_start')->nullable();
            $table->time('friday_end')->nullable();
            $table->time('saturday_start')->nullable();
            $table->time('saturday_end')->nullable();
            $table->time('sunday_start')->nullable();
            $table->time('sunday_end')->nullable();
            $table->json('holidays')->nullable();
            $table->boolean('is_default')->default(false);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('business_hours');
    }
};

// =============================================================================
// 02_company_configuration/009_create_sla_policies_table.php
// =============================================================================

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sla_policies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->enum('priority_level', ['low', 'normal', 'high', 'urgent', 'critical']);
            $table->integer('first_response_time'); // minutes
            $table->integer('resolution_time'); // minutes
            $table->foreignId('business_hours_id')->nullable()->constrained()->onDelete('set null');
            $table->boolean('escalation_enabled')->default(false);
            $table->integer('escalation_time')->nullable(); // minutes
            $table->unsignedBigInteger('escalation_to_user_id')->nullable();
            $table->boolean('breach_notification')->default(true);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            
            $table->foreign('escalation_to_user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sla_policies');
    }
};

// =============================================================================
// 03_customer_management/010_create_customer_types_table.php
// =============================================================================

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('customer_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('slug', 100)->unique();
            $table->text('description')->nullable();
            $table->string('color', 7)->default('#007bff');
            $table->string('icon', 50)->nullable();
            $table->integer('priority_level')->default(1);
            $table->foreignId('default_sla_policy_id')->nullable()->constrained('sla_policies')->onDelete('set null');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('customer_types');
    }
};

// =============================================================================
// 03_customer_management/011_create_customers_table.php
// =============================================================================

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_code', 50)->unique();
            $table->string('company_name');
            $table->string('contact_person')->nullable();
            $table->string('email')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('website')->nullable();
            $table->foreignId('customer_type_id')->constrained();
            $table->string('industry', 100)->nullable();
            $table->enum('company_size', ['startup', 'small', 'medium', 'large', 'enterprise'])->nullable();
            $table->decimal('annual_revenue', 15, 2)->nullable();
            $table->string('tax_id', 50)->nullable();
            $table->integer('payment_terms')->default(30);
            $table->decimal('credit_limit', 15, 2)->nullable();
            $table->string('preferred_language', 5)->default('es');
            $table->string('timezone', 50)->default('UTC');
            $table->unsignedBigInteger('assigned_agent_id')->nullable();
            $table->enum('priority', ['low', 'normal', 'high', 'vip'])->default('normal');
            $table->decimal('satisfaction_rating', 3, 2)->nullable();
            $table->date('last_contact_date')->nullable();
            $table->enum('status', ['active', 'inactive', 'suspended', 'prospect'])->default('active');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('assigned_agent_id')->references('id')->on('users')->onDelete('set null');
            $table->index(['customer_type_id', 'status']);
            $table->index('assigned_agent_id');
            $table->index('email');
        });
    }

    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
/ =============================================================================
// 03_customer_management/012_create_customer_contacts_table.php
// =============================================================================

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('customer_contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('email')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('mobile', 20)->nullable();
            $table->string('position', 100)->nullable();
            $table->string('department', 100)->nullable();
            $table->boolean('is_primary')->default(false);
            $table->boolean('can_create_tickets')->default(true);
            $table->boolean('can_view_all_tickets')->default(false);
            $table->enum('preferred_contact_method', ['email', 'phone', 'sms'])->default('email');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->index(['customer_id', 'is_primary']);
            $table->index('email');
        });
    }

    public function down()
    {
        Schema::dropIfExists('customer_contacts');
    }
};

// =============================================================================
// 03_customer_management/013_create_customer_addresses_table.php
// =============================================================================

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('customer_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['billing', 'shipping', 'office', 'other']);
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->string('city', 100);
            $table->string('state', 100)->nullable();
            $table->string('postal_code', 20)->nullable();
            $table->string('country', 100);
            $table->boolean('is_primary')->default(false);
            $table->timestamps();
            
            $table->index(['customer_id', 'type']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('customer_addresses');
    }
};

// =============================================================================
// 03_customer_management/014_create_customer_notes_table.php
// =============================================================================

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('customer_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title')->nullable();
            $table->text('content');
            $table->enum('type', ['general', 'call', 'meeting', 'email', 'issue', 'follow_up'])->default('general');
            $table->boolean('is_private')->default(false);
            $table->datetime('reminder_date')->nullable();
            $table->timestamps();
            
            $table->index(['customer_id', 'created_at']);
            $table->index('reminder_date');
        });
    }

    public function down()
    {
        Schema::dropIfExists('customer_notes');
    }
};

// =============================================================================
// 04_service_catalog/015_create_service_categories_table.php
// =============================================================================

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('service_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('slug', 100)->unique();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('icon', 50)->nullable();
            $table->string('color', 7)->default('#007bff');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->foreign('parent_id')->references('id')->on('service_categories')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('service_categories');
    }
};

// =============================================================================
// 04_service_catalog/016_create_services_table.php
// =============================================================================

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('short_description', 500)->nullable();
            $table->foreignId('service_category_id')->constrained();
            $table->enum('service_type', ['support', 'maintenance', 'consulting', 'training', 'custom']);
            $table->decimal('price', 10, 2)->nullable();
            $table->enum('billing_type', ['one_time', 'monthly', 'yearly', 'hourly'])->default('one_time');
            $table->decimal('estimated_hours', 5, 2)->nullable();
            $table->foreignId('sla_policy_id')->nullable()->constrained()->onDelete('set null');
            $table->boolean('requires_approval')->default(false);
            $table->boolean('is_public')->default(true);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('services');
    }
};

// =============================================================================
// 04_service_catalog/017_create_service_contracts_table.php
// =============================================================================

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('service_contracts', function (Blueprint $table) {
            $table->id();
            $table->string('contract_number', 50)->unique();
            $table->foreignId('customer_id')->constrained();
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('contract_type', ['support', 'maintenance', 'managed_service', 'consulting']);
            $table->date('start_date');
            $table->date('end_date');
            $table->date('renewal_date')->nullable();
            $table->boolean('auto_renewal')->default(false);
            $table->decimal('total_value', 15, 2);
            $table->string('currency', 3)->default('USD');
            $table->integer('payment_terms')->default(30);
            $table->enum('billing_frequency', ['monthly', 'quarterly', 'yearly', 'one_time'])->default('yearly');
            $table->unsignedBigInteger('contact_person_id')->nullable();
            $table->unsignedBigInteger('assigned_manager_id')->nullable();
            $table->enum('status', ['draft', 'active', 'expired', 'cancelled', 'suspended'])->default('draft');
            $table->text('terms_and_conditions')->nullable();
            $table->timestamps();
            
            $table->foreign('contact_person_id')->references('id')->on('customer_contacts')->onDelete('set null');
            $table->foreign('assigned_manager_id')->references('id')->on('users')->onDelete('set null');
            $table->index(['customer_id', 'status']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('service_contracts');
    }
};

// =============================================================================
// 04_service_catalog/018_create_contract_services_table.php
// =============================================================================

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('contract_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_contract_id')->constrained()->onDelete('cascade');
            $table->foreignId('service_id')->constrained();
            $table->integer('quantity')->default(1);
            $table->decimal('unit_price', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->decimal('included_hours', 7, 2)->nullable();
            $table->decimal('used_hours', 7, 2)->default(0);
            $table->foreignId('sla_policy_id')->nullable()->constrained()->onDelete('set null');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contract_services');
    }
};

// =============================================================================
// 05_ticket_system/019_create_ticket_priorities_table.php
// =============================================================================

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ticket_priorities', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('slug', 50)->unique();
            $table->integer('level')->unique();
            $table->string('color', 7);
            $table->string('icon', 50)->nullable();
            $table->text('description')->nullable();
            $table->boolean('auto_escalate')->default(false);
            $table->integer('escalation_time')->nullable(); // minutes
            $table->boolean('is_default')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ticket_priorities');
    }
};

// =============================================================================
// 05_ticket_system/020_create_ticket_statuses_table.php
// =============================================================================

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ticket_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('slug', 50)->unique();
            $table->string('color', 7);
            $table->string('icon', 50)->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_closed')->default(false);
            $table->boolean('is_default')->default(false);
            $table->integer('sort_order')->default(0);
            $table->boolean('auto_assign')->default(false);
            $table->boolean('send_notification')->default(true);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ticket_statuses');
    }
};