@form([
  'id'        => 'mobile-search-form',
  'method'    => 'get',
  'action'    => $homeUrl,
  'classList' => $classList,
  'validation' => $applyFilters('searchFormValidation', true),
])
    @group(['direction' => 'horizontal', 'classList' => ['u-margin--auto']])
        @field([
            'id'            => 'mobile-search-form__field',
            'type'          => 'search',
            'name'          => 's',
            'required'      => false,
            'size'          => 'sm',
            'radius'        => 'sm',
            'borderless'    => true,
            'label'         => $lang->searchQuestion,
            'hideLabel'     => true,
            'icon'          => ['icon' => 'search'],
            'classList'     => [
                'u-flex-grow--1',
                'u-box-shadow--1',
            ]
        ])
        @endfield

        @button([
            'id'            => 'mobile-search-form__submit',
            'text'          => $lang->search,
            'color'         => 'default',
            'type'          => 'submit',
            'size'          => 'sm',
            'attributeList' => [
                'aria-label' => $lang->search,
            ],
        ])
        @endbutton
    @endgroup
@endform
