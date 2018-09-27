$(document).ready(function(){

  /* Modal Listener*/
  $('.modal').modal();

  hideTable('tag-table');
  pagination();

  document.getElementById('change-table-btn').addEventListener('click', changeTable);
  document.getElementById('tag-table').addEventListener('click', searchThisTag);
  document.getElementById('file-table').addEventListener('click', addSelectedItem);
  document.getElementById('selected-table').addEventListener('click', deleteSelectedItem);
  document.getElementById('search').addEventListener('input', searchFile);
  document.getElementById('xml-download-btn').addEventListener('click', downloadXml);
  document.getElementById('file-download-btn').addEventListener('click', downloadFile);

});

function changeTable() {
  cleanInput();
  let el = document.getElementById('change-table-btn').firstElementChild;
  if (el.textContent == 'local_offer') {
    el.innerHTML = 'photo';
      hideTable('file-table');
      showTable('tag-table');
      document.getElementById('search').removeEventListener('input', searchFile);
      document.getElementById('search').addEventListener('input', searchTag);
      searchTag();
  }
  else {
    el.innerHTML = 'local_offer';
      hideTable('tag-table');
      showTable('file-table');
      document.getElementById('search').removeEventListener('input', searchTag);
      document.getElementById('search').addEventListener('input', searchFile);
      searchFile();
  }
}

function addSelectedItem(e) {
  if (e.target && e.target.nodeName == 'TD') {
    var table = document.getElementById('selected-table');
    var fileName = e.target.parentElement.getElementsByTagName('TD')[2].textContent;
    if (table.innerHTML.indexOf(fileName) === -1) {
        let row = table.insertRow(0);
        let name_cell = row.insertCell(0);
        let cross_cell = row.insertCell(1);
        let id_cell = row.insertCell(2);
        let tag_cell = row.insertCell(3);
        name_cell.innerHTML = e.target.parentElement.getElementsByTagName('TD')[2].textContent;
        cross_cell.innerHTML = '<i class="small material-icons">clear</i>';
        id_cell.innerHTML = e.target.parentElement.getElementsByTagName('TD')[0].textContent;
        tag_cell.innerHTML = e.target.parentElement.getElementsByTagName('TD')[3].textContent;

        document.getElementById('sku-selected').style.display = 'none';
    }
  }
}

function deleteSelectedItem(e) {
  if (e.target && e.target.nodeName == 'I') {
    if (e.target.parentElement.parentElement.parentElement.childElementCount === 1) {
        document.getElementById('sku-selected').style.display = '';
    }
      e.target.parentElement.parentElement.remove();
  }
}

function searchThisTag(e) {
  if (e.target && e.target.nodeName == 'TD') {
    changeTable();
    document.getElementById('search').value=e.target.textContent;
    /// surely there is a better way
    setTimeout(searchTagFile, 100);
  }
}

function cleanInput() {
    document.getElementById('search').value='';
}

function downloadXml() {
    let table = document.getElementById('selected-table');
    let rows = table.getElementsByTagName('TR');
    let tag, name;
    var index =0;
    for (let i =0; i<rows.length; i++) {
      name = rows[i].getElementsByTagName('TD')[0].textContent;
      tag = rows[i].getElementsByTagName('TD')[3].textContent;
      addHiddenInputXmlForm(name, tag, index);
      index++;
    }
    document.getElementById('xml-download-form').submit();
    /// surely there is a better way
    document.getElementById('xml-download-form').innerHTML = '<input type="submit">';
}

function downloadFile() {
    let table = document.getElementById('selected-table');
    let rows = table.getElementsByTagName('TR');
    let id, name;
    var index =0;
    for (let i =0; i<rows.length; i++) {
        name = rows[i].getElementsByTagName('TD')[0].textContent;
        id = rows[i].getElementsByTagName('TD')[2].textContent;
        addHiddenInputFileForm(name, id, index);
        index++;
    }
    document.getElementById('file-download-form').submit();
    /// surely there is a better way
    document.getElementById('file-download-form').innerHTML = '<input type="submit">';
}

function addHiddenInputXmlForm(name, tag, index) {
  document.getElementById('xml-download-form').innerHTML += '<input type="hidden" name="'+index+'" value="'+name+'&&'+tag+'">';
}

function addHiddenInputFileForm(name, id, index) {
  document.getElementById('file-download-form').innerHTML += '<input type="hidden" name="'+index+'" value="'+name+'&&'+id+'">';
}

function showTable(table) {
  $('#'+table+'-container').show();
}

function hideTable(table) {
  $('#'+table+'-container').hide();
}