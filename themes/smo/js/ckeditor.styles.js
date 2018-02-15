/**
 * Created by dimateus on 12/04/16.
 */
CKEDITOR.addStylesSet('drupal', [

    /* Block Styles */
    {
        name: 'Text Large',
        element: 'span',
        attributes: {'class': 'text-large'},
    },
    {
        name: 'Text X-Large',
        element: 'span',
        attributes: {'class': 'text-x-large'},
    },
    /* Object Styles */
    {
        name: 'Link Button Orange',
        element: 'a',
        attributes: {'class': 'btn style-big'},
    },
    {
        name: 'Link Button Blue Download',
        element: 'a',
        attributes: {'class': 'btn style-cerulean type-download'},
    },
    {
        name: 'Link Button Purple',
        element: 'a',
        attributes: {'class': 'btn style-purple'},
    },
    {
        name: 'Link with Download arrow',
        element: 'a',
        attributes: {'class': 'link-download'},
    },
    {
        name: 'Ordered list with blue pentagons',
        element: 'ol',
        attributes: {'class': 'list-style'},
    },
    {
        name: 'Table white/blue',
        element: 'table',
        attributes: {'class': 'style-a'},
    },
    {
        name: 'Table white/grey',
        element: 'table',
        attributes: {'class': 'b-table style-e'},
    },
    {
        name: 'Table white/grey 2',
        element: 'table',
        attributes: {'class': 'b-table style-f'},
    },
    {
        name: 'Caption: Left',
        type: 'widget',
        widget: 'image',
        attributes: { 'class': 'caption-left' }
    },
    {
        name: 'Caption: Center',
        type: 'widget',
        widget: 'image',
        attributes: { 'class': 'caption-center' }
    },
    {
        name: 'Caption: Right',
        type: 'widget',
        widget: 'image',
        attributes: { 'class': 'caption-right' }
    }
]);