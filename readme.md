# Municipio Theme

This WordPress theme is an LTS version of [the Municipio theme](github.com/helsingborg-stad/Municipio).

Version 25.x is based on v4.25.0 of the original Municipio theme.

## Changes in this Fork

This LTS version includes substantial performance improvements and new functionality. Database query caching has been implemented for slow operations, and unused performance-impacting code has been removed. The theme now uses `get_option` instead of `get_field` for checking default post types, significantly improving load times.

New features include ReadSpeaker integration support, one-page template enhancements with navigation buttons and content display options, and an under-hero widget area. The theme now supports custom link targets, additional secondary navigation options, and content sections above and below article content through new hooks.

Archive functionality has been improved with better filtering, taxonomy information on post objects, and fixes for z-index issues. Post age notices now handle default posts and account for modified dates. The customizer includes new filters for archive styles and button configurations.

Security and accessibility improvements include disabling custom code input and advanced HTML tags by default, adding attributes to inline script tags, and fixing various template routing and styling issues. Multiple new filters and hooks have been added for better theme customization and extensibility.

## New WordPress Hooks

This fork adds the following WordPress hooks for enhanced customization:

**Filters:**
- `Municipio/Hook/showSiteNameInSearchResult` - Control site name display in search results
- `Municipio/Helper/Post/EmptyExcerpt` - Modify empty excerpt handling
- `Municipio/Admin/EnableMetaDataPlugin` - Control metadata plugin activation
- `Municipio/Admin/AllowAdvancedHtmlTags` - Control advanced HTML tags in editor
- `Municipio/Hook/searchFormValidation` - Customize search form validation
- `Municipio/Customizer/Sections/Archive/archiveStyleChoices` - Modify archive style options
- `Municipio/CustomPostType/args` - Modify custom post type arguments
- `Municipio/views/page-centered/content-area/show` - Control centered page content area display
- `Municipio/allowCustomCode` - Control custom code input availability
- `Municipio/views/partials/sidebar/classes` - Modify sidebar CSS classes
- `Municipio/Customizer/Sections/Button/*/kirkiFieldArgs` - Modify button customizer fields
- `Municipio/Admin/Acf/ImageAltTextValidation/getAltText` - Customize image alt text validation

**Actions:**
- `Municipio/Hook/articleContentBefore` - Add content before article content
- `Municipio/Hook/articleContentAfter` - Add content after article content
- `Municipio/Customizer/Sections/Archive/init` - Hook into archive customizer initialization

## Installation

1. Install the package:
   ```bash
   composer require municipio/wp-theme-municipio
   ```
2. Activate the theme in WordPress.
