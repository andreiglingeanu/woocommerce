# Feature Flags

Features inside the `woocommerce` repository can be in various states of completeness. To provide a way for improved control over how these features are released in these different environments, `woocommerce` has a system for feature flags.

We currently support the following environments:

| Environment | Description                                                                                                                                                            |
|-------------|------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| development | Development - All features should be enabled in development. These flags are also used in both JS and PHP tests. Ran using `pnpm start`.                                |                              |
| core        | Core - assets/files ready and stable enough. Ran using `pnpm build` & `pnpm pack`.



## Adding a new flag

Flags can be added to the files located in the `config/` directory. Make sure to add a flag for each environment and explicitly set the flag to false.
Please add new feature flags alphabetically so they are easy to find.

## Basic Use - Client

The `window.wcAdminFeatures` constant is a global variable containing the feature flags.

Instances of `window.wcAdminFeatures` are replaced during the webpack build process by using webpack's [define plugin](https://webpack.js.org/plugins/define-plugin/). Using `webpack` for this allows us to eliminate dead code when making minified/production builds (`plugin`, or `core` environments).

To check if a feature is enabled, you can simplify check the boolean value of a feature:

```
{ window.wcAdminFeatures[ 'activity-panels' ] && <ActivityPanel /> }
```

We also expose CSS classes on the `body` tag, so that you can target specific feature states when they are enabled:

```
<body class="wp-admin woocommerce-page woocommerce-feature-enabled-activity-panels  ....">
```

## Basic Use - Server

Feature flags are also available via PHP. To ensure these are consistent with the built client assets, `includes/feature-config.php` is generated by the plugin build process or `pnpm start`. Do not edit `includes/feature-config.php` directly.

To check if a feature is enabled, you can use the `Automattic\WooCommerce\Admin\Features\Features::is_enabled()`:

```
if ( \Automattic\WooCommerce\Admin\Features\Features::is_enabled( 'activity-panels' ) ) {
	add_action( 'admin_header', 'wc_admin_activity_panel' );
}
```

If you name a directory after the flag in `includes/` with a `class-wc-admin-FEATURE.php` file, this code will also automatically be loaded.