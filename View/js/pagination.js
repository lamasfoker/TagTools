const NUMBER_OF_ROW_PER_PAGE = 10;

var nIsShowedFile;
var nIsShowedTag;

function pagination() {

    var fileRows = $('#file-table > tbody > tr').filter(isShowedRow).length;
    var tagRows = $('#tag-table > tbody > tr').filter(isShowedRow).length;
    var filePages =  Math.ceil(fileRows/NUMBER_OF_ROW_PER_PAGE);
    var tagPages = Math.ceil(tagRows/NUMBER_OF_ROW_PER_PAGE);
    var filePagination = document.getElementById('file-pagination');
    var tagPagination = document.getElementById('tag-pagination');

    filePagination.innerHTML = '';
    tagPagination.innerHTML = '';
    nIsShowedFile = [];
    nIsShowedTag = [];

    if (filePages>1) {

        var rowsFile = $('#file-table > tbody > tr');
        for (let i=0; i<rowsFile.length; i++) {
            if (rowsFile[i].style.display !== 'none') {
                nIsShowedFile.push(true);
            } else {
                nIsShowedFile.push(false);
            }
        }

        filePagination.innerHTML = '<li class="disabled" id="file-left"><a href="#!"><i class="material-icons">chevron_left</i></a></li>';
        filePagination.innerHTML += '<li class="active" id="file-1"><a href="#!">1</a></li>';

        for (let index = 2; index < filePages + 1; index++) {
            filePagination.innerHTML += '<li class="waves-effect" id="file-'+index+'"><a href="#!">' + index + '</a></li>';
        }

        filePagination.innerHTML += '<li class="waves-effect" id="file-right"><a href="#!"><i class="material-icons">chevron_right</i></a></li>';
        for (let index = 1; index < filePages + 1; index++) {
            document.getElementById('file-'+index).addEventListener('click', goToPageFrom);
        }
        document.getElementById('file-left').addEventListener('click', goToPageFrom);
        document.getElementById('file-right').addEventListener('click', goToPageFrom);

        hideRows('file', 1);
    }

    if (tagPages>1) {

        tagPagination.innerHTML = '<li class="disabled" id="tag-left"><a href="#!"><i class="material-icons">chevron_left</i></a></li>';
        tagPagination.innerHTML += '<li class="active" id="tag-1"><a href="#!">1</a></li>';

        for (let index = 2; index < tagPages + 1; index++) {
            tagPagination.innerHTML += '<li class="waves-effect" id="tag-'+index+'"><a href="#!">' + index + '</a></li>';
        }

        tagPagination.innerHTML += '<li class="waves-effect" id="tag-right"><a href="#!"><i class="material-icons">chevron_right</i></a></li>';

        for (let index = 1; index < tagPages + 1; index++) {
            document.getElementById('tag-'+index).addEventListener('click', goToPageFrom);
        }
        document.getElementById('tag-right').addEventListener('click', goToPageFrom);
        document.getElementById('tag-left').addEventListener('click', goToPageFrom);

        var rowsTag = $('#tag-table > tbody > tr');
        for (let i=0; i<rowsTag.length; i++) {
            if (rowsTag.style.display !== 'none') {
                nIsShowedTag.push(true);
            } else {
                nIsShowedTag.push(false);
            }
        }
        hideRows('tag', 1);
    }

}

function goToPageFrom(e) {
    var typeTable, pointed;
    var nRows = 0;

    if (e.target.parentNode.nodeName == 'LI') {
        typeTable = e.target.parentNode.id.split('-')[0];
        pointed = e.target.parentNode.id.split('-')[1];
    } else {
        typeTable = e.target.parentNode.parentNode.id.split('-')[0];
        pointed = e.target.parentNode.parentNode.id.split('-')[1];
    }

    if (typeTable === 'file') {
        for (let i=0; i<nIsShowedFile.length; i++) {
            if (nIsShowedFile[i] === true) {
                nRows++;
            }
        }
    } else {
        for (let i=0; i<nIsShowedTag.length; i++) {
            if (nIsShowedTag[i] === true) {
                nRows++;
            }
        }
    }

    var current = parseInt($('#'+typeTable+'-pagination > .active')[0].id.split('-')[1]);
    var nPages = Math.ceil(nRows / NUMBER_OF_ROW_PER_PAGE);

    if (pointed === 'left') {
        if (current == 1) {
            return;
        }
        pointed = current-1;
    }
    if (pointed === 'right') {
        if (current == nPages) {
            return ;
        }
        pointed = current+1;
    }

    pointed = parseInt(pointed);

    if (pointed === 1) {
        $('#' + typeTable + '-left')[0].classList.remove('waves-effect');
        $('#' + typeTable + '-left')[0].classList.add('disabled');
    }
    if (pointed === nPages) {
        $('#' + typeTable + '-right')[0].classList.remove('waves-effect');
        $('#' + typeTable + '-right')[0].classList.add('disabled');
    }

    if (current === 1) {
        $('#' + typeTable + '-left')[0].classList.remove('disabled');
        $('#' + typeTable + '-left')[0].classList.add('waves-effect');
    }
    if (current === nPages) {
        $('#' + typeTable + '-right')[0].classList.remove('disabled');
        $('#' + typeTable + '-right')[0].classList.add('waves-effect');
    }

    $('#' + typeTable + '-' + current)[0].classList.remove('active');
    $('#' + typeTable + '-' + current)[0].classList.add('waves-effect');

    $('#' + typeTable + '-' + pointed)[0].classList.remove('waves-effect');
    $('#' + typeTable + '-' + pointed)[0].classList.add('active');

    hideRows(typeTable, pointed);
}

function isShowedRow()
{
    return $(this).css("display") !== 'none';
}

function hideRows(typeTable, current) {

    var nRows;
    var allRows = [];
    var searchedRows = [];

    allRows = $('#'+typeTable+'-table > tbody > tr');
    for (let i=0; i<allRows.length; i++) {
        if (typeTable === 'tag') {
            if (nIsShowedTag[i] === true) {
                searchedRows.push(allRows[i]);
            }
        } else {
            if (nIsShowedFile[i] === true) {
                searchedRows.push(allRows[i]);
            }
        }
    }
    nRows = searchedRows.length;

    for (let index=0; index<nRows; index++) {
        if (index<(current-1)*NUMBER_OF_ROW_PER_PAGE || index>=current*NUMBER_OF_ROW_PER_PAGE) {
            searchedRows[index].style.display = 'none';
        } else {
            searchedRows[index].style.display = '';
        }
    }

}