function get_list( type )
{
	url = "include/list_" + type + ".php";
	//$('#processingModal').modal('toggle');
	$.ajax({
		type: "POST",
		url: url,
		data: { type: type },
		success: function( result ) {
			$( '#main_content' ).html( result );
			//$('#processingModal').modal('toggle');
		}
	});

}

function list_computers()
{
	//$('#processingModal').modal('toggle');
	$.ajax({
		type: "POST",
		url: "include/list_computers.php",
		success: function( result ) {
			createTable_computers( result );
			//$('#processingModal').modal('toggle');
		}
	});
}

function createTable_computers( result )
{

	var results = $.parseJSON( result );

	$('#main_content').html("");
	$('#main_content').append( "<div class='well'><form class='form-inline'><input type='text' class='form-control search' placeholder='Filter Results' size='25' data-column='all'><button class='btn btn-primary pull-right' type='button'><span class='glyphicon glyphicon-file'></span>&nbsp; Print Report</button></form></div>");

	

	$('#main_content').append( result );

}

function list_labs()
{
	//$('#processingModal').modal('toggle');
	$.ajax({
		type: "POST",
		url: "include/list_labs.php",
		success: function( result ) {
			$( '#main_content' ).html( result );
			//$('#processingModal').modal('toggle');
		}
	});
}

function list_printers()
{
	//$('#processingModal').modal('toggle');
	$.ajax({
		type: "POST",
		url: "include/list_printers.php",
		success: function( result ) {
			$( '#main_content' ).html( result );
			//$('#processingModal').modal('toggle');
		}
	});
}

function list_users()
{
	//$('#processingModal').modal('toggle');
	$.ajax({
		type: "POST",
		url: "include/list_users.php",
		success: function( result ) {
			$( '#main_content' ).html( result );
			//$('#processingModal').modal('toggle');
		}
	});
}

function list_purchases()
{
	//$('#processingModal').modal('toggle');
	$.ajax({
		type: "POST",
		url: "include/list_purchases.php",
		success: function( result ) {
			$( '#main_content' ).html( result );
			//$('#processingModal').modal('toggle');
		}
	});
}

function list_software()
{
	//$('#processingModal').modal('toggle');
	$.ajax({
		type: "POST",
		url: "include/list_software.php",
		success: function( result ) {
			$( '#main_content' ).html( result );
			//$('#processingModal').modal('toggle');
		}
	});
}
function formhash( form, password )
{
    // Create a new element input, this will be our hashed password field. 
    var p = document.createElement( "input" );
 
    // Add the new element to our form. 
    form.appendChild( p );
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512( password.value );
 
    // Make sure the plaintext password doesn't get sent. 
    password.value = "";
 
    // Finally submit the form. 
    form.submit();
}
 
function regformhash( form, uid, password, conf, role )
{
    // Check each field has a value
    if ( uid.value == '' || password.value == '' ||  conf.value == '' || role.value == '' )
	{ 
        alert( 'You must provide all the requested details.' );
        return false;
    }
 
    // Check the username
    re = /^\w+$/; 
    if( !re.test( form.username.value ) )
	{ 
        alert( "Username must contain only letters, numbers and underscores." ); 
        form.username.focus();
        return false; 
    }
 
    // Check that the password is sufficiently long (min 6 chars)
    // The check is duplicated below, but this is included to give more
    // specific guidance to the user
    if ( password.value.length < 6 )
	{
        alert( 'Passwords must be at least 6 characters long.  Please try again' );
        form.password.focus();
        return false;
    }
 
    // At least one number, one lowercase and one uppercase letter 
    // At least six characters 
 
    var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/; 
    if ( !re.test( password.value ) )
	{
        alert( 'Passwords must contain at least one number, one lowercase and one uppercase letter.' );
        return false;
    }
 
    // Check password and confirmation are the same
    if ( password.value != conf.value )
	{
        alert( 'Passwords do not match!' );
        form.password.focus();
        return false;
    }
 
    // Create a new element input, this will be our hashed password field. 
    var p = document.createElement( "input" );
 
    // Add the new element to our form. 
    form.appendChild( p );
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512( password.value );
 
    // Make sure the plaintext password doesn't get sent. 
    password.value = "";
    conf.value = "";
 
    // Finally submit the form. 
    form.submit();
    return true;
}
