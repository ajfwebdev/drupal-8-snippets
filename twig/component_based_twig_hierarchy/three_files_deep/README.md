In this example we want to include template files for a card component.
The "card" would be like a kind of small teaser block where you could
have several of them in a row or grid within a larger page layout.

Details:
my-content-type is a content type that has a view mode called "card".

node--my-content-type--card.html.twig is the custom node template file
for the card view mode. This file would be located in the template
directory under the theme directory, like:
themes/custom/my-theme/src/templates/content/node--my-content-type--card.html.twig

content-card.twig is a template included by node--my-content-type--card.html.twig
content-card.twig has markup for some of the card field data and it also
includes another twig template for the save/share links.
content-card.twig is located in a component directory:
themes/custom/my-theme/src/components/content-cards/content-card.twig

save-share-bar.twig is a template included by content-card.twig
It has markup for the save/share links.
save-share-bar.twig is located in the component directory:
themes/custom/my-theme/src/components/save-share-bar/save-share-bar.twig

For more info on how the data for the save/share links is provided to
the save-share-bar.twig template file, see:
module/entity_api_examples/render_field_data.module
