var path = '';
var files = [];
var timeout;
var getFilesInterval;
var toMove = "";

$(document).ready(()=>{

    setPath('root');
    var hash = window.location.hash;
    setInterval(function(){
    if (window.location.hash != hash) {
        hash = window.location.hash;
        var decodedUrl = decodeURIComponent(hash.substring(1));
        if(decodedUrl!=path) setPath(decodedUrl);
    }
    }, 100);

    $('#file').change((e)=>{
        uploadFile();
    });

});



function getTitle(){

    $.get('../php/user.php?q=title', (res)=>{

        var data = JSON.parse(res);
        document.title = data.title;
    
    });

}

function getFiles(){

    $.get(`../php/user.php?q=getfiles&path=${path}`,(res)=>{
        
        
        var counter = 1;
        var data = JSON.parse(res);
        data.sort(compare);

        if(arrayEquals(files,data))
            return;

        files = [];

        if(path=='root')
            $('.back_icon').addClass('disabled').removeClass('enabled');
        else
            $('.back_icon').removeClass('disabled').addClass('enabled');

        $('.loader').addClass('show');
        $('table').css('opacity',0);
        //;
        var rows = "";
        for(var i = 0; i<data.length; i++){
            files.push(data[i]);

            var icon;
            if(data[i].type=='file'){
                icon = `<i class="fas fa-file"></i>`;
                action = "download($(this).children('span').html()); ";
            }
            else{
                icon = `<i class="fas fa-folder"></i>`;
                action = "navigate($(this).children('span').html()); ";
            }

            rows  += `
            <tr>
                <td>${counter}</td>
                <td class="dir" onclick="${action}">${icon} <span>${data[i].name}</span><span onclick="showMoveWindow($(this).parent().children('span').html()); event.stopPropagation();" class="move_button" >Move to</span></td>
                <td>${data[i].size==undefined?'__':data[i].size}</td>
                <td><i onclick="deleteFile($(this).parent().parent().children().children('span').html());" class="fas fa-minus-circle delete"></i></td>
            </tr>
            `;
            counter++;
        }

        clearTimeout(timeout);
        timeout = setTimeout(()=>{
            $('table').children('tr').remove();
            $('table').append(rows).css('opacity',1);
            $('.loader').removeClass('show');
        },500);
        
    });

}

function compare(a,b) {
    if (a.type == 'dir' && b.type == 'file')
      return -1;
    if (b.type == 'dir' && a.type == 'file')
      return 1;
    return 0;
  }

function arrayEquals(arr1,arr2){

    if(arr1.length!=arr2.length) return false;

    for (var i = 0; i<arr1.length; i++){
        if(arr1[i].name != arr2[i].name || arr1[i].type != arr2[i].type) return false;
    }

    return true;
    
}

function setPath(path){
    window.location.hash = '#' + path;
    files = [{name:'noname',type:"notype"}];
    window.path = path;
    $('.path').html('./' + path);
    getFiles();
    clearInterval(getFilesInterval);
    getFilesInterval = setInterval(getFiles,5000);
}

function navigate(path){
    setPath(window.path + '/' + path);
}

function download(file){
    var fullPath = window.path + '/' + file;
    window.location = `../php/user.php?q=download&path=${fullPath}`
}

function back(){
    if(window.path=='root') return;
    var backPath = window.path.split('/');
    backPath.pop();
    backPath = backPath.join('/');
    setPath(backPath);
}

function deleteFile(file){
    if(!window.confirm("You are going to delete a file/folder.")) return;

    var fullPath = window.path + '/' + file;
    $.get(`../php/user.php?q=delete&path=${fullPath}`, ()=>{

        getFiles();
        clearInterval(getFilesInterval);
        getFilesInterval = setInterval(getFiles,5000);

    });
    
}

function chooseFile(){
    $('#file').click();
}

function uploadFile(){
    if($('#file').val()=="") return;

    var myFile = $('#file').prop('files')[0];   
    var form = new FormData();                  
    form.append('file', myFile);
    form.append('path', window.path);

    $.post({

        url: '../php/upload.php',
        data: form,
        success: (res)=>{

            getFiles();
            clearInterval(getFilesInterval);
            getFilesInterval = setInterval(getFiles,5000);
        
        },
        processData: false,
        contentType: false     

    });

    

    $('#file').val("");
}

function showMoveWindow(file){

    toMove = window.path + '/' + file;
    $('#moveToPopup').addClass('show');
}
