//This script is for add form machine in form MeuleRecti

jQuery(document).ready(function() {

    // Get the ul that holds the collection of tags
    var $positionCollectionHolder = $('div.machine-fields-list');

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $positionCollectionHolder.data('index', $positionCollectionHolder.find('input').length);

    $('body').on('click', '.add-new-machine', function(e) {
        var $collectionHolderClass = $(e.currentTarget).data('collectionHolderClass');

        // add a new tag form (see next code block)
        addFormToCollection($collectionHolderClass);
    })
});

function addFormToCollection($collectionHolderClass) {

    // Get the ul that holds the collection of tags
    var $collectionHolder = $('.' + $collectionHolderClass);

    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');

    // get the new index
    var index = $collectionHolder.data('index');

    var newForm = prototype;
    // You need this only if you didn't set 'label' => false in your tags field in TaskType
    // Replace '__name__label__' in the prototype's HTML to
    // instead be a number based on how many items we have
    // newForm = newForm.replace(/__name__label__/g, index);

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    newForm = newForm.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormLi = $('<div class="mr-2"></div>').append(newForm);
    // Add the new form at the end of the list
    $collectionHolder.append($newFormLi)
}
