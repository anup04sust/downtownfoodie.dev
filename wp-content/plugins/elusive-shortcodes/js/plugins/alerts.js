tinymce.PluginManager.add('els_alerts', function(editor, url) {
    editor.addButton('els_alerts', {
        tooltip: 'Alerts',
        icon: 'bs-alerts',
        onclick: function() {
            tinymce.activeEditor.windowManager.open({
                title: 'Add an alert',
                url: url + '/alerts.html',
                width: 480,
                height: 180
            });
        }
    });
});
