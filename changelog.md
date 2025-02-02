# Changelog

## [0.0.7] - 2024-12-30

- Change redirect after login to /
- Improve styles of default app file
- Improve styles of index articles
- Improve styles of show articles
- Implement footer

## [0.0.6] - 2024-12-29

- Implement commenting posts
- Show number of comments on home page
- Implement policies to let admin delete comments

## [0.0.5] - 2024-12-29

- Implement liking posts

## [0.0.4] - 2024-12-28

- Implement subscription model and controller
- Implement payment model and acceptance 

## [0.0.3] - 2024-12-28

- Implemented Article model and controller
- Implemented Article image 
- Implemented Article CRUD for Author Dashboard
- Implemented Author Dashboard 
- Implemented Article CRUD for Admin Dashboard
- to enable images use php artisan storage:link

### Added
- Admin dashboard route with users management

## [0.0.2] - 2024-12-28

### Added
- Seeder for creating users with roles: `Admin`, `Author`, `Reader`.
- Role-based middleware for authorization.
- Endpoint to change user roles, restricted to admin users.
- Admin dashboard route with example data.

## [0.0.1] - 2024-11-20

### Added
- Initial installation of project.