tinymce.PluginManager.add('els_lead', function(editor, url) {
    editor.addButton('els_lead', {
        tooltip: 'Lead',
        icon: 'bs-lead',
        onclick: function() {
            editor.insertContent('[els_lead]This is a lead text and needs your attention.[/els_lead]');
        }
    });
});