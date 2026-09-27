<?php require_once('../View/header.php'); ?>
            <div class="grid">
                <div class="grid-xs-12">
                    <div id="preview">
                        <div>
                            <a class="c-button c-button__filled c-button__filled--default c-button--md ripple ripple--before" target="_top" aria-pressed="false">   
                                <span class="c-button__label">
                                    <span class="c-button__label-text">
                                    Button text
                                    </span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="grid-xs-12">
                    <form id="btnColor" class="hide-radio-input">
                        <input id="button-color-default" type="radio" name="gender" value="default" checked>
                        <label for="button-color-default"><span class="c-button c-button__filled c-button__filled--default"></span> </label>
                        <input id="button-color-primary" type="radio" name="gender" value="primary">
                        <label for="button-color-primary"><span class="c-button c-button__filled c-button__filled--primary"></span></label>
                        <input id="button-color-secondary" type="radio" name="gender" value="secondary">
                        <label for="button-color-secondary"><span class="c-button c-button__filled c-button__filled--secondary"></span></label>
                    </form>
                </div>
            </div>

            <br>

            <div class="grid">
                <div class="grid-xs-6">
                    <input id="btnText" type="text" value="Button text" placeholder="Button text">
                </div>
                <div class="grid-xs-6">
                    <input id="btnLink" type="text" value="https://helsingborg.se/" placeholder="Button URL">
                </div>
            </div>

            <br>

            <div class="grid">
                <div class="grid-xs-6">
                    <form id="button-type" class="button-type">
                        <h6>Button style</h6>
                        <div>
                            <input id="button-type-filled" type="radio" name="gender" value="c-button c-button__filled c-button__filled" checked>
                            <label for="button-type-filled">Filled button</label>
                        </div>
                        <div>
                            <input id="button-type-outlined" type="radio" name="gender" value="c-button c-button__outlined c-button__outlined">
                            <label for="button-type-outlined">Outline button</label>
                        </div>
                    </form>
                </div>
                <div class="grid-xs-6">
                    <form id="btnSize" class="button-size">
                            <h6>Button size</h6>
                            <div>
                                <input id="button-size-md" type="radio" name="gender" value="c-button--md ripple ripple--before" checked>
                                <label for="button-size-md">Default</label>
                            </div>
                            <div>
                                <input id="button-size-lg" type="radio" name="gender" value="c-button--lg ripple ripple--before">
                                <label for="button-size-lg">Large</label>
                                </div>
                            <div>
                                <input id="button-size-sm" type="radio" name="gender" value="c-button--sm ripple ripple--before">
                                <label for="button-size-sm">Small</label>
                            </div>
                    </form>
                </div>
            </div>
            <style>
                form#btnColor span {
                    width: 100%;
                    border-radius: 0;
                    height: 50px;
                    margin: 1px;
                }

                form#btnColor {
                    text-align: center;
                    display: flex;
                    align-content: stretch;
                }

                form#btnColor label {
                    display: flex;
                    flex-grow: 1;
                }

                #preview {
                    justify-content: center;
                    display: flex;
                    height: 100px;
                    align-items: center;
                    text-align: center;
                }

                #preview > div {
                    width: 100%;
                }
            </style>
            <script>
                $(document).ready(function () {
                    var host = typeof top.tinymce !== 'undefined' ? top : window.parent;
                    var params = host.tinymce.activeEditor.windowManager.getParams();
                    var config = host.mce_hbg_buttons || {};
                    $('<link>', {rel: 'stylesheet', href: params.stylesSheet.styleguideUrl}).appendTo('head');
                    $('<style>').text((params.stylesSheet.inlineStyles || '') + '\n' + (config.previewCss || '')).appendTo('head');

                    // An empty color list hides the selector but retains the
                    // default color in saved markup for existing renderers.
                    var groups = {colors: ['#btnColor', 'button-color-'], styles: ['#button-type', 'button-type-'], sizes: ['#btnSize', 'button-size-']};
                    Object.keys(groups).forEach(function (key) {
                        var allowed = config.options && config.options[key];
                        if (!Array.isArray(allowed)) return;
                        var form = $(groups[key][0]);
                        if (!allowed.length) {
                            form.hide();
                            return;
                        }
                        form.find('input[type=radio]').each(function () {
                            if (allowed.indexOf(this.id.replace(groups[key][1], '')) !== -1) return;
                            form.find('label[for="' + this.id + '"]').remove();
                            $(this).remove();
                        });
                        if (!form.find(':checked').length) form.find('input:first').prop('checked', true);
                    });

                    $('#btnText').keyup(function() {
                        $("#preview a span span").text($('#btnText').val());
                    });
                    $('input[type="radio"], input[type="checkbox"]').click(function () {
                        var buttonClass = "";
                        
                        $('input:checked[id^=button-type]').each(function(index, element) {
                            buttonClass += $(element).val();
                        });

                        $('input:checked[id^=button-color]').each(function(index, element) {
                            buttonClass += '--' + $(element).val();
                        });

                        $('input:checked[id^=button-size]').each(function(index, element) {
                            buttonClass += ' ' + $(element).val();
                        });

                        $('#preview a').removeClass();
                        $('#preview a').addClass(buttonClass);
                    });
                    $('input[type=radio]:checked').first().trigger('click');
                });
            </script>
<?php require_once('../View/footer.php'); ?>
