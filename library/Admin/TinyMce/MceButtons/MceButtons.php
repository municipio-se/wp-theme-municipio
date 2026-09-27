<?php

namespace Municipio\Admin\TinyMce\MceButtons;

use \Municipio\Helper\Styleguide;

class MceButtons extends \Municipio\Admin\TinyMce\PluginClass
{
    public function init()
    {
        $this->pluginSlug = 'mce_hbg_buttons';

        $this->data['themeUrl'] = get_template_directory_uri();
        $this->data['styleSheet'] = apply_filters(
            'Municipio/admin/editor_stylesheet',
            get_template_directory_uri() .
                '/assets/dist/' .
                \Municipio\Helper\CacheBust::name('css/styleguide.css')
        );
        // The dialog is served without WordPress, so pass filtered settings from
        // the current site's editor instead of bootstrapping a different site.
        $this->data['options'] = apply_filters('Municipio/admin/tinymce/buttons/options', [
            'colors' => ['default', 'primary', 'secondary'],
            'styles' => ['filled', 'outlined'],
            'sizes' => ['md', 'lg', 'sm'],
        ]);
        $this->data['previewCss'] = apply_filters('Municipio/admin/tinymce/buttons/preview_css', '');
    }

    public function localizeScript()
    {
        echo '<script>var mce_hbg_buttons = ' . wp_json_encode(
            $this->data,
            JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT
        ) . ';</script>';
    }
}
