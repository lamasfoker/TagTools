$(document).ready(function(){

  /* Modal Listener*/
  $('.modal').modal();

  hideTable('tag-table');
  pagination();
  setNumberRow($('#file-table > tbody > tr').length);

  $('#change-table-btn').click(changeTable);
  $('#tag-table > tbody > tr').click(searchThisTag);
  $('#file-table > tbody > tr.img').click(addSelectedItem);
  $('#search').on('input', searchFile);
  $('#xml-download-btn').click(downloadXml);
  $('#file-download-btn').click(downloadFile);

});

function changeTable() {
  cleanInput();
  let el = $('#change-table-btn').children().first(),
      search = $('#search');
  if (el.text() === 'local_offer') {
      el.text('photo');
      hideTable('file-table');
      showTable('tag-table');
      setNumberRow($('#tag-table > tbody > tr').length);
      search.off('input', searchFile);
      search.on('input', searchTag);
      searchTag();
  }
  else {
      el.text('local_offer');
      hideTable('tag-table');
      showTable('file-table');
      setNumberRow($('#file-table > tbody > tr').length);
      search.off('input', searchTag);
      search.on('input', searchFile);
      searchFile();
  }
}

function addSelectedItem() {
    let table = $('#selected-table'),
        fileName = $(this).children(':nth-child(3)').text(),
        cross = '<i class="small material-icons cross">clear</i>',
        fileId = $(this).children(':nth-child(1)').text(),
        fileTag = $(this).children(':nth-child(4)').text();
    if (!table.children(':contains('+fileName+')').length) {
        table.append("<tr><td>"+fileName+"</td><td>"+cross+"</td><td>"+fileId+"</td><td>"+fileTag+"</td></tr>");
        $('.cross').last().click(deleteSelectedItem);
    }
}

function deleteSelectedItem() {
    $(this).parent().parent().remove();
}

function searchThisTag() {
    let tag = $(this).children(':nth-child(1)').text();
    changeTable();
    $('#search').val(tag);
    searchTagFile();
}

function cleanInput() {
    $('#search').val('');
}

function downloadXml() {
    let rows = $('#selected-table > tr'),
        form = $('#xml-download-form'),
        tag, name;
    rows.each(function(index) {
        name = $(this).children(':nth-child(1)').text();
        tag = $(this).children(':nth-child(4)').text();
        addHiddenInputXmlForm(name, tag, index);
    });
    form.submit();
    form.html('<input type="submit">');
}

function downloadFile() {
    let rows = $('#selected-table > tr'),
        form = $('#file-download-form'),
        id, name;
    rows.each(function(index) {
        name = $(this).children(':nth-child(1)').text();
        id = $(this).children(':nth-child(3)').text();
        addHiddenInputFileForm(name, id, index);
    });
    form.submit();
    form.html('<input type="submit">');
}

function addHiddenInputXmlForm(name, tag, index) {
  $('#xml-download-form').append('<input type="hidden" name="'+index+'" value="'+name+'&&'+tag+'">');
}

function addHiddenInputFileForm(name, id, index) {
  $('#file-download-form').append('<input type="hidden" name="'+index+'" value="'+name+'&&'+id+'">');
}

function showTable(table) {
  $('#'+table+'-container').show();
}

function hideTable(table) {
  $('#'+table+'-container').hide();
}

function setNumberRow(row_number) {
    $('#row-counter').html(row_number);
}