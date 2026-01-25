# Windsurf Guidelines for Livewire 4

This document contains comprehensive guidelines for developing with Windsurf in the Livewire 4 project.

## Project Overview

**Tech Stack:**
- PHP 8.3.10
- Laravel 12
- Livewire 4
- Flux UI Pro (v2)
- Tailwind CSS 4
- PostgreSQL

**Key Packages:**
- laravel/fortify (v1) - Authentication
- laravel/sanctum (v4) - API authentication
- livewire/flux (v2) - Free UI components
- livewire/flux-pro (v2) - Pro UI components
- phpunit/phpunit (v11) - Testing
- laravel/pint (v1) - Code formatting

## MCP Servers & Tools

### Laravel Boost (15 Tools)
**Command:** `php artisan boost:mcp`

**Core Application Tools:**
1. **Application Info** - Get PHP/Laravel versions, database engine, packages, Eloquent models
2. **List Artisan Commands** - Inspect available Artisan commands
3. **List Routes** - List application routes with filtering options

**Database Tools:**
4. **Database Connections** - List configured database connections
5. **Database Schema** - Read complete database schema with tables, columns, indexes, foreign keys
6. **Database Query** - Execute read-only SQL queries (SELECT, SHOW, EXPLAIN, DESCRIBE, etc.)

**Configuration & Environment Tools:**
7. **Get Config** - Retrieve configuration values using dot notation
8. **List Available Config Keys** - View all configuration keys
9. **List Available Env Vars** - List environment variable names from .env files

**URL & Routing Tools:**
10. **Get Absolute URL** - Convert relative paths to absolute URLs or generate from named routes

**Logging & Error Tools:**
11. **Last Error** - Get details of the last backend error/exception
12. **Read Log Entries** - Read the last N log entries from application log
13. **Browser Logs** - Read the last N log entries from browser console

**Documentation & Code Execution:**
14. **Search Docs** - Search Laravel-hosted documentation API (version-specific)
15. **Tinker** - Execute arbitrary PHP code in Laravel context

### Chrome DevTools
**Command:** `npx chrome-devtools-mcp@latest`

**Input Automation:** click, drag, fill, fill_form, handle_dialog, hover, press_key, upload_file
**Navigation:** close_page, list_pages, navigate_page, new_page, select_page, wait_for
**Emulation:** emulate, resize_page
**Performance:** performance_analyze_insight, performance_start_trace, performance_stop_trace
**Network:** get_network_request, list_network_requests
**Debugging:** evaluate_script, get_console_message, list_console_messages, take_screenshot, take_snapshot

**Testing Credentials (Local):**
- Admin: admin@admin.com / admin
- Test User: test@example.com / password

## Code Style & Conventions

### PHP

**General:**
- Always use curly braces for control structures, even for single lines
- Write PHPDoc blocks for each object, function, and control structure
- Use explicit return type declarations for all methods and functions
- Use appropriate PHP type hints for method parameters

**Constructor Property Promotion:**
```php
public function __construct(public GitHub $github) { }
```
- Do not allow empty constructors with zero parameters unless private

**Comments:**
- Prefer PHPDoc blocks over inline comments
- Never use comments within code unless something is very complex

**Enums:**
- Use TitleCase for enum keys (e.g., `FavoritePerson`, `BestLake`, `Monthly`)

### Laravel Best Practices

**Database:**
- Always use proper Eloquent relationship methods with return type hints
- Prefer relationship methods over raw queries or manual joins
- Use Eloquent models and relationships before suggesting raw database queries
- Avoid `DB::`; prefer `Model::query()`
- Prevent N+1 query problems by using eager loading
- Use Laravel's query builder for very complex database operations

**Model Creation:**
- When creating new models, create useful factories and seeders
- Use `php artisan make:model` with appropriate options

**APIs & Eloquent Resources:**
- Default to using Eloquent API Resources and API versioning
- Follow existing application conventions

**Controllers & Validation:**
- Always create Form Request classes for validation
- Include both validation rules and custom error messages
- Check sibling Form Requests for array vs string-based validation rules

**Queues:**
- Use queued jobs for time-consuming operations with `ShouldQueue` interface

**Authentication & Authorization:**
- Use Laravel's built-in authentication and authorization features (gates, policies, Sanctum)

**URL Generation:**
- Prefer named routes and the `route()` function when generating links

**Configuration:**
- Use environment variables only in configuration files
- Never use `env()` directly outside of config files
- Always use `config('app.name')`, not `env('APP_NAME')`

**Artisan Commands:**
- Use `php artisan make:` commands to create new files (migrations, controllers, models, etc.)
- Pass `--no-interaction` to all Artisan commands
- Use the `list-artisan-commands` tool to check available options

### Laravel 12 Specific

**Structure:**
- Middleware are configured in `bootstrap/app.php` using `Application::configure()->withMiddleware()`
- `bootstrap/providers.php` contains application-specific service providers
- Console commands in `app/Console/Commands/` are automatically available
- No `app/Console/Kernel.php` file exists

**Database:**
- When modifying a column, include all previously defined attributes
- Use native eager loading limits: `$query->latest()->limit(10);`

**Models:**
- Use `casts()` method on models rather than `$casts` property
- Follow existing conventions from other models

### Livewire 4

**General:**
- Use `php artisan make:livewire [Posts\CreatePost]` to create components
- State lives on the server; UI reflects it
- All Livewire requests hit the Laravel backend; validate and authorize in actions

**Best Practices:**
- Livewire components require a single root element
- Use `wire:loading` and `wire:dirty` for loading states
- Add `wire:key` in loops for proper tracking
- Use lifecycle hooks: `mount()`, `updatedFoo()` for initialization and reactive side effects

**Testing:**
```php
Livewire::test(Counter::class)
    ->assertSet('count', 0)
    ->call('increment')
    ->assertSet('count', 1)
    ->assertSee(1)
    ->assertStatus(200);
```

### Flux UI Pro

**Usage:**
- Use Flux UI components when available
- Fallback to standard Blade components if Flux is unavailable
- Use `search-docs` tool for exact documentation and code snippets

**Available Components:**
accordion, autocomplete, avatar, badge, brand, breadcrumbs, button, calendar, callout, card, chart, checkbox, command, composer, context, date-picker, dropdown, editor, field, file-upload, heading, icon, input, kanban, modal, navbar, otp-input, pagination, pillbox, popover, profile, radio, select, separator, skeleton, slider, switch, table, tabs, text, textarea, time-picker, toast, tooltip

**Example:**
```blade
<flux:button variant="primary"/>
```

### Tailwind CSS 4

**General:**
- Use Tailwind CSS classes to style HTML
- Check and use existing Tailwind conventions before writing your own
- Extract repeated patterns into components matching project conventions
- Think through class placement, order, priority, and defaults

**Spacing:**
- Use gap utilities for spacing when listing items; don't use margins
```html
<div class="flex gap-8">
    <div>Item 1</div>
    <div>Item 2</div>
</div>
```

**Dark Mode:**
- If existing pages support dark mode, new pages must support it similarly using `dark:`

**Configuration:**
- Configuration is CSS-first using `@theme` directive in CSS
- No separate `tailwind.config.js` file needed
- Import Tailwind using `@import "tailwindcss";` (not `@tailwind` directives)

**Replaced Utilities (v4):**
- bg-opacity-* → bg-black/*
- text-opacity-* → text-black/*
- border-opacity-* → border-black/*
- flex-shrink-* → shrink-*
- flex-grow-* → grow-*
- overflow-ellipsis → text-ellipsis

## Testing

**PHPUnit:**
- All tests must be written as PHPUnit classes
- Use `php artisan make:test --phpunit {name}` for feature tests
- Use `--unit` flag for unit tests
- Every change must be programmatically tested
- Run minimum number of tests needed: `php artisan test --compact`
- Run specific file: `php artisan test --compact tests/Feature/ExampleTest.php`
- Filter by test name: `php artisan test --compact --filter=testName`

**Test Coverage:**
- Test all happy paths, failure paths, and weird paths
- Use factories for creating test models
- Check factory custom states before manually setting up models
- Use `$this->faker->word()` or `fake()->randomDigit()` for Faker

**Important:**
- Do not remove any tests or test files without approval
- Tests are core to the application, not temporary files

## Code Formatting

**Laravel Pint:**
- Run `vendor/bin/pint --dirty` before finalizing changes
- Do not run `vendor/bin/pint --test`; simply run `vendor/bin/pint` to fix issues

## Z-Index Guidelines

- **<=500**: Base page content
- **<=1000**: Floating widgets on page
- **<=5000**: Modal dialogs
- **<=6000**: Preview windows
- **<=8000**: Interactive Input widgets, Map Selector, Dropdown inputs
- **<=9000**: Animation
- **<=10000**: Main Menu and navigation
- **>10000**: Top-level modals and overlays (highest priority, critical, danger)

## Additional Rules

**Frontend Bundling:**
- If frontend changes aren't reflected in the UI, user may need to run `npm run build`, `npm run dev`, or `composer run dev`

**Documentation Files:**
- Only create documentation files if explicitly requested by the user

**Conventions:**
- Follow all existing code conventions in the application
- Check sibling files for correct structure, approach, and naming
- Use descriptive names for variables and methods (e.g., `isRegisteredForDiscounts`, not `discount()`)
- Check for existing components to reuse before writing new ones

**Verification:**
- Do not create verification scripts or tinker when tests cover that functionality
- Unit and feature tests are more important

**Application Structure:**
- Stick to existing directory structure; don't create new base folders without approval
- Do not change application dependencies without approval

**Replies:**
- Be concise in explanations; focus on what's important rather than obvious details

## Laravel Fortify

Fortify is a headless authentication backend providing authentication routes and controllers.

**Before implementing authentication features, use the `search-docs` tool for latest docs.**

**Configuration:**
- Check `config/fortify.php` to see what's enabled
- Enable features by adding to `'features' => []` array
- Use `list-routes` tool with `only_vendor: true` and `action: "Fortify"` to see registered routes
- Set `'views' => false` if handling views yourself

**Customization:**
- Customize views in `FortifyServiceProvider`'s `boot()` method
- Use `Fortify::authenticateUsing()` for custom authentication logic
- Modify actions in `app/Actions/Fortify/` to change feature behavior

**Available Features:**
- `Features::registration()` - User registration
- `Features::emailVerification()` - Email verification
- `Features::twoFactorAuthentication()` - 2FA with QR codes and recovery codes
- `Features::updateProfileInformation()` - Profile updates
- `Features::updatePasswords()` - Password changes
- `Features::resetPasswords()` - Password reset via email

## Documentation Search

**Search Docs Tool (Critically Important):**
- Use `search-docs` before any other approaches when dealing with Laravel or Laravel ecosystem packages
- Tool automatically passes installed packages and versions to Boost API
- Returns only version-specific documentation for your circumstance
- Perfect for: Laravel, Inertia, Livewire, Filament, Tailwind, Pest, Nova, etc.

**Search Syntax:**
1. Simple Word Searches with auto-stemming: `authentication` finds 'authenticate' and 'auth'
2. Multiple Words (AND Logic): `rate limit` finds both "rate" AND "limit"
3. Quoted Phrases (Exact Position): `"infinite scroll"` - words must be adjacent
4. Mixed Queries: `middleware "rate limit"` - "middleware" AND exact phrase "rate limit"
5. Multiple Queries: `["authentication", "middleware"]` - ANY of these terms

**Best Practices:**
- Pass multiple queries at once; most relevant results returned first
- Use multiple, broad, simple, topic-based queries to start
- Do not add package names to queries; package info is already shared
- Example: use `test resource table`, not `filament 4 test resource table`
- Search documentation before making code changes to ensure correct approach
