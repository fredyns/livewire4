# Laravel Boost

`laravel-boost` is an MCP server with 15 powerful tools designed specifically for this Laravel application. Use them extensively for development, debugging, and code generation.

**Version**: v1.8.10  
**Command**: `php artisan boost:mcp`

## Available MCP Tools (15 Total)

### Core Application Tools

**1. Application Info**
- Get PHP version, Laravel version, database engine
- List all installed packages with versions
- List all Eloquent models in the application
- Use this on each new chat session to understand the project context

**2. List Artisan Commands**
- Inspect all available Artisan commands with descriptions
- Useful for discovering available CLI tools and utilities

**3. List Routes**
- List all application routes with filtering options
- Filter by: HTTP method, action, route name, domain, path
- Includes Laravel Folio routes if installed
- Supports vendor package route filtering

### Database Tools

**4. Database Connections**
- List configured database connection names
- Get the default connection
- View all available database configurations

**5. Database Schema**
- Read complete database schema including:
  - Table names, columns, data types
  - Indexes, foreign keys, triggers
  - Check constraints
  - Global structures (views, stored procedures, functions, sequences)
- Supports caching for performance
- Can filter tables by name

**6. Database Query**
- Execute read-only SQL queries safely
- Allowed commands: SELECT, SHOW, EXPLAIN, DESCRIBE, DESC, WITH...SELECT, VALUES, TABLE
- Supports multiple database connections
- Query validation prevents write operations

### Configuration & Environment Tools

**7. Get Config**
- Retrieve configuration values using dot notation
- Example: `app.name`, `database.default`, `mail.driver`
- Access any Laravel config setting

**8. List Available Config Keys**
- View all available configuration keys in dot notation
- Sorted alphabetically for easy browsing
- Covers all `config/*.php` files

**9. List Available Env Vars**
- List all environment variable names from `.env` files
- Can read `.env`, `.env.example`, or other `.env.*` files
- Useful for understanding available configuration options

### URL & Routing Tools

**10. Get Absolute URL**
- Convert relative paths to absolute URLs
- Generate URLs from named routes
- Example: Convert `/dashboard` to `http://livewire4.local.host/dashboard`

### Logging & Error Tools

**11. Last Error**
- Get details of the last backend error/exception
- Reads from application logs and runtime cache
- Includes timestamp, level, and message
- Separate from browser errors (use Browser Logs for those)

**12. Read Log Entries**
- Read the last N log entries from application log
- Handles multi-line PSR-3 formatted logs correctly
- Works with file-based log drivers

**13. Browser Logs**
- Read the last N log entries from browser console
- Helpful for debugging frontend JavaScript issues
- Reads from `storage/logs/browser.log`

### Documentation & Code Execution

**14. Search Docs**
- Search Laravel-hosted documentation API
- Version-specific results based on installed packages
- Supports: Laravel, Inertia, Pest, Livewire, Filament, Nova, Tailwind, and more
- Configurable token limits (default 3,000, max 1,000,000)
- Returns results in Markdown format
- Use this before other documentation approaches

**15. Tinker**
- Execute arbitrary PHP code in Laravel context
- Like `artisan tinker` but via MCP
- Useful for debugging, testing code snippets, checking if functions exist
- Returns both output and return values
- 180-second timeout (configurable)
- Memory limit: 256MB
- Prefer unit/feature tests with factories over direct model creation

## Best Practices

- Use **Application Info** at the start of each chat to understand the project
- Use **Search Docs** for Laravel ecosystem documentation before other approaches
- Use **Database Schema** to understand table structures before writing queries
- Use **List Routes** to understand available endpoints
- Use **Tinker** for quick debugging, not for production data manipulation
- All tools are read-only except Tinker (which executes code)
- Tools provide comprehensive context for AI-assisted development
