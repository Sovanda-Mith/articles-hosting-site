## How to start up the project

1. Clone the repository
2. Open terminal and run

```
    sudo docker compose up --build -d
```

3. Give permission to the application

```
    sudo docker compose exec -it app chmod -R 777 storage/ bootstrap/cache/
```

4. Migrate the tables just in case

```
    sudo docker compose exec -it app php artisan migrate
```

4. Open browser and go to [localhost:8000](http://localhost:8000)

## How to interact with the container if you want to run commands such as `php artisan migrate`

- Open terminal and run

```
    sudo docker compose exec -it app bash
```

You are now inside the container and you can now run commands in it

## Code Standards

This project uses ESLint and Prettier to ensure consistent code formatting and style across the team.

### Setup

1. Install the recommended VS Code extensions:

   - ESLint
   - Prettier - Code formatter

2. The project is already configured with:
   - `.eslintrc.cjs` - ESLint configuration
   - `.prettierrc` - Prettier configuration
   - `.eslintignore` and `.prettierignore` - Files to exclude from linting/formatting

### Line Break Rules

To maintain code consistency, we enforce the following rules for line breaks:

- Maximum 1 consecutive empty line allowed in code
- No trailing whitespace
- Always have a newline at the end of files
- No padding within blocks
- Required line breaks:
  - Before return statements
  - After variable declarations
  - After directives
  - After case/default statements in switch blocks

### Commands

- `npm run lint` - Run ESLint to check for code quality issues (with automatic fixing when possible)
- `npm run format` - Format all files with Prettier

### VS Code Integration

The project includes VS Code settings (`/.vscode/settings.json`) that enable:

- Format on save
- ESLint auto-fix on save
- Proper formatter configurations for different file types

These settings ensure that your code is automatically formatted and linted whenever you save a file.
