tinymce.PluginManager.add('els_grid', function(editor, url) {
    editor.addButton('els_grid', {
        type: 'menubutton',
        tooltip: 'Grid',
        icon: 'bs-grid',
        menu: [
            { text: '12 Columns', onclick: function() { editor.insertContent('[els_row class="row"]<br class="nc"/>[els_col class="col-sm-1"]Text[/els_col]<br class="nc"/>[els_col class="col-sm-1"]Text[/els_col]<br class="nc"/>[els_col class="col-sm-1"]Text[/els_col]<br class="nc"/>[els_col class="col-sm-1"]Text[/els_col]<br class="nc"/>[els_col class="col-sm-1"]Text[/els_col]<br class="nc"/>[els_col class="col-sm-1"]Text[/els_col]<br class="nc"/>[els_col class="col-sm-1"]Text[/els_col]<br class="nc"/>[els_col class="col-sm-1"]Text[/els_col]<br class="nc"/>[els_col class="col-sm-1"]Text[/els_col]<br class="nc"/>[els_col class="col-sm-1"]Text[/els_col]<br class="nc"/>[els_col class="col-sm-1"]Text[/els_col]<br class="nc"/>[els_col class="col-sm-1"]Text[/els_col]<br class="nc"/>[/els_row]'); } },
            { text: '6 Columns',  onclick: function() { editor.insertContent('[els_row class="row"]<br class="nc"/>[els_col class="col-sm-2"]Text[/els_col]<br class="nc"/>[els_col class="col-sm-2"]Text[/els_col]<br class="nc"/>[els_col class="col-sm-2"]Text[/els_col]<br class="nc"/>[els_col class="col-sm-2"]Text[/els_col]<br class="nc"/>[els_col class="col-sm-2"]Text[/els_col]<br class="nc"/>[els_col class="col-sm-2"]Text[/els_col]<br class="nc"/>[/els_row]'); } },
            { text: '4 Columns',  onclick: function() { editor.insertContent('[els_row class="row"]<br class="nc"/>[els_col class="col-sm-3"]Text[/els_col]<br class="nc"/>[els_col class="col-sm-3"]Text[/els_col]<br class="nc"/>[els_col class="col-sm-3"]Text[/els_col]<br class="nc"/>[els_col class="col-sm-3"]Text[/els_col]<br class="nc"/>[/els_row]'); } },
            { text: '3 Columns',  onclick: function() { editor.insertContent('[els_row class="row"]<br class="nc"/>[els_col class="col-sm-4"]Text[/els_col]<br class="nc"/>[els_col class="col-sm-4"]Text[/els_col]<br class="nc"/>[els_col class="col-sm-4"]Text[/els_col]<br class="nc"/>[/els_row]'); } },
            { text: '2 Columns',  onclick: function() { editor.insertContent('[els_row class="row"]<br class="nc"/>[els_col class="col-sm-6"]Text[/els_col]<br class="nc"/>[els_col class="col-sm-6"]Text[/els_col]<br class="nc"/>[/els_row]'); } },
            { text: '1 Columns',  onclick: function() { editor.insertContent('[els_row class="row"]<br class="nc"/>[els_col class="col-sm-12"]Text[/els_col]<br class="nc"/>[/els_row]'); } },
            {
                text: 'Custom Grid',
                onclick: function() {
                    tinymce.activeEditor.windowManager.open({
                        title: 'Custom Grid',
                        url: url + '/grid.html',
                        width: 580,
                        height: 420
                    });
                }
            }
        ]
    });
});
