// Wait for the document to be ready
$(document).ready(function () {
    // Add a change event listener to the select element
    $('#department').change(function () {
        // Get the selected option value
        var selectedOption = $(this).val();
        
        // Update the result paragraph with the selected option
        $('#result').text('Selected option: ' + selectedOption);
        $.ajax({
            url: 'departmentstaff.php',
            type: 'POST',
            data: {
                
                query: 'SELECT * FROM staffs where `department_id`='+selectedOption
            },
            success: function (response) {
                // Update the result div with the query result
                $('#result').html(response);
            },
            error: function (error) {
                console.log(error);
            }
        });
    });
});
