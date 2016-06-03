$(document).ready(function() {
    $('body').on('beforeSubmit', 'form#dynamic-education', function() {
        var form = $(this);
        // return false if form still have some validation errors
        if (form.find('.has-error').length)
        {
            return false;
        }
        // submit form
        $.ajax({
            url: form.attr('action'),
            type: 'post',
            data: form.serialize(),
            success: function(response)
            {
//                $('.modal').on('hidden.bs.modal', function() {
//                    $(this).removeData('bs.modal');
//              
//                });
                
     
                $('#courses-course_name').val('');
                $('#courses-university').val('');
                $('#courses-year').val('');
                $('#courses-id').val('');
                
                $('#education-list').html(response.html);
                $('#educationBlock').modal('hide');
                
                
               
            },
            error: function()
            {
    -            console.log('internal server error');
            }
        });
        return false;
    });
    $('#educationBlock').on('hidden.bs.modal', function () {
                $(this).find('input').val(' ').end();
               
});    
    
    
    
    $('#education-list').on('click', 'a', function() {
        elemId = $(this).data("id");
        elemType = $(this).data("type");
        $('#courses-id').val(elemId);
        if (elemType == 'edit'){
            $.ajax({
                url: '/student/get-student-course',
                type: 'get',
                data: {
                    'courseId': elemId
                },
                success: function(response)
                {
                    $('#courses-course_name').val(response.course_name);
                    $('#courses-university').val(response.university);
                    $('#courses-year').val(response.year);
                },
                error: function()
                {
                    console.log('internal server error');
                }
            });

        }
    });
    
     $('#education-list').on('click', 'a', function() {
        elemId = $(this).data("id");
        elemType = $(this).data("type");
        $('#courses-id').val(elemId);
        if (elemType == 'delete'){
            $.ajax({
                url: '/student/get-student-course',
                type: 'get',
                data: {
                    'courseId': elemId,
                    
                },
                success: function(response)
                {
                    
                           },
                error: function()
                {
                    console.log('internal server error');
                }
            });

        }
    });
    
      $('body').on('beforeSubmit', 'form#deleted-education', function() {
       
        // submit form
        $.ajax({
            url: form.attr('action'),
            type: 'delete',
            data: {
                
            },
            success: function(response)
            {
               
            },
            error: function()
            {
    -            console.log('internal server error');
            }
        });
        return false;
    });
  
	
    
});