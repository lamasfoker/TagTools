function searchFile() {
    var input, table, row_id, col_id, row_number = 0;
    var row = [];
    var cell = [];

    input = document.getElementById('search').value;
    table = document.getElementById('file-table');

    if (input.includes('&&') || input.includes('||') && table){
        searchTagFile();
        return;
    }

    row = table.getElementsByTagName('tr');

    for (row_id=1; row_id<row.length; row_id++) {
    	cell = row[row_id].getElementsByTagName('td');
        row[row_id].style.display = 'none';
    	for (col_id=1; col_id<cell.length; col_id++) {
	        if (cell[col_id].textContent.indexOf(input) > -1) {
	            row[row_id].style.display = '';
	            row_number++;
	            break;
	        }
	    }
    }
    setNumberRow(row_number);
    pagination();

}

function searchTag() {
    var input, table, row_id, cell, row_number = 0;
    var row = [];

    input = document.getElementById('search').value;
    table = document.getElementById('tag-table');

    row = table.getElementsByTagName('tr');

    for (row_id=1; row_id<row.length; row_id++) {
        cell = row[row_id].getElementsByTagName('td')[0];
        row[row_id].style.display = 'none';
		if (cell.textContent.indexOf(input) > -1) {
			row[row_id].style.display = '';
			row_number++;
        }
    }
    setNumberRow(row_number);
    pagination();

}

function searchTagFile() {
	var input, table, row_id, q_id, tag, resolved, allTag, row_number = 0;
	var row = [];
	var query = [];
	var nString;

	input = document.getElementById('search').value;
	table = document.getElementById('file-table');

	row = table.getElementsByTagName('tr');
	for (row_id=1; row_id<row.length; row_id++){
		allTag = row[row_id].getElementsByTagName('td')[4].textContent;

		query = input.split(' ');
		nString =query.length;
		for (q_id=0; q_id<nString; q_id++){
			if (query[q_id]!=='(' && query[q_id]!==')' && query[q_id]!=='||' && query[q_id]!=='&&'){
				tag = query[q_id];
				if (allTag.indexOf(tag)>-1){
					query[q_id]='true';
				} else {
					query[q_id]='false';
				}
			}
		}

		for (q_id=0; q_id<nString-1; q_id++){
			if ((query[q_id]=='false' || query[q_id]=='true') && (query[q_id+1]=='false' || query[q_id+1]=='true')){
				if (query[q_id]=='false'){
					query[q_id+1]='false';
				}
				query[q_id]='';
			}
		}

		resolved='';
		for (q_id=0; q_id<nString; q_id++){
			resolved += query[q_id];
		}

        if (eval(resolved)) {
            row[row_id].style.display = '';
            row_number++;
        } else {
            row[row_id].style.display = 'none';
        }

	}
    setNumberRow(row_number);
	pagination();

}