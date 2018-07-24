# Structured Data

**JSON-LD structured data for statamic.**

## Setup
1. Move the `StructuredData` folder into your statamic addons directory under `site/addons/`.
2. Run `php please update:addons` to download the dependencies required by this addon.

## Use
Just insert the `{{ structured_data:breadcrumb }}` tag anywhere in your template to output the JSON-LD breadcrumb of the current page.
(https://developers.google.com/search/docs/data-types/breadcrumb)
