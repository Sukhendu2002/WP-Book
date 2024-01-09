# WP Book Plugin

WP Book is a WordPress plugin assignment from [rtCamp](https://learn.rtcamp.com/courses/basic-wordpress-plugin-development/l/assignment-basic-wp-plugin-development/)

## Features

1. **Custom Post Type - Book:**
Create and manage books easily with a dedicated custom post type.
![image](https://github.com/Sukhendu2002/WP-Book/assets/76804228/0e0dd304-268a-43ff-a93b-9d11a40dfb7e)


2. **Custom Hierarchical Taxonomy - Book Category:**
Organize books into hierarchical categories for better classification.
![image](https://github.com/Sukhendu2002/WP-Book/assets/76804228/8c12b8e4-c927-4ae3-84af-de978ee58e82)

3. **Custom Non-Hierarchical Taxonomy - Book Tag:**
Add tags to books for flexible categorization.
![image](https://github.com/Sukhendu2002/WP-Book/assets/76804228/210a14cf-6576-4897-bee0-b411477517e0)

4. **Custom Meta Box:**
Easily input and save book meta information such as Author Name, Price, Publisher, Year, Edition, URL, etc.
![image](https://github.com/Sukhendu2002/WP-Book/assets/76804228/4b3de760-2044-4516-99d8-2ae08a1b3baf)

5. **Custom Meta Table:**
Utilize a custom meta table to efficiently store and retrieve book meta information.
![image](https://github.com/Sukhendu2002/WP-Book/assets/76804228/50cbbe00-4731-4d62-94d8-416e5b87f11d)

6. **Admin Settings Page:**
   - Configure plugin settings through a user-friendly admin settings page under the Books menu.
   - Options include changing currency, adjusting the number of books displayed per page, and more.
![image](https://github.com/Sukhendu2002/WP-Book/assets/76804228/c30db724-e99a-4e74-8be3-7e1482b4648e)

7. **Shortcode [book]:**
Use the `[book]` shortcode to display book information with attributes like id, author_name, year, category, tag, and publisher.
![image](https://github.com/Sukhendu2002/WP-Book/assets/76804228/c48b0d74-32ea-4c43-970e-b22bda366a46)

8. **Custom Widget:**
Add a custom widget to the sidebar to showcase books from selected categories.
![image](https://github.com/Sukhendu2002/WP-Book/assets/76804228/4bf408e6-05c5-4ef6-b098-dcd66399b59e)

9. **Dashboard Widget:**
Display a dashboard widget highlighting the top 5 book categories based on count.
![image](https://github.com/Sukhendu2002/WP-Book/assets/76804228/dc32ba2b-24a5-40f3-97bd-9068ddf97f6d)

10. **Internationalization (i18n):**
The plugin is internationalized for easy translation into different languages.

## Installation

1. Download the plugin ZIP file.
2. Upload the ZIP file through the WordPress admin interface or extract it to the `/wp-content/plugins/` directory.
3. Activate the plugin through the 'Plugins' menu in WordPress.

## Usage

- After activation, you can start creating and managing books using the dedicated Book post type.
- Configure plugin settings in the Books menu under the admin dashboard.

## Shortcode Usage

Use the `[book]` shortcode with attributes to display book information. 
<!---
Example:

```[book id="1" author_name="John Doe" year="2022" category="fiction" tag="mystery" publisher="ABC Books"]```
-->

