
function extract_values_using_ids (ids) {
	var values = [];

	ids.forEach((id) => {
	    values.push( document.getElementById(id).value );
	});

	return values;
}

function validate (ids, types) {
	var msg = '';
	const max_length = 10;
	const max_length_big_text = 1000;

	values = extract_values_using_ids(ids);

	var zipped = values.map(function(e, i) {
  		return [e, ids[i], types[i]];
	});

	zipped.forEach((row) => {
		value = row[0];
		id = row[1];
		type = row[2];

		if (type === 'text') {
			if ( !validate_alfanumeric_text(value) || 
						value.length > max_length ) {
				msg = msg.concat(`\n Texto inválido en ${id}.`);
			}
		} else if (type === 'email') {
			if ( !validate_email(value) ) {
				msg = msg.concat(`\n Email inválido en ${id}.`);
			}
		} else if (type === 'phone') {
			if ( !validate_phone(value) ) {
				msg = msg.concat(`\n Teléfono inválido en ${id}.`);
			}
		} else if (type === 'path') {
			if ( !validate_path(value) ) {
				msg = msg.concat(`\n Path inválido en ${id}.`);
			}
		} else if (type === 'big-text') {
			if ( !validate_big_text(value) || 
						value.length > max_length_big_text ) {
				msg = msg.concat(`\n Text grande inválido en ${id}.`);
			}
		} else if (type === 'date') {
			if ( !validate_date(value) ) {
				msg = msg.concat(`\n Fecha inválida en ${id}.`);
			}
		} else if (type === 'number') {
			if ( !validate_number(value) ) {
				msg = msg.concat(`\n Número inválido en ${id}.`);
			}
		}
	});

	if (msg !== '') {
		alert(msg);
	}
	return msg === '';
}

function validate_alfanumeric_text (text) {
	const regex = new RegExp('^[a-zA-Z0-9]+$');
	return regex.test(text);
}

function validate_email (text) {
	const regex = new RegExp('^\\S+@\\S+\\.\\S+$');
	return regex.test(text);
}

function validate_phone (text) {
	const regex = new RegExp('^[0-9]{9}$');
	return regex.test(text);
}

function validate_path (text) {
	const regex = /^(.+)\\([^\\]+)$/;
	return regex.test(text);
}

function validate_date (text) {
	const regex = new RegExp('^[0-9]{4}(\-[0-9]{2}){2}$');
	return regex.test(text);
}

function validate_number (text) {
	const regex = new RegExp('^[0-9]+$');
	return regex.test(text);
}

function validate_big_text (text) {
	const regex = new RegExp('^[ a-zA-Z0-9]+$');
	return regex.test(text);
}