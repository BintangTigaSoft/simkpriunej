# CodeIgniter 4 AI Development Guidelines

This document outlines the strict guidelines for AI assistants working on this CodeIgniter 4 project.

## 1. General Language

- **English Only**: All code, comments, functions, and documentation must be written in **English**.

## 2. Database & Migrations

- **Table Naming**:
  - Follow the `parent_children` pattern (e.g., `logbooks`, `logbook_categories`, `logbook_categories_children`).
  - **Purpose**: Groups related tables in DBMS.
- **Foreign Keys**: Always define constraints. Default to `CASCADE` on delete unless logic requires otherwise.

## 3. Controllers & Validation

- **Validation**:
  - **NEVER** bloat controllers with verbose validation arrays.
  - **Preferred**: Define validation rules in the **Model** (`$validationRules` property) or use a Config file.
  - Use `$model->validate($data)` or `$this->validate('ruleGroup')`.

## 4. Models

- **Mass Assignment**:
  - CI4 uses strict whitelisting. Always define `protected $allowedFields = [...];`.
  - **Do NOT** leave `$allowedFields` empty if using `save()`, `insert()`, or `update()`.
- **Return Types**:
  - Prefer working with **Entities** (`returnType = 'App\Entities\User'`) for cleaner object-oriented data handling, rather than raw arrays.

## 5. Database Seeding

- **Modular**:
  - Create separate seeders for each module (e.g., `LogbookSeeder`).
  - Call them in `DatabaseSeeder::run()`.

## 6. Performance

- **Queries**:
  - CI4 Models default to Query Builder.
  - Avoid N+1 issues by manually joining tables or using efficient queries.
  - Use `debugbar` to monitor query performance.

## 7. Views (No Blade)

- **Structure**:
  - Use **View Layouts** (`$this->extend('layout')` and `$this->section('content')`).
- **Components**:
  - Use **View Cells** for reusable logic/UI components (e.g., specific widgets).
  - Use **Partials** (`<?= $this->include('partials/header') ?>`) for simple reusable HTML.

- **Form Components (Partials)**:
  - **Standard Behavior**:
    - Manage form inputs as reusable partials (e.g., `components/form/input.php`).
    - **Parameters**: `name` (required), `label`, `value` (default `null`), `extraattribute` (optional, for custom attributes).
    - **Value Binding**: Use `old($name, $value)` to handle sticky logic for validation errors and "Edit" values.
    - **Error Display**: Validation errors must appear immediately below the input.
    - **Custom Attributes**: Use `extraattribute` to pass raw HTML attributes (e.g., `readonly`, `autofocus`, `data-id="123"`).
    - **Requirement**: **MUST** load the `form` helper (e.g., in `BaseController`) to use `validation_show_error()`.
  - **Unified Form**:
    - Use a single `{module}/form.php` for both Create and Edit pages.
  - **Usage Example**:

    ```php
    <!-- _components/form/input.php -->
    <?php $value = $value ?? null; ?>
    <?php $extraattribute = $extraattribute ?? ''; ?>
    <div class="form-group">
        <label for="<?= $name ?>"><?= $label ?></label>
        <input
            type="text"
            name="<?= $name ?>"
            id="<?= $name ?>"
            class="form-control <?= validation_show_error($name) ? 'is-invalid' : '' ?>"
            value="<?= old($name, $value) ?>"
            <?= $extraattribute ?>
        >
        <div class="invalid-feedback">
            <?= validation_show_error($name) ?>
        </div>
    </div>

    <!-- Usage in _partials/form.php -->
    <?= $this->include('_components/form/input', [
        'name'  => 'title',
        'label' => 'Post Title',
        'value' => $post->title ?? null
    ]) ?>
    ```

## 8. DataTables (Client-Side HTML)

- **Structure**:
  - Since CI4 lacks Blade `x-component`, standardise a View Partial (e.g., `_partials/datatable.php`) that accepts generic variables.
  - **Variables**: `$id`, `$url`, `$headers`, `$columns` (json encoded).

## 9. API Development

- **Response Standardization**:
  - Although CI4 has `API\ResponseTrait`, we prefer a strict structure.
  - **Helper/Library**: `App\Helpers\ResponseFormatter`.
  - **Methods**:

    ```php
    class ResponseFormatter {
        public static function success($data, $message = "Success", $code = 200) {
            $response = [
                'meta' => ['code' => $code, 'status' => 'success', 'message' => $message],
                'data' => $data
            ];
            return response()->setJSON($response)->setStatusCode($code);
        }

        public static function error($message = "Error", $code = 400) {
            $response = [
                'meta' => ['code' => $code, 'status' => 'error', 'message' => $message],
                'data' => null
            ];
            return response()->setJSON($response)->setStatusCode($code);
        }
    }
    ```

## 10. Content Security Policy (CSP)

- **Configuration**:
  - If `CSPEnabled` is true in `.env` or `App.php`, ensure `Config/ContentSecurityPolicy.php` is properly configured.
  - **Third-Party Resources**: Add domains for external fonts, scripts, and styles (e.g., `fonts.googleapis.com`, `cdnjs.cloudflare.com`) to `scriptSrc`, `styleSrc`, `fontSrc`.
  - **Inline Styles/Scripts**: Avoid inline styles/scripts. If necessary, enable `unsafe-inline` or use Nonces.
  - **Troubleshooting**: If you see "Content Security Policy directive" errors in the console, add the blocked domain/source to the respective directive in `ContentSecurityPolicy.php`.

## 11. Alerts & Notifications

- **Library**: Use **SweetAlert2** (already included in assets) for all user notifications.
- **Behavior**:
  - Listen for session Flashdata keys: `success`, `error`, `warning`, `info`.
  - Automatically verify if these keys exist in the View Layout or Page and trigger `Swal.fire()`.
