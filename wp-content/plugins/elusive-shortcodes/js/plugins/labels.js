
tinymce.PluginManager.add('els_labels', function(editor, url) {
    editor.addButton('els_labels', {
        tooltip: 'Labels',
        icon: 'bs-labels',
        onclick: function() {
            tinymce.activeEditor.windowManager.open({
                title: 'Labels',
                url: url + '/labels.html',
                width: 480,
                height: 320
            });
        }
    });
});
