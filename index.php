<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/style.css">

<!DOCTYPE html>


<html>
    <meta name="viewport" content="width=device-width, initial-scale=0.5, maximum-scale=0.5">

        <head>
            <title>Chatting</title>
        </head>

    <body>
        
   
  

<!-- The Modal -->
<div  id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&check;</span>
   
   Your Name: <input type="text" id="name">
   <br>
   <br>
   Friend Name: <input type="text" id="fname">

   
  </div>

</div>
        
        <div  class="col-sm-3 col-sm-offset-4 frame">
            <ul style="height: 87%;"></ul>
            <div>
                <div class="msj-rta2 macro2" style="margin: 50px;">                        
                    <div class="text text-r2" style="background:whitesmoke !important">
                        <input id="input" class="mytext" placeholder="Type a message..."/>
                        
                    </div> 

                </div>
                       
            </div>
        </div>       
    </body>
</html>



<script>



var rg = false;

var modal = document.getElementById("myModal");


var span = document.getElementsByClassName("close")[0];

  modal.style.display = "block";


// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
  
  
  
  
  
  var name = document.getElementById("name").value ;
var tox = document.getElementById("fname").value ;



var ad = false ;

    var me = {};
me.avatar = "pics/a1.jpg";

var you = {};
you.avatar = "pics/a2.jpg";

function formatAMPM(date) {
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12;
    hours = hours ? hours : 12; 
    minutes = minutes < 10 ? '0'+minutes : minutes;
    var strTime = hours + ':' + minutes + ' ' + ampm;
    return strTime;
}            


function insertChat(who, text,date, time){
    if (time === undefined){
        time = 0;
    }
    var control = "";
    //var date = formatAMPM(new Date());
    
    ad = true ;
    
    if (who == "me"){
       
                    
                       control = '<li style="width:100%;">' +
                        '<div class="msj-rta macro">' +
                            '<div class="text text-r">' +
                                '<p>'+text+'</p>' +
                                '<p><small>'+date+'</small></p>' +
                            '</div>' +
                        '<div class="avatar" style="padding:0px 0px 0px 10px !important"><img class="img-circle" style="width:100%;" src="'+me.avatar+'" /></div>' +                                
                  '</li>';
    }else{
         control = '<li style="width:100%">' +
                        '<div class="msj macro">' +
                        '<div class="avatar"><img class="img-circle" style="width:100%;" src="'+ you.avatar +'" /></div>' +
                            '<div class="text text-l">' +
                                '<p>'+ text +'</p>' +
                                '<p><small>'+date+'</small></p>' +
                            '</div>' +
                        '</div>' +
                    '</li>';   
    }
    setTimeout(
        function(){                        
            $("ul").append(control).scrollTop($("ul").prop('scrollHeight'));
        }, time);
    
}

function resetChat(){
    $("ul").empty();
}

function postAjax(url, data) {
    var params = typeof data == 'string' ? data : Object.keys(data).map(
            function(k){ return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]) }
        ).join('&');

    var xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    xhr.open('POST', url);
    xhr.onreadystatechange = function() {
       // if (xhr.readyState>3 && xhr.status==200) { success(xhr.responseText); }
    };
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(params);
    return xhr;
}

$(".mytext").on("keydown", function(e){
    if (e.which == 13){
        var text = $(this).val();
        if (text !== ""){
            insertChat("me",text,formatAMPM(new Date()));              
            $(this).val('');
            postAjax('send.php', 'name=' + name + '&msg=' + text + '&to=' + tox);
        }
    }
});

$('body > div > div > div:nth-child(2) > span').click(function(){
    $(".mytext").trigger({type: 'keydown', which: 13, keyCode: 13});
})

//-- Clear Chat
resetChat();

function getAjax(url,success) {
    var xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    xhr.open('GET', url);
    xhr.onreadystatechange = function() {
                if (xhr.readyState>3 && xhr.status==200) success(xhr.responseText);
    };
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.send();

   return xhr;
}

var msgs = new Array(0) ;
var tmp = new Array(0) ;
var mymsgs = [""] ;

getAjax('read.php?name=' + tox , function(data){
    mymsgs = JSON.parse(data).msgs;
});

var rfr = function () {

getAjax('read.php?name=' + name , function(data){
    msgs = JSON.parse(data).msgs;
});




 if (msgs.length != tmp.length){
     prp(msgs , tmp.length) ;
     tmp = msgs;
 }
    
};
setInterval(rfr, 2000);

function p2(){
   
        console.log(kx) ;
               return kx ;
}

function prp(data , temp) {
    
    
    if (ad == false) {
        
               insertChat("you", data[data.length -1].msg, data[data.length -1].time ,  0); 
               
            insertChat("me", mymsgs[mymsgs.length -1].msg, mymsgs[mymsgs.length -1].time ,  0); 
              
   } else {
   
   for (i = temp; i < data.length; i++)
 {
       console.log(data[i]);
       insertChat("you", data[i].msg, data[i].time ,  0);  

 }
}
 }
}

</script>