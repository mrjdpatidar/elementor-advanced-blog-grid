# Advanced Blog Grid — Elementor Dynamic Posts & Grid Widget

### Product & Plugin Documentation by Jagdish Patidar

A high-performance WordPress plugin that provides a responsive, highly configurable post and page grid widget for the Elementor Page Builder, complete with dynamic query controls, modern card styling, and built-in numeric pagination.

- **Developer:** Jagdish Patidar
- **Company:** [Drunall Technologies](https://drunall.com)
- **Project Type:** WordPress Plugin / Elementor Addon
- **Repository Type:** Open Source WordPress Plugin
- **Source Code:** Public
- **Tested Up To:** WordPress 6.x & Elementor 3.x

---

## Overview

Modern corporate websites require flexible, brand-aligned post grids that display articles, or custom pages without relying on bloated, heavyweight third-party addon suites.

**Advanced Blog Grid** was custom-engineered to solve this need by providing a lightweight, native Elementor widget with zero external CSS framework dependencies. It gives site builders and designers granular control over query parameters, responsive column counts, card padding, image aspect ratios, hover zoom animations, and standalone numeric pagination.

---

## The Business Problem

Standard WordPress archive displays and generic Elementor post widgets often present distinct challenges for high-traffic content sites:

- **Rigid Layouts:** Difficulty tailoring column counts independently for Desktop, Tablet, and Mobile devices.
- **Image Inconsistency:** Uneven thumbnail dimensions that break grid alignments without custom CSS.
- **Query Bloat:** Inability to easily filter by category, switch between posts and pages, or customize ordering directly within the visual builder.
- **Pagination Breakage:** Elementor pagination frequently conflicts with theme loop queries, causing 404 errors on subpages.
- **Plugin Bloat:** Installing massive 50-widget plugin bundles just for a simple blog grid slows down page speed scores.

Advanced Blog Grid solves these challenges with a single dedicated widget, streamlined queries, and isolated pagination query parameters.

---

## My Contribution

I developed the entire plugin architecture from ground up, focusing on clean WordPress APIs, strict sanitization, responsive Elementor Controls Manager integration, and fast rendering:

- Designed and implemented the PHP widget class extending `\Elementor\Widget_Base`.
- Implemented isolated URL-based pagination (`?abg_page=X`) using `paginate_links()` to prevent query collisions.
- Created lightweight, GPU-accelerated CSS grid rules with responsive variables for column gaps and row gaps.
- Integrated image aspect-ratio constraints (`16:9`, `4:3`, `1:1`, `3:2`, `2:3`) and smooth hover zoom animations.
- Ensured full WordPress Coding Standards compliance with proper escaping (`esc_html`, `esc_url`, `wp_kses_post`).

---

## Key Features

- **Dynamic Query Engine:**
  - Query standard Posts or Pages.
  - Dynamic category dropdown filter populated automatically from WordPress terms.
  - Sorting options: Publish Date, Title, Last Modified Date, Random, or Menu Order.
  - Ascending (`ASC`) or Descending (`DESC`) order toggles.
  - Posts-per-page limit (1 to 100).

- **Granular Component Toggles:**
  - Featured Image switcher with standard WordPress size selectors (`thumbnail`, `medium`, `medium_large`, `large`, `full`).
  - Post Title toggle with normal and hover color pickers.
  - Excerpt toggle with custom word count limit (`wp_trim_words`).
  - "Read More" button toggle with customizable button label.

- **Responsive Grid Controls:**
  - 1 to 6 columns with responsive device switcher (Desktop, Tablet, Mobile).
  - Responsive column gap and row gap sliders.
  - Card text alignment (Left, Center, Right).

- **Visual Card Styling:**
  - Background color and gradient support via Group Background Control.
  - Border style, width, and color controls.
  - Border radius and box shadow controls.
  - Image aspect ratio lock and hover zoom animation.

- **Independent Numeric Pagination:**
  - Previous / Next navigation arrows.
  - First / Last page boundary numbers.
  - Configurable page numbers around the current page (`mid_size`).
  - Full typography, button size, border radius, and active/hover colors.

---

## Technical Architecture

```text
advanced-blog-grid/
├── advanced-blog-grid.php    # Plugin header, activation guard, Elementor widget registration
├── widget.php                # Widget Base class, register_controls(), and render() template
└── assets/
    └── style.css             # CSS Grid layout, aspect ratio helpers, pagination styles
```

- **PHP Compatibility:** PHP 7.4 – 8.3+
- **WordPress Hooks:** `plugins_loaded`, `elementor/widgets/register`, `wp_enqueue_scripts`
- **Asset Strategy:** Assets are registered and enqueued only when Elementor detects the widget on the rendered page.

---

## Installation & Setup

1. Compress the `advanced-blog-grid` folder into `advanced-blog-grid.zip`.
2. In WordPress Admin, navigate to **Plugins > Add New > Upload Plugin**.
3. Select the zip file and click **Install Now**, then click **Activate**.
4. Open any page in the **Elementor Page Builder**.
5. Search for **Advanced Blog Grid** in the widget panel, drag it into a section, and configure your settings.

---

## Author & License

- **Developer:** Jagdish Patidar
- **Company:** Drunall Technologies
- **License:** GPL-2.0-or-later
