$(document).ready(function() {
    // When the link is clicked, get the data-service-name attribute value
    $('a[data-bs-target="#editServiceModal"]').click(function() {
        var serviceName = $(this).data('service-name');

        // Set the value of the input field in the modal
        $('#editService').find('input[name=name]').val(serviceName);
    });
});