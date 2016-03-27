tinymce.PluginManager.add('els_buttons', function(editor, url) {
    editor.addButton('els_buttons', {
        tooltip: 'Buttons',
        icon: 'bs-buttons',
        onclick: function() {
            tinymce.activeEditor.windowManager.open({
                title: 'Buttons',
                url: url + '/buttons.html',
                width: 480,
                height: 320
            });
        }
    });
});