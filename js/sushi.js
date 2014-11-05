function addtag(button, itemId, tagName, hash) {

    button.style.backgroundColor = '#c0c0c0';

    var a = [];
    a.push({name: 'item_id', value: itemId});
    a.push({name: 'tag', value: tagName});
    a.push({name: 'hash', value: hash});

    $.post('/addtag.php', a, function (ret, stat) {
        if (stat=='success' && ret=='ok') {
            button.style.backgroundColor = '#d0e0d0';
            button.style.borderStyle = 'inset';
        } else {
            button.style.backgroundColor = 'default';
        }
    });

    return false;
}