# WP Book Plugin

WP Book is a WordPress plugin assignment from [rtCamp](https://learn.rtcamp.com/courses/basic-wordpress-plugin-development/l/assignment-basic-wp-plugin-development/)

## Features

1. **Custom Post Type - Book:**
   - Create and manage books easily with a dedicated custom post type.

2. **Custom Hierarchical Taxonomy - Book Category:**
   - Organize books into hierarchical categories for better classification.

3. **Custom Non-Hierarchical Taxonomy - Book Tag:**
   - Add tags to books for flexible categorization.

4. **Custom Meta Box:**
   - Easily input and save book meta information such as Author Name, Price, Publisher, Year, Edition, URL, etc.

5. **Custom Meta Table:**
   - Utilize a custom meta table to efficiently store and retrieve book meta information.

6. **Admin Settings Page:**
   - Configure plugin settings through a user-friendly admin settings page under the Books menu.
   - Options include changing currency, adjusting the number of books displayed per page, and more.

7. **Shortcode [book]:**
   - Use the `[book]` shortcode to display book information with attributes like id, author_name, year, category, tag, and publisher.

8. **Custom Widget:**
   - Add a custom widget to the sidebar to showcase books from selected categories.

9. **Dashboard Widget:**
   - Display a dashboard widget highlighting the top 5 book categories based on count.

10. **Internationalization (i18n):**
    - The plugin is internationalized for easy translation into different languages.

## Installation

1. Download the plugin ZIP file.
2. Upload the ZIP file through the WordPress admin interface or extract it to the `/wp-content/plugins/` directory.
3. Activate the plugin through the 'Plugins' menu in WordPress.

## Usage

- After activation, you can start creating and managing books using the dedicated Book post type.
- Configure plugin settings in the Books menu under the admin dashboard.

## Shortcode Usage

Use the `[book]` shortcode with attributes to display book information. Example:

```[book id="1" author_name="John Doe" year="2022" category="fiction" tag="mystery" publisher="ABC Books"]```

