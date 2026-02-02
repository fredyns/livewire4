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
- laravel/prompts (v0)
- livewire/flux (v2) - Free UI components
- livewire/flux-pro (v2) - Pro UI components
- laravel/mcp (v0)
- laravel/pint (v1) - Code formatting
- laravel/sail (v1)
- phpunit/phpunit (v11) - Testing

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
- Follow PSR-1, PSR-2, and PSR-12 standards
- Use camelCase for non-public-facing strings
- Use short nullable notation: `?string` not `string|null`
- Always specify `void` return types when methods return nothing

**Constructor Property Promotion:**
```php
public function __construct(public GitHub $github) { }
```
- Do not allow empty constructors with zero parameters unless private
- Use constructor property promotion when all properties can be promoted

**Type Declarations & Docblocks:**
- Use typed properties over docblocks
- Specify return types including `void`
- Use short nullable syntax: `?Type` not `Type|null`
- Document iterables with generics:
```php
/** @return Collection<int, User> */
public function getUsers(): Collection
```
- Don't use docblocks for fully type-hinted methods (unless description needed)
- Always import classnames in docblocks - never use fully qualified names
- Use one-line docblocks when possible: `/** @var string */`
- For iterables, always specify key and value types:
```php
/**
 * @param array<int, MyObject> $myArray
 * @param int $typedArgument
 */
function someFunction(array $myArray, int $typedArgument) {}
```
- Use array shape notation for fixed keys:
```php
/** @return array{
   first: SomeClass,
   second: SomeClass
} */
```

**Comments:**
- Prefer PHPDoc blocks over inline comments
- Never use comments within code unless something is very complex
- Avoid comments - write expressive code instead
- Refactor comments into descriptive function names

**Enums:**
- Use PascalCase for enum values (e.g., `FavoritePerson`, `BestLake`, `Monthly`)

**Control Flow:**
- **Happy path last**: Handle error conditions first, success case last
- **Avoid else**: Use early returns instead of nested conditions
- **Separate conditions**: Prefer multiple if statements over compound conditions
- **Ternary operators**: Each part on own line unless very short
```php
// Happy path last
if (! $user) {
    return null;
}

// Short ternary
$name = $isFoo ? 'foo' : 'bar';

// Multi-line ternary
$result = $object instanceof Model ?
    $object->name :
    'A default value';
```

**Strings & Formatting:**
- Use string interpolation over concatenation

**Whitespace:**
- Add blank lines between statements for readability
- Exception: sequences of equivalent single-line operations
- No extra empty lines between `{}` brackets
- Let code "breathe" - avoid cramped formatting

### Laravel Best Practices

**Core Principle:**
- Follow Laravel conventions first. If Laravel has a documented way to do something, use it. Only deviate when you have a clear justification.

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
- Use `casts()` method on models rather than `$casts` property
- Follow existing conventions from other models

**APIs & Eloquent Resources:**
- Default to using Eloquent API Resources and API versioning
- Follow existing application conventions

**Controllers & Validation:**
- Always create Form Request classes for validation
- Include both validation rules and custom error messages
- Check sibling Form Requests for array vs string-based validation rules
- Use array notation for multiple rules (easier for custom rule classes):
```php
public function rules() {
    return [
        'email' => ['required', 'email'],
    ];
}
```

**Queues:**
- Use queued jobs for time-consuming operations with `ShouldQueue` interface

**Authentication & Authorization:**
- Use Laravel's built-in authentication and authorization features (gates, policies, Sanctum)
- Policies use camelCase: `Gate::define('editPost', ...)`
- Use CRUD words, but `view` instead of `show`

**URL Generation:**
- Prefer named routes and the `route()` function when generating links
- Use the `get-absolute-url` tool to ensure correct scheme, domain/IP, and port

**Configuration:**
- Use environment variables only in configuration files
- Never use `env()` directly outside of config files
- Always use `config('app.name')`, not `env('APP_NAME')`
- Configuration files: kebab-case (`pdf-generator.php`)
- Configuration keys: snake_case (`chrome_path`)
- Add service configs to `config/services.php`, don't create new files

**Artisan Commands:**
- Use `php artisan make:` commands to create new files (migrations, controllers, models, etc.)
- Pass `--no-interaction` to all Artisan commands
- Use the `list-artisan-commands` tool to check available options
- Names: kebab-case (`delete-old-records`)
- Always provide feedback (`$this->comment('All ok!')`)
- Show progress for loops, summary at end
- Put output BEFORE processing item (easier debugging)

**Routes & Controllers:**
- URLs: kebab-case (`/open-source`)
- Route names: camelCase (`->name('openSource')`)
- Parameters: camelCase (`{userId}`)
- Use tuple notation: `[Controller::class, 'method']`
- Plural resource names (`PostsController`)
- Stick to CRUD methods (`index`, `create`, `store`, `show`, `edit`, `update`, `destroy`)
- Extract new controllers for non-CRUD actions

**API Routing:**
- Use plural resource names: `/errors`
- Use kebab-case: `/error-occurrences`
- Limit deep nesting for simplicity:
  ```
  /error-occurrences/1
  /errors/1/occurrences
  ```

**Blade Templates:**
- Indent with 4 spaces
- No spaces after control structures:
```blade
@if($condition)
    Something
@endif
```

**Translations:**
- Use `__()` function over `@lang`

**File Structure:**
- Controllers: plural resource name + `Controller` (`PostsController`)
- Views: camelCase (`openSource.blade.php`)
- Jobs: action-based (`CreateUser`, `SendEmailNotification`)
- Events: tense-based (`UserRegistering`, `UserRegistered`)
- Listeners: action + `Listener` suffix (`SendInvitationMailListener`)
- Commands: action + `Command` suffix (`PublishScheduledPostsCommand`)
- Mailables: purpose + `Mail` suffix (`AccountActivatedMail`)
- Resources/Transformers: plural + `Resource`/`Transformer` (`UsersResource`)
- Enums: descriptive name, no prefix (`OrderStatus`, `BookingType`)

**Migrations:**
- Do not write down methods in migrations, only up methods
- When modifying a column, include all previously defined attributes

### Laravel 12 Specific

**Structure:**
- Middleware are configured in `bootstrap/app.php` using `Application::configure()->withMiddleware()`
- `bootstrap/providers.php` contains application-specific service providers
- Console commands in `app/Console/Commands/` are automatically available
- No `app/Console/Kernel.php` file exists
- CRITICAL: ALWAYS use `search-docs` tool for version-specific Laravel documentation and updated code examples

**Database:**
- When modifying a column, include all previously defined attributes
- Use native eager loading limits: `$query->latest()->limit(10);`
- Laravel 12 allows limiting eagerly loaded records natively, without external packages

**Models:**
- Use `casts()` method on models rather than `$casts` property
- Follow existing conventions from other models

### Livewire 4

**General:**
- Livewire allows you to build dynamic, reactive interfaces using only PHP — no JavaScript required
- Instead of writing frontend code in JavaScript frameworks, you use Alpine.js to build the UI when client-side interactions are required
- State lives on the server; the UI reflects it
- Validate and authorize in actions (they're like HTTP requests)
- Use `php artisan make:livewire [Posts\CreatePost]` to create components
- IMPORTANT: Activate `livewire-development` every time you're working with Livewire-related tasks

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

**General:**
- Flux UI is the official Livewire component library
- This project uses the Pro edition, which includes all free and Pro components and variants
- Use `<flux:*>` components when available; they are the recommended way to build Livewire interfaces
- IMPORTANT: Activate `fluxui-development` when working with Flux UI components

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
- Always use existing Tailwind conventions; check project patterns before adding new ones
- IMPORTANT: Always use `search-docs` tool for version-specific Tailwind CSS documentation and updated code examples
- IMPORTANT: Activate `tailwindcss-development` every time you're working with a Tailwind CSS or styling-related task
- Use Tailwind CSS classes to style HTML
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
- This application uses PHPUnit for testing. All tests must be written as PHPUnit classes
- Use `php artisan make:test --phpunit {name}` to create a new feature test
- Use `--unit` flag for unit tests
- If you see a test using "Pest", convert it to PHPUnit
- Every change must be programmatically tested
- Run the minimum number of tests needed to ensure code quality and speed
- Use `php artisan test --compact` with a specific filename or filter
- Run all tests: `php artisan test --compact`
- Run all tests in a file: `php artisan test --compact tests/Feature/ExampleTest.php`
- Filter by test name: `php artisan test --compact --filter=testName`
- Every time a test has been updated, run that singular test
- When the tests relating to your feature are passing, ask the user if they would like to also run the entire test suite to make sure everything is still passing

**Test Coverage:**
- Tests should cover all happy paths, failure paths, and edge cases
- Use factories for creating test models
- Check if the factory has custom states that can be used before manually setting up the model
- Faker: Use methods such as `$this->faker->word()` or `fake()->randomDigit()`
- Follow existing conventions whether to use `$this->faker` or `fake()`

**Important:**
- You must not remove any tests or test files from the tests directory without approval
- These are not temporary or helper files; these are core to the application

## Code Formatting

**Laravel Pint:**
- You must run `vendor/bin/pint --dirty` before finalizing changes to ensure your code matches the project's expected style
- Do not run `vendor/bin/pint --test`, simply run `vendor/bin/pint` to fix any formatting issues

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
- If the user doesn't see a frontend change reflected in the UI, it could mean they need to run `npm run build`, `npm run dev`, or `composer run dev`. Ask them.

**Documentation Files:**
- You must only create documentation files if explicitly requested by the user.

**Conventions:**
- You must follow all existing code conventions used in this application
- When creating or editing a file, check sibling files for the correct structure, approach, and naming
- Use descriptive names for variables and methods (e.g., `isRegisteredForDiscounts`, not `discount()`)
- Check for existing components to reuse before writing a new one

**Verification Scripts:**
- Do not create verification scripts or tinker when tests cover that functionality and prove they work
- Unit and feature tests are more important

**Application Structure & Architecture:**
- Stick to existing directory structure; don't create new base folders without approval
- Do not change the application's dependencies without approval

**Replies:**
- Be concise in your explanations - focus on what's important rather than explaining obvious details

**Skills Activation:**
This project has domain-specific skills available. You MUST activate the relevant skill whenever you work in that domain—don't wait until you're stuck.
- `fluxui-development` — Develops UIs with Flux UI Pro components. Activates when creating buttons, forms, modals, inputs, tables, charts, date pickers, or UI components; replacing HTML elements with Flux; working with flux: components; or when the user mentions Flux, component library, UI components, form fields, or asks about available Flux components.
- `livewire-development` — Develops reactive Livewire 4 components. Activates when creating, updating, or modifying Livewire components; working with wire:model, wire:click, wire:loading, or any wire: directives; adding real-time updates, loading states, or reactivity; debugging component behavior; writing Livewire tests; or when the user mentions Livewire, component, counter, or reactive UI.
- `tailwindcss-development` — Styles applications using Tailwind CSS v4 utilities. Activates when adding styles, restyling components, working with gradients, spacing, layout, flex, grid, responsive design, dark mode, colors, typography, or borders; or when the user mentions CSS, styling, classes, Tailwind, restyle, hero section, cards, buttons, or any visual/UI changes.

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
- Boost comes with a powerful `search-docs` tool you should use before trying other approaches when working with Laravel or Laravel ecosystem packages
- Tool automatically passes a list of installed packages and their versions to the remote Boost API
- Returns only version-specific documentation for your circumstance
- Perfect for: Laravel, Inertia, Livewire, Filament, Tailwind, Pest, Nova, etc.
- Search the documentation before making code changes to ensure we are taking the correct approach

**Search Syntax:**
1. Simple Word Searches with auto-stemming: `authentication` finds 'authenticate' and 'auth'
2. Multiple Words (AND Logic): `rate limit` finds both "rate" AND "limit"
3. Quoted Phrases (Exact Position): `"infinite scroll"` - words must be adjacent
4. Mixed Queries: `middleware "rate limit"` - "middleware" AND exact phrase "rate limit"
5. Multiple Queries: `["authentication", "middleware"]` - ANY of these terms

**Best Practices:**
- Use multiple, broad, simple, topic-based queries at once. For example: `['rate limiting', 'routing rate limiting', 'routing']`. The most relevant results will be returned first.
- Do not add package names to queries; package information is already shared. For example, use `test resource table`, not `filament 4 test resource table`.
- Pass multiple queries at once; most relevant results returned first
- You should pass an array of packages to filter on if you know you need docs for particular packages

## Boost Tools Usage

**Application Info:**
- Use at the start of each chat to understand the project
- Get PHP/Laravel versions, database engine, packages, Eloquent models

**Database Tools:**
- Use **Database Schema** to understand table structures before writing queries
- Use **Database Query** tool when you only need to read from the database
- Use **Tinker** when you need to execute PHP to debug code or query Eloquent models directly

**Logging & Error Tools:**
- You can read browser logs, errors, and exceptions using the `browser-logs` tool from Boost
- Only recent browser logs will be useful - ignore old logs
- Use **Last Error** to get details of the last backend error/exception
- Use **Read Log Entries** to read the last N log entries from application log

**URL & Routing:**
- Whenever you share a project URL with the user, you should use the `get-absolute-url` tool to ensure you're using the correct scheme, domain/IP, and port
- Use **List Routes** to understand available endpoints

**Artisan Commands:**
- Use the `list-artisan-commands` tool when you need to call an Artisan command to double-check the available parameters

**Tinker / Debugging:**
- Use the `tinker` tool when you need to execute PHP to debug code or query Eloquent models directly
- Prefer unit/feature tests with factories over direct model creation
- 180-second timeout (configurable)
- Memory limit: 256MB

**Best Practices:**
- All tools are read-only except Tinker (which executes code)
- Tools provide comprehensive context for AI-assisted development
