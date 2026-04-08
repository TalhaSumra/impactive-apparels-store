# AwardSpace Deployment

This project includes a shared-hosting deployment path for no-card PHP hosting providers such as AwardSpace.

## What To Create In AwardSpace

1. A free hosting account
2. A free subdomain
3. A MySQL database

## Files To Upload

- Upload the generated `public_html` directory contents to your website root
- Upload the generated `laravel` directory next to `public_html`
- Copy `.env.awardspace.example` to `.env` inside the uploaded `laravel` directory
- Update the database and app URL values in `.env`

## First-Time Setup

After uploading and editing `.env`, open:

`https://your-subdomain/setup/your-setup-token`

That route will run the database migrations and seed the starter product catalog.

After setup completes:

1. Change `SETUP_ENABLED` to `false`
2. Keep the `SETUP_TOKEN` private

## Notes

- This path is intended for shared hosts without SSH access
- Cart sessions use files instead of the database for easier setup
- Queue is set to `sync`
- Cache is set to `file`
