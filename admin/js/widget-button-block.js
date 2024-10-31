// wp.blocks.registerBlockStyle( 'core/quote', {
//     name: 'fancy-quote',
//     label: 'Fancy Quote',
// } );
( function( wp ) {
    var withSelect = wp.data.withSelect;
    var ifCondition = wp.compose.ifCondition;
    var compose = wp.compose.compose;
    var WidgetCustomButton = function( props ) {
        return wp.element.createElement(
            wp.blockEditor.RichTextToolbarButton, {
                icon: 'editor-code',
                title: 'Searchie Widget Button',
                onClick: function() {
                    props.onChange( wp.richText.toggleFormat(
                        props.value,
                        {
                          type: 'searchie-custom-format/button-output',
                          attributes : {
                            href:'javascript:window._searchie.toggle()'
                          }
                        }
                    ) );
                },
                isActive: props.isActive,
            }
        );
    }

    var ConditionalButton = compose(
        withSelect( function( select ) {
            return {
                selectedBlock: select( 'core/editor' ).getSelectedBlock()
            }
        } ),
        ifCondition( function( props ) {
            return (
                props.selectedBlock &&
                props.selectedBlock.name === 'core/paragraph'
            );
        } )
    )( WidgetCustomButton );

    wp.richText.registerFormatType(
        'searchie-custom-format/button-output', {
            title: 'Searchie Widget Button',
            tagName: 'a',
            className: 'searchie-button',
            edit: WidgetCustomButton,
        }
    );
} )( window.wp );
