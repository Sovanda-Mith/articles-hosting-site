# CSV Data Import Instructions

This directory contains CSV files with sample data for your Laravel articles hosting application.

## Files Included

- `users.csv` - User accounts with profiles
- `categories.csv` - Article categories
- `articles.csv` - Sample articles with full content
- `article_categories.csv` - Many-to-many relationship between articles and categories
- `article_likes.csv` - User likes on articles
- `article_comments.csv` - Comments on articles
- `import_data.sql` - SQL script for direct MySQL import

## Data Overview

### Users (6 records)
- Mix of regular users and admin
- Includes profiles with bio, images, and social login data
- Passwords are hashed using Laravel's default bcrypt

### Categories (10 records)
- Technology, Web Development, Mobile Development
- Data Science, DevOps, UI/UX Design
- Digital Marketing, Cybersecurity, Cloud Computing, Blockchain

### Articles (6 records)
- Comprehensive articles with full content in Markdown format
- Mix of published and draft status
- Realistic view counts and metadata
- Cover topics: Laravel 11, SEO, UI/UX, Microservices, ML Production, Docker

### Relationships
- Articles linked to multiple categories
- Users have liked and commented on articles
- Realistic engagement patterns

## Import Methods

### Method 1: Using Laravel Seeder (Recommended for Laravel projects)

1. Copy CSV files to Laravel storage:
```bash
# Create storage directory
sudo docker compose exec app mkdir -p storage/app/csv

# Copy CSV files
sudo docker compose cp data/users.csv my-laravel-app:/var/www/storage/app/csv/
sudo docker compose cp data/categories.csv my-laravel-app:/var/www/storage/app/csv/
sudo docker compose cp data/articles.csv my-laravel-app:/var/www/storage/app/csv/
sudo docker compose cp data/article_categories.csv my-laravel-app:/var/www/storage/app/csv/
sudo docker compose cp data/article_likes.csv my-laravel-app:/var/www/storage/app/csv/
sudo docker compose cp data/article_comments.csv my-laravel-app:/var/www/storage/app/csv/
```

2. Run the seeder:
```bash
sudo docker compose exec app php artisan db:seed --class=CsvDataSeeder
```

### Method 2: Direct MySQL Import

1. Update docker-compose.yml to mount data directory:
```yaml
db:
  # ... existing configuration ...
  volumes:
    - dbdata:/var/lib/mysql
    - ./data:/var/lib/mysql-files  # Add this line
```

2. Restart database container:
```bash
sudo docker compose restart db
```

3. Copy CSV files and run SQL script:
```bash
# Access MySQL container
sudo docker compose exec db mysql -u root -p

# In MySQL prompt:
source /var/lib/mysql-files/import_data.sql
```

### Method 3: Manual CSV Import via phpMyAdmin

Add phpMyAdmin to your docker-compose.yml and use the GUI import feature.

## Data Relationships

- **Users** → **Articles** (author relationship)
- **Articles** ↔ **Categories** (many-to-many via article_categories)
- **Users** + **Articles** → **Likes** (user can like articles)
- **Users** + **Articles** → **Comments** (user can comment on articles)

## Sample Queries

```sql
-- Get articles with their categories
SELECT a.title, GROUP_CONCAT(c.name) as categories
FROM articles a
JOIN article_categories ac ON a.article_id = ac.article_id
JOIN categories c ON ac.category_id = c.category_id
GROUP BY a.article_id;

-- Get user engagement stats
SELECT u.name, 
       COUNT(DISTINCT a.article_id) as articles_written,
       COUNT(DISTINCT l.like_id) as likes_given,
       COUNT(DISTINCT com.comment_id) as comments_made
FROM users u
LEFT JOIN articles a ON u.id = a.user_id
LEFT JOIN article_likes l ON u.id = l.user_id
LEFT JOIN article_comments com ON u.id = com.user_id
GROUP BY u.id;

-- Get most popular articles
SELECT a.title, a.view_count,
       COUNT(DISTINCT l.like_id) as likes,
       COUNT(DISTINCT c.comment_id) as comments
FROM articles a
LEFT JOIN article_likes l ON a.article_id = l.article_id
LEFT JOIN article_comments c ON a.article_id = c.article_id
GROUP BY a.article_id
ORDER BY a.view_count DESC;
```

## Notes

- All timestamps are in MySQL datetime format
- Passwords are hashed with Laravel's bcrypt
- Some users have Google OAuth IDs for social login
- Content includes realistic article text with proper formatting
- Foreign key relationships are properly maintained
