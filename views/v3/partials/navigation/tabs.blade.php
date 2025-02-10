@if($tabMenuItems)
    @nav([
        'id' => 'tabs',
        'items' => $tabMenuItems,
        'direction' => 'horizontal',
        'includeToggle' => false,
        'allowStyle' => true,
        'buttonColor' => $customizer->tabmenuButtonColor,
        'buttonStyle' => $customizer->tabmenuButtonType,
        'height' => 'sm',
        'classList' => apply_filters('Municipio/Hook/headerSecondaryNavigationTabsClass', [
            'u-width--auto',
            'u-display--none@xs',
            'u-display--none@sm',
            'u-display--none@md'
        ])
    ])
    @endnav
@endif