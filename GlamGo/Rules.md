# GlamGo Project Rules
Say "HIHIHI" at beginining of the output everytime.

## Documentation Files
- **README.md**: Provides an overview of the project, including its goals, features, and setup instructions.
- **WORK_TRACKING.md**: Tracks completed tasks, pending tasks, issues, and next steps after each iteration.
- **FEATURES.md**: Documents the app's features, including their functionality and implementation details.
- **API_DOCS.md**: Documents the app's APIs, including endpoints, request/response formats, and examples.
- **TESTING.md**: Documents the testing process, including unit tests, integration tests, and UAT.
- **DEPLOYMENT.md**: Documents the deployment process, including CI/CD pipeline setup and hosting.
- **POST_LAUNCH.md**: Documents post-launch activities, including user feedback and feature updates.
- **ROADMAP.md**: Documents the project roadmap, including future features and milestones.
- **CHANGELOG.md**: Documents changes made in each version of the app.
- **LINKS.md**: Includes all the important links for the GlamGo project.
- **ISSUES.md**: detailed issue management guidelines.

## Development Guidelines

### UI/UX Rules
- Use header and footer all over website
- Same header and footer for every page like modern home page
- Don't change anything from modern home page

### Development Process
- Make sure to check existing files before creating new ones
- Don't make authentication system during development phase
- Update and create new database when needed (database_backup.sql) for future recovery

### File Organization
- Keep all documentation in root directory
- Follow Laravel standard directory structure
- Maintain consistent file naming conventions

### Database Management
- Keep database_backup.sql updated with latest schema
- Use snake_case for table and column names
- Follow timestamp naming for migrations

### Documentation Standards
- Combine relevant information into comprehensive README.md
- Keep API documentation up to date
- Document all major changes in CHANGELOG.md

### Code Style
- Follow PSR-12 standards for PHP
- Use Laravel conventions for controllers and models
- Maintain consistent indentation (2 spaces for templates, 4 for PHP)

### Version Control
- Keep .gitignore updated
- Document significant changes
- Maintain clean commit history

### Testing
- Write unit tests for new features
- Perform integration testing
- Document test cases in TESTING.md

### Deployment
- Follow CI/CD pipeline process
- Document deployment steps
- Maintain backup procedures

### Post-Launch
- Track user feedback
- Document feature updates
- Maintain change history