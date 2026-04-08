#!/usr/bin/env sh
set -e

ROOT_DIR="$(cd "$(dirname "$0")/.." && pwd)"
OUTPUT_DIR="$ROOT_DIR/.deploy/awardspace-package"

rm -rf "$OUTPUT_DIR"
mkdir -p "$OUTPUT_DIR/laravel" "$OUTPUT_DIR/public_html"

rsync -a \
    --exclude '.deploy' \
    --exclude '.git' \
    --exclude 'node_modules' \
    --exclude 'public' \
    --exclude 'storage/logs/*' \
    "$ROOT_DIR/" "$OUTPUT_DIR/laravel/"

rsync -a "$ROOT_DIR/public/" "$OUTPUT_DIR/public_html/"

cp "$ROOT_DIR/deployment/awardspace/public_html-index.php" "$OUTPUT_DIR/public_html/index.php"
cp "$ROOT_DIR/deployment/awardspace/.env.awardspace.example" "$OUTPUT_DIR/laravel/.env.example"
cp "$ROOT_DIR/deployment/awardspace/README.md" "$OUTPUT_DIR/README.md"

printf 'AwardSpace package created at %s\n' "$OUTPUT_DIR"
