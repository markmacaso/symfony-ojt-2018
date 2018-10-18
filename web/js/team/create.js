$(document).ready(function() {
    var collection = new FormCollection(
        { 
            'empty_list_message': 'Please add your players',
            'display_cleanup_callback' : collectionCallback
        }
    );

    collection.start();
});

function collectionCallback(elem)
{
}
