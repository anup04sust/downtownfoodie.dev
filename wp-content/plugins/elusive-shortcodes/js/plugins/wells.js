tinymce.PluginManager.add('els_wells', function(editor, url) {
    editor.addButton('els_wells', {
        type: 'menubutton',
        tooltip: 'Well',
        icon: 'bs-wells',
        menu: [
            { text: 'Small well',  onclick: function() { editor.insertContent('[els_well size="sm"]This well needs your attention.[/els_well]'); } },
            { text: 'Medium well', onclick: function() { editor.insertContent('[els_well size="md"]This well needs your attention.[/els_well]'); } },
            { text: 'Large well',  onclick: function() { editor.insertContent('[els_well size="lg"]This well needs your attention.[/els_well]'); } }
        ]
    });
});