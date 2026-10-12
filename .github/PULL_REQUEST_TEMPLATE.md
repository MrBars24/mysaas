## Summary
<!-- Provide a brief description of the changes introduced by this PR. -->

## Associated Gate / Task
- [ ] Gate 1: Core CI & Local Auth Setup
- [ ] Feature / Bugfix Task: <!-- Link ticket or issue here -->

## Scope of Changes
- [ ] **Laravel Backend** (`app/Domains/`, API routes, migrations)
- [ ] **Nuxt Frontend** (`app/`, pages, components)
- [ ] **Infrastructure / Config** (`.github/`, dependencies)

## Pre-Merge Verification Checklist
Please ensure the following checks pass locally before requesting review:

### Backend Checks
- [ ] Code style passes (`./vendor/bin/pint --test`)
- [ ] Static analysis passes (`./vendor/bin/phpstan analyse`)
- [ ] Tests pass (`./vendor/bin/pest`)

### Frontend Checks
- [ ] Code formatting & linting pass (`npm run lint`)
- [ ] Unit tests pass (`npm run test:unit`)
- [ ] Build succeeds (`npm run build`)

---

## Screenshots / Verification Details
<!-- Attach proof, terminal output, or UI screenshots demonstrating that the feature/fix works as expected. -->