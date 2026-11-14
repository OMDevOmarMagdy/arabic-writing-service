# Arabic Writing Services --- Project Context

> **Purpose of this document:** This is the project's source of truth
> for future development sessions. It records confirmed implementation
> state separately from proposed designs and pending work. Update it at
> the end of every development session.

## 1. Project Overview

**Project name:** Arabic Writing Services\
**Project path:** `D:\Laravel-projects\arabic-writing-services`

A web application for customers to request Arabic writing,
transcription, document conversion, and document-formatting services.

The project is also a practical Laravel learning project. The priority
is backend development, database design, business logic, security, and
maintainable Laravel practices. The frontend should remain simple and
functional.

## 2. Technology Stack

  Technology      Version / Usage
  --------------- ------------------------
  PHP             8.3.35
  Laravel         13.40.0
  Database        MySQL
  Views           Blade
  CSS framework   Bootstrap 5
  ORM             Eloquent
  UI direction    Arabic RTL, dark theme

## 3. Product Scope

### Customer features

-   Browse available services.
-   Submit a service request without creating an account.
-   Provide contact details (name, phone, optional email).
-   Describe the requested work and provide relevant quantity/details.
-   Receive an estimated price where supported, or request a quotation
    for custom work.

### Admin features --- planned

-   Admin authentication.
-   Dashboard for reviewing and managing orders.
-   Create, update, activate, and deactivate services.
-   Review quotation requests and set prices.
-   Update order statuses.
-   Send relevant customer/owner notifications.

### Initial service categories

1.  Convert images and PDF files into editable Word documents.
2.  Transcribe audio recordings into text.
3.  Write Arabic content from scratch.
4.  Format and organize Word documents.

## 4. Confirmed Application Structure

The following files/components have been reviewed in the project
conversation:

-   `routes/web.php`
    -   `GET /` routes to `HomeController@index`.
    -   Route name: `home`.
-   `app/Http/Controllers/HomeController.php`
    -   `index()` returns the `home` Blade view.
    -   An unused `Illuminate\Http\Request` import can be removed.
-   `resources/views/layouts/app.blade.php`
    -   Main Blade layout.
    -   Arabic RTL document structure, Bootstrap/Vite integration,
        navigation, content yield, and footer.
-   `resources/views/home.blade.php`
    -   Home page extends `layouts.app`.
    -   Contains a simple hero section, currently static service cards,
        and a contact section.

**Important:** The current home page service cards are static. A later
task is to load active services from the database. Do not rebuild the
existing page/layout unless inspection shows it is necessary.

## 5. Database Design

### 5.1 `services` table --- approved design, implementation not yet verified

  Column                       Type            Rules / Purpose
  ---------------------------- --------------- --------------------------------
  `id`                         Big integer     Primary key
  `name`                       String          Service name
  `slug`                       String          Unique URL-friendly identifier
  `description`                Text            Nullable
  `price`                      Decimal(10,2)   Nullable for custom pricing
  `pricing_type`               String          Default: `per_page`
  `is_active`                  Boolean         Default: `true`
  `created_at`, `updated_at`   Timestamps      Laravel timestamps

Supported pricing types: - `per_page` - `per_minute` - `per_word` -
`custom`

Use a string rather than a database ENUM to keep the design flexible.

### 5.2 `orders` table --- approved design, implementation not yet verified

  -----------------------------------------------------------------------
  Column                  Type                    Rules / Purpose
  ----------------------- ----------------------- -----------------------
  `id`                    Big integer             Primary key

  `service_id`            Foreign key             References
                                                  `services.id`;
                                                  `restrictOnDelete()`

  `customer_name`         String                  Required

  `customer_phone`        String                  Required

  `customer_email`        String                  Nullable

  `quantity`              Unsigned integer        Nullable for custom
                                                  requests

  `pricing_type`          String                  Historical
                                                  pricing-method snapshot

  `unit_price`            Decimal(10,2)           Nullable

  `total_price`           Decimal(10,2)           Nullable

  `description`           Text                    Nullable

  `status`                String                  Default: `pending`;
                                                  indexed

  `created_at`,           Timestamps              Laravel timestamps
  `updated_at`                                    
  -----------------------------------------------------------------------

### 5.3 Relationships

-   One `Service` has many `Orders`.
-   One `Order` belongs to one `Service`.
-   Deleting a service that has related orders is restricted to preserve
    order history.

### 5.4 Pricing decisions

-   `per_page`: price is calculated using the page count.
-   `per_minute`: fractional minutes are rounded up using ceiling logic
    (for example, 12.5 minutes becomes 13 billable minutes).
-   `per_word`: price is based on the agreed word count.
-   `custom`: the customer can submit a request without a final quantity
    or price; the request enters the quotation workflow.
-   Store pricing information on the order as a historical snapshot.
    Later changes to a service's price or pricing method must not
    rewrite old orders.

### 5.5 Order statuses

-   `pending`
-   `awaiting_quote`
-   `quoted`
-   `processing`
-   `completed`
-   `cancelled`

Custom-pricing requests should initially use `awaiting_quote`. Status
values are stored as strings; application-level validation/business
rules will control allowed values and transitions.

## 6. Existing Models

Both models were created already. Do not generate duplicate models.

### `app/Models/Service.php`

The reviewed model includes: - `$fillable`: `name`, `slug`,
`description`, `price`, `pricing_type`, `is_active` - casts: `price` as
`decimal:2`, `is_active` as `boolean` - `orders(): HasMany` relationship
using `hasMany(Order::class)`

This model matches the approved design.

### `app/Models/Order.php`

The reviewed model includes: - `$fillable` for service/customer/order
fields and status - casts for `unit_price` and `total_price` as
`decimal:2` - `service(): BelongsTo` relationship using
`belongsTo(Service::class)`

**Pending model adjustment:** Add `pricing_type` to the `Order` model's
`$fillable` array, because the approved `orders` table stores this
historical snapshot. The current reviewed version did not include it.

## 7. Confirmed Progress

-   Laravel project created and runs.
-   MySQL connection issue was resolved; a later
    `php artisan migrate:status` command succeeded.
-   Simple home page created.
-   Bootstrap integrated.
-   Main layout and home view created.
-   Basic Routes → Controller → View flow reviewed.
-   `Service` and `Order` migrations created.
-   `Service` and `Order` models created.
-   Initial database design reviewed and revised.
-   Final proposed Services/Orders migration design was approved in the
    conversation.

## 8. Current Database Migration Status

Last confirmed command:

``` bash
php artisan migrate:status
```

Last confirmed output:

  Migration                                   Status
  ------------------------------------------- ---------
  `0001_01_01_000000_create_users_table`      Ran
  `0001_01_01_000001_create_cache_table`      Ran
  `0001_01_01_000002_create_jobs_table`       Ran
  `2026_11_05_024017_create_services_table`   Pending
  `2026_11_05_024054_create_orders_table`     Pending

This confirms that MySQL was reachable when the command ran and that the
two business-table migrations had not yet been executed at that time.

**Critical current-state note:** The revised migration code was approved
in the discussion, but there is no confirmation that it has been copied
into and saved in the actual migration files. Do not run
`php artisan migrate` until the current contents of both files have been
inspected and verified.

## 9. Next Development Plan

### Phase 1 --- Finish database setup

1.  Inspect the actual current contents of:
    -   `database/migrations/2026_11_05_024017_create_services_table.php`
    -   `database/migrations/2026_11_05_024054_create_orders_table.php`
2.  Compare them with the approved schema in Section 5.
3.  Correct and save the files if needed.
4.  Run migrations only after verification.
5.  Verify the resulting database tables and columns.

### Phase 2 --- Eloquent models

1.  Add `pricing_type` to `Order::$fillable`.
2.  Review mass assignment and casts.
3.  Test `Service` ↔ `Order` relationships with Tinker.
4.  Understand lazy loading and eager loading before using them in
    queries.

### Phase 3 --- Service management

-   Implement service CRUD.
-   Add validation/Form Requests.
-   Implement pricing rules.
-   Support service activation/deactivation without deleting historical
    services.

### Phase 4 --- Customer order flow

-   Build order submission.
-   Validate customer information and order details.
-   Calculate prices according to `pricing_type`.
-   Handle custom quotation requests.
-   Save historical pricing snapshots.
-   Implement order status management.

### Phase 5 --- Admin dashboard

-   Implement admin authentication.
-   Protect admin routes.
-   Build order and service management.
-   Add authorization.

### Phase 6 --- Advanced backend features

-   Email/WhatsApp notifications where appropriate.
-   File uploads and storage.
-   Queues and background jobs.
-   Logging and error handling.
-   Security, rate limiting, testing, and optimization.

## 10. Development and Learning Guidelines

For every feature, explain:

1.  **What** are we building?
2.  **Why** do we need it?
3.  **How** does Laravel implement it?
4.  **Behind the scenes:** what happens internally?
5.  **Testing:** how can we verify it?

Additional rules: - Explain in simple Egyptian Arabic while keeping
technical terminology in English. - Do not skip important concepts. - Do
not provide code without explaining its purpose. - Work step by step; do
not rush to the next phase before the current one is understood and
tested. - Backend first; keep the UI simple and functional. - Follow
Laravel best practices without unnecessary complexity. - Inspect
existing files before creating or replacing anything. - Do not claim a
task is complete until its result has been confirmed.

## 11. Session Tracking

At the end of each development session, update this section with: - Work
completed. - Files created or modified. - Technical decisions made. -
Problems encountered and their solutions. - Confirmed project status. -
Exact next task.

### Latest session snapshot --- 2026-11-12

**Completed/reviewed in the conversation** - Reviewed the existing route
and home-page flow. - Reviewed the main Blade layout and home view
structure. - Reviewed the `Service` and `Order` model implementations. -
Reviewed the database schema and approved a revised design for
`services` and `orders`. - Confirmed from the last reported
`migrate:status` output that the three default migrations had run and
the two business migrations were pending.

**Files known to exist** - `routes/web.php` -
`app/Http/Controllers/HomeController.php` - `app/Models/Service.php` -
`app/Models/Order.php` - `resources/views/layouts/app.blade.php` -
`resources/views/home.blade.php` - Two migration files for `services`
and `orders`

**Not yet confirmed** - Whether the final migration changes have been
saved in the actual files. - Whether the `services` and `orders`
migrations have been executed. - Whether the database tables match the
approved design. - Whether the model relationships have been tested
successfully in Tinker. - Whether `pricing_type` has been added to
`Order::$fillable`.

**Last known development stage:** Database migration review, before
executing the Services and Orders migrations.

**Exact next task:** Inspect the actual current contents of both
migration files, verify them against Section 5, and only then proceed to
migration execution.
