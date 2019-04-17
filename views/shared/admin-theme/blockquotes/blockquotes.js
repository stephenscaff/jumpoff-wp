/**
 * Blockquotes: TinyMCE Plugin
 * Adds a new custom blockquote button and blockquote popup modal offering citation support.
 * If text is selected, the button will toggle blockquote markup around the selection.
 * If no text is selected, a pop-up will display options for quote, citation, citation link.
 */
(function() {

  tinymce.PluginManager.add( 'tiny_blockquote', function( editor, url ) {

    editor.addButton( 'tiny_blockquote', {
      title: tiny_blockquotes.add_blockquote,
      type: 'button',
      icon: 'blockquote',
      onclick: function() {

        if ( editor.selection.getContent() ) {
          editor.formatter.toggle('blockquote');
        }
        else {

          var body = [
            {
              type: 'textbox',
              name: 'quote',
              label: tiny_blockquotes.quote,
              multiline: true,
              minWidth: 450,
              minHeight: 200
            },
            {
              type: 'textbox',
              name: 'cite',
              label: tiny_blockquotes.citation,
            },
            {
              type: 'textbox',
              name: 'link',
              label: tiny_blockquotes.citation_link,
            },
          ];

          // Display classes dropdown in pop-up if defined
          if ( tiny_blockquotes.class_options ) {

            var class_options = [];

            for ( var key in tiny_blockquotes.class_options ) {
              class_options.push({ 'value': key, 'text' : tiny_blockquotes.class_options[key] });
            }

            body.push({
              type:   'listbox',
              name:   'class',
              label:  tiny_blockquotes.class,
              values: class_options
            });
          }

          editor.windowManager.open({
            title: tiny_blockquotes.blockquote,
            body: body,
            onsubmit: function( e ) {
              var blockquote = '';
              var cite = '';

              if (e.data.link && e.data.cite) {
                cite = '<cite><a href="' + e.data.link + '">' + e.data.cite + '</a></cite>';
              }
              else if (!e.data.link && e.data.cite) {
                cite = '<cite>' + e.data.cite + '</cite>';
              }

              if (e.data.quote) {
                if (e.data.class) {
                  blockquote += '<blockquote class="' + e.data.class + '">';
                }
                else {
                  blockquote += '<blockquote>';
                }

                blockquote += e.data.quote;
                blockquote += '<br/><br/>';
                blockquote += cite;
                blockquote += '</blockquote>';
              }

              editor.insertContent(blockquote);
            }
          });
        }
      }
    });
  });
})();
