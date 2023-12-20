import './bootstrap';
import 'flowbite';
import DataTable from 'datatables.net-dt';

let table = new DataTable('#myTable', {
    responsive : true
});

$('#myTable').DataTable( {
    select: {
        items: 'single',
        info: false
    }
} );

$(document).ready(function() {
    // Handle form submission using AJAX
    $('#createUserForm').submit(function(event) {
        event.preventDefault();

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function(response) {
                // Handle success response
                console.log(response);
                alert('User created successfully!');
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error(xhr.responseText);
                alert('Error creating user.');
            }
        });
    });
});

// $('.toggle-active-btn').click(function() {
//     var userId = $(this).data('user-id');
//     var activeStatusElement = $('.active-status[data-user-id="' + userId + '"]');

//     // Toggle the active status locally
//     var isActive = activeStatusElement.data('active') === 'true';
//     activeStatusElement.text(isActive ? 'false' : 'true');
//     activeStatusElement.data('active', isActive ? 'false' : 'true');

//     // Make an AJAX request to update the active status in the controller
//     $.ajax({
//         url: '/update-active/' + userId,
//         type: 'PATCH',
//         data: {
//             is_active: isActive ? 'false' : 'true'
//         },
//         success: function(response) {
//             // Optionally handle the response from the server
//             console.log(response);
//         },
//         error: function(xhr, status, error) {
//             // Handle errors if needed
//             console.error(xhr.responseText);
//         }
//     });
// });
